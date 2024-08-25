import os
import pandas as pd
from sklearn.ensemble import RandomForestClassifier, RandomForestRegressor
from sklearn.preprocessing import LabelEncoder
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report, confusion_matrix, mean_absolute_error
import mysql.connector
from mysql.connector import Error
import sys
import numpy as np
import matplotlib.pyplot as plt
import json

def mean_absolute_percentage_error(y_true, y_pred):
    mask = y_true != 0
    return np.mean(np.abs((y_true[mask] - y_pred[mask]) / y_true[mask])) * 100

def predict_price_and_remark(grade_mold, part_application, qty_produk, tonase, cosmetic, cavity_material, core_material, slide_system, lift_core_system, hot_runner_system):
    datasetmold = 'datasetmold'
    data = load_data_from_mysql(datasetmold)

    if data is None:
        return "Failed to load data from MySQL"

    X = data[['grade-mold', 'part-application', 'qty-produk', 'Tonase', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Hot-Runner-System']]
    y_remark = data['remark']
    y_price = data['price-mold']

    x_train, x_test, y_train_remark, y_test_remark = train_test_split(X, y_remark, test_size=0.2, random_state=0)
    _, _, y_train_price, y_test_price = train_test_split(X, y_price, test_size=0.2, random_state=0)

    model_remark = RandomForestClassifier(n_jobs=-1)
    model_remark.fit(x_train, y_train_remark)

    model_price = RandomForestRegressor(n_jobs=-1)
    model_price.fit(x_train, y_train_price)

    input_data = pd.DataFrame([[grade_mold, part_application, qty_produk, tonase, cosmetic, cavity_material, core_material, slide_system, lift_core_system, hot_runner_system]], columns=['grade-mold', 'part-application', 'qty-produk', 'Tonase', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Hot-Runner-System'])
    remark_prediction = model_remark.predict(input_data)[0]
    price_prediction = model_price.predict(input_data)[0]

    y_pred_remark_test = model_remark.predict(x_test)
    classification_report_remark = classification_report(y_test_remark, y_pred_remark_test, output_dict=True)

    y_pred_price_test = model_price.predict(x_test)
    mae_price = mean_absolute_error(y_test_price, y_pred_price_test)
    mape_price = mean_absolute_percentage_error(y_test_price, y_pred_price_test)

    cm = confusion_matrix(y_test_remark, y_pred_remark_test)
    print("Confusion Matrix:")
    print(cm)

    plt.figure(figsize=(8, 6))
    plt.imshow(cm, interpolation='nearest', cmap=plt.cm.Reds)
    class_names = ['Mahal', 'Murah']
    plt.title('Confusion Matrix')
    plt.colorbar()
    plt.xticks(ticks=range(len(class_names)), labels=class_names)
    plt.yticks(ticks=range(len(class_names)), labels=class_names)
    plt.xlabel('Predicted Label')
    plt.ylabel('True Label')

    for i in range(len(class_names)):
        for j in range(len(class_names)):
            plt.text(j, i, format(cm[i, j], 'd'),
                     horizontalalignment="center",
                     color="white" if cm[i, j] > (cm.max() / 2) else "black")

    directory = 'confusion_matrix/'
    if not os.path.exists(directory):
        os.makedirs(directory)
    plt.savefig(os.path.join(directory, 'confusion_matrix.png'))
    
    # Menghitung jumlah percabangan (nodes) untuk setiap model
    nodes_remark = sum(tree.tree_.node_count for tree in model_remark.estimators_)
    nodes_price = sum(tree.tree_.node_count for tree in model_price.estimators_)

    # Formatting the result as a string
    accuracy = classification_report_remark['accuracy']
    formatted_accuracy = f"{accuracy * 100:.2f}%"
    formatted_rupiah = f"{price_prediction :,.0f}"
    formatted_mae_price = f"{mae_price :,.0f}"
    formatted_mape_price = f"{mape_price :.2f}%"  # Fixed formatting for MAPE
    report = classification_report(y_test_remark, y_pred_remark_test)
    # result = f"Remark Prediction: {remark_prediction}\nPrice Prediction: Rp. {formatted_rupiah} ,-\nAccuracy: {formatted_accuracy}\nClassification Report:\n{report}\nMAE Price: Rp. {formatted_mae_price} ,-\nMAPE Price: {formatted_mape_price}\nNumber of trees in RandomForestClassifier: {model_remark.n_estimators}\nNumber of trees in RandomForestRegressor: {model_price.n_estimators}\nConfusion Matrix: {cm}"
    result = f"Remark Prediction: {remark_prediction}\nPrice Prediction: Rp. {formatted_rupiah} ,-\nAccuracy: {formatted_accuracy}\nClassification Report:\n{report}\nMAE Price: Rp. {formatted_mae_price} ,-\nMAPE Price: {formatted_mape_price}\nTotal nodes in RandomForestClassifier: {nodes_remark}\nTotal nodes in RandomForestRegressor: {nodes_price}\nConfusion Matrix: {cm}"
    return result


def load_data_from_mysql(datasetmold):
    connection = None
    try:
        connection = mysql.connector.connect(host='localhost', port=3307, database='si_prediksihargamold', user='root', password='root')
        if connection.is_connected():
            cursor = connection.cursor()
            cursor.execute(f"SELECT `grade-mold`, `part-application`, `qty-produk`, `Tonase`, `cosmetic`, `Cavity-Material`, `Core-Material`, `Slide-System`, `Lift-Core-System`, `Hot-Runner-System`, `remark`, `price-mold` FROM {datasetmold}")
            records = cursor.fetchall()
            df = pd.DataFrame(records, columns=['grade-mold', 'part-application', 'qty-produk', 'Tonase', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Hot-Runner-System', 'remark', 'price-mold'])

            label_encoder = LabelEncoder()
            for col in ['grade-mold', 'part-application', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Hot-Runner-System']:
                df[col] = label_encoder.fit_transform(df[col])

            return df
    except Error as e:
        print("Error while connecting to MySQL", e)
        raise Exception("Error while connecting to MySQL") from e
    finally:
        if connection is not None and connection.is_connected():
            cursor.close()
            connection.close()

if __name__ == "__main__":
    if len(sys.argv) < 11:
        print("Usage: python predict_price.py <grade_mold> <part_application> <qty_produk> <tonase> <cosmetic> <cavity_material> <core_material> <slide_system> <lift_core_system> <hot_runner_system>")
        sys.exit(1)

    grade_mold = sys.argv[1]
    part_application = sys.argv[2]
    qty_produk = int(sys.argv[3])
    tonase = int(sys.argv[4])
    cosmetic = sys.argv[5]
    cavity_material = sys.argv[6]
    core_material = sys.argv[7]
    slide_system = sys.argv[8]
    lift_core_system = sys.argv[9]
    hot_runner_system = sys.argv[10]

    prediction = predict_price_and_remark(grade_mold, part_application, qty_produk, tonase, cosmetic, cavity_material, core_material, slide_system, lift_core_system, hot_runner_system)
    if prediction is not None:
        print(prediction)

