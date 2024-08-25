import json
import sys
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report, mean_absolute_error
import pandas as pd
import numpy as np
import mysql.connector
from mysql.connector import Error

def load_data_from_mysql(datasetmold):
    connection = None
    try:
        connection = mysql.connector.connect(
            host='localhost',
            port=3307,
            database='si_prediksihargamold',
            user='root',
            password='root'
        )
        if connection.is_connected():
            cursor = connection.cursor()
            cursor.execute(f"SELECT * FROM {datasetmold}")
            records = cursor.fetchall()
            df = pd.DataFrame(records, columns=[desc[0] for desc in cursor.description])
            return df
    except Error as e:
        print(json.dumps({'status': 'error', 'message': f"Kesalahan saat terhubung ke MySQL: {e}"}))
        return None
    finally:
        if connection is not None and connection.is_connected():
            cursor.close()
            connection.close()

def mean_absolute_percentage_error(y_true, y_pred):
    # Handling division by zero
    mask = y_true != 0
    return np.mean(np.abs((y_true[mask] - y_pred[mask]) / y_true[mask])) * 100

def main(percentage):
    try:
        datasetmold = 'datasetmold'
        data = load_data_from_mysql(datasetmold)

        if data is None:
            return

        le = LabelEncoder()
        for column in data.columns:
            if data[column].dtype == 'object':
                data[column] = le.fit_transform(data[column])

        X = data[['grade-mold', 'customer', 'part-application', 'qty-produk', 'Tonase', 'Resin-plastic', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Mold-Design-Type', 'Hot-Runner-System', 'Mold-Base-Order-Company', 'Weight', 'price-mold']]
        y = data['remark']

        test_size = (100 - int(percentage)) / 100
        x_train, x_test, y_train, y_test = train_test_split(X, y, test_size=test_size, random_state=0)

        model = RandomForestClassifier(n_jobs=-1)
        model.fit(x_train, y_train)

        y_pred = model.predict(x_test)
        accuracy = model.score(x_test, y_test)
        report = classification_report(y_test, y_pred, output_dict=True)

        mae = mean_absolute_error(y_test, y_pred)
        mape = mean_absolute_percentage_error(y_test, y_pred)

        result = {
            'status': 'success',
            'accuracy': accuracy,
            'classification_report': report,
            'MAE': mae,
            'MAPE': mape
        }

        print(json.dumps(result))

    except Exception as e:
        print(json.dumps({'status': 'error', 'message': str(e)}))

if __name__ == "__main__":
    if len(sys.argv) > 1:
        percentage = sys.argv[1]
        main(percentage)
    else:
        print(json.dumps({'status': 'error', 'message': 'Tidak ada input persentase yang diberikan'}))
