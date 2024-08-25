<?= $this->include('template/headerforcontentuser'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar File yang Diunggah</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>"> <!-- Sesuaikan dengan CSS Anda -->
</head>
<body>
    <div class="container">
        <h1>Daftar File Report prediksi Harga .txt/excel</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama File</th>
                    <th>Tipe File</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk tombol Hapus -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fileList)) : ?>
                    <?php foreach ($fileList as $index => $file) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $file['name'] ?></td>
                            <td><?= strtoupper($file['ext']) ?></td>
                            <td>
                                <a href="<?= base_url('PrediksiPrice/download/' . urlencode($file['name'])) ?>" class="btn btn-sm btn-primary" onclick="return confirm('Apakah Anda yakin ingin mendownload file ini?')">Download</a>
                                <a href="<?= base_url('PrediksiPrice/delete/' . urlencode($file['name'])) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Tidak ada file yang diunggah.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


<?= $this->include('template/footerforcontent'); ?>
