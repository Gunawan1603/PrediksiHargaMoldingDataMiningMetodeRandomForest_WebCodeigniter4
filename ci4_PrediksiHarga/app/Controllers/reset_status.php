<?php
// Load model
use App\Models\DataSetModel;
$model = new DataSetModel();

// Hapus isi kolom status pada tabel training set
$model->deleteByStatus('training');

// Hapus isi kolom status pada tabel testing set (jika perlu)
$model->deleteByStatus('testing');

// Kirim respon ke JavaScript
echo json_encode(['status' => 'success']);
?>
