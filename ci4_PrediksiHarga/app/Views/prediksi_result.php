<?= $this->include('template/headerforcontent'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tambahkan tag script jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Prediksi Harga Molding</title>
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .result {
            margin-top: 20px;
        }
        .btn-submit {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        /* Tambahkan gaya untuk pesan sukses */
        .success-message {
            color: #155724;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        /* Tambahkan gaya untuk confusion matrix */
        .confusion-matrix {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        .metrics {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hasil Prediksi Harga Molding</h1>
    
    <div class="result">
        <?php if(isset($predictions) && isset($accuracy)): ?>
            <!-- Tampilkan pesan sukses -->
            <div class="success-message"><?= isset($success_message) ? strtoupper($success_message) : '' ?></div>

            <!-- Tampilkan hasil prediksi -->
            <?php foreach ($predictions as $index => $prediction): ?>
                <p><?= $prediction ?></p>
            <?php endforeach; ?>

            <!-- Tampilkan akurasi -->
        
            <!-- Tampilkan MAE dan MAPE -->
            <!-- <p>MAE Price: <?= isset($mae_price) ? $mae_price : '' ?></p> -->
            <!-- <p>MAPE Price: <?= isset($mape_price) ? $mape_price : '' ?></p> -->

            <!-- Tombol untuk menampilkan report confusion matrix -->
            <button onclick="showConfusionMatrix()">Tampilkan Report Confusion Matrix</button>
            <div id="confusionMatrix" class="confusion-matrix">
                <!-- Tempatkan kode di sini -->
                <img id="confusionMatrixImage" src="<?= base_url('confusion_matrix/confusion_matrix.png') ?>" style="display: none; width: 100%; height: auto; border: none;">
            </div>

            <!-- Tombol Kembali -->
            <a href="<?= base_url('PrediksiPrice/index') ?>" class="btn-submit">Kembali</a>

            <!-- Tombol Cetak ke Excel -->
            <button onclick="exportToExcel()">Cetak ke Excel</button>
        <?php else: ?>
            <!-- Tampilkan pesan jika tidak ada hasil prediksi -->
            <p>Tidak ada hasil prediksi yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function showConfusionMatrix() {
        $.ajax({
            url: "<?= base_url('/PrediksiPrice/plotConfusionMatrix') ?>",
            type: "GET",
            success: function(data) {
                // Tampilkan gambar matriks kebingungan
                $('#confusionMatrixImage').attr('src', data.image_path).show();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
    function exportToExcel() {
        $.ajax({
            url: "<?= base_url('/PrediksiPrice/exportToExcel') ?>",
            type: "GET",
            success: function(data) {
                // Redirect to the generated Excel file
                window.location.href = data.file_path;
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
    //Memuat hasil prediksi saat halaman dimuat
        $(document).ready(function() {
            $.ajax({
                url: "<?= base_url('/PrediksiPrice/proses_prediksiharga') ?>",
                type: "POST",
                success: function(data) {
                    // Tampilkan hasil prediksi
                    showPredictions(data.predictions);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });
</script>

</body>
</html>

<?= $this->include('template/footerforcontent'); ?>
