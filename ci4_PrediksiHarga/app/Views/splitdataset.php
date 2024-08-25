<?= $this->include('template/headerforcontent'); ?>

<div class="text-left">
    <div class="col-md-3">
        <div class="form-group">
            <label for="percentage">Pilih Persentase:</label>
            <div class="input-group">
                <input type="number" class="form-control" id="percentageInput" placeholder="-" min="1" max="100">
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
                <button type="button" id="btn-proses" class="btn btn-info"><i class="fa fa-refresh"></i> Proses</button>
            </div>
        </div>
    </div>
    <div class="text-right mb-3">
    <a href="<?= base_url('splitdataset/showResults'); ?>" class="btn btn-primary">Result View</a>
        <button type="button" id="btn-reset" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
        <button type="button" class="btn btn-secondary" onclick="location.reload();"><i class="fa fa-refresh"></i> Refresh</button>
    </div>

    <?php if (session()->has('pesan')): ?>
        <div class="alert alert-success" role="alert">
            <?= session('pesan') ?>
        </div>
    <?php endif; ?>

    <div class="alert alert-info" role="alert">
    Persentase data training set: 
    <?php 
    $file = WRITEPATH . 'persentase_input.txt';
    if (file_exists($file) && filesize($file) > 0) {
        $percentage = file_get_contents($file);
        $percentageTesting = 100 - $percentage;
        echo htmlspecialchars($percentage) . '%';
    } else {
        $percentage = 0;
        $percentageTesting = 0;
        echo '0%';
    }
    ?> 
    dan testing set: <?= htmlspecialchars($percentageTesting) ?>%
    </div>



    <?php if (isset($accuracy)): ?>
        <div class="alert alert-info" role="alert">
            Akurasi: <?= $accuracy ?>
        </div>
    <?php endif; ?>

    <!-- Data Training -->
    <div class="data-training">
        <h2>Data Training</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Grade Mold</th>
                <th>Customer</th>
                <th>Part-Application</th>
                <th>Quantity Produk</th>
                <th>Cosmetic</th>
                <th>Tonase</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Remark</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trainingSet as $index => $data): ?>
                <tr class="<?= $index % 2 == 0 ? 'even-row' : 'odd-row'; ?>">
                    <td><?= $data['id']; ?></td>
                    <td><?= htmlspecialchars($data['grade-mold']); ?></td>
                    <td><?= htmlspecialchars($data['customer']); ?></td>
                    <td><?= htmlspecialchars($data['part-application']); ?></td>
                    <td><?= htmlspecialchars($data['qty-produk']); ?></td>
                    <td><?= htmlspecialchars($data['cosmetic']); ?></td>
                    <td class="tonase-column"><?= htmlspecialchars($data['Tonase']); ?></td>
                    <td><?= htmlspecialchars($data['Weight']); ?></td>
                    <td><?= "Rp. ".number_format($data['price-mold'])." ,-"; ?></td>
                    <td><?= htmlspecialchars($data['remark']); ?></td>
                    <td><?= htmlspecialchars($data['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Data Testing -->
    <div class="data-testing">
        <h2>Data Testing</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Grade Mold</th>
                <th>Customer</th>
                <th>Part-Application</th>
                <th>Quantity Produk</th>
                <th>Cosmetic</th>
                <th>Tonase</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Remark</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testingSet as $index => $data): ?>
                <tr class="<?= $index % 2 == 0 ? 'even-row' : 'odd-row'; ?>">
                    <td><?= $data['id']; ?></td>
                    <td><?= htmlspecialchars($data['grade-mold']); ?></td>
                    <td><?= htmlspecialchars($data['customer']); ?></td>
                    <td><?= htmlspecialchars($data['part-application']); ?></td>
                    <td><?= htmlspecialchars($data['qty-produk']); ?></td>
                    <td><?= htmlspecialchars($data['cosmetic']); ?></td>
                    <td class="tonase-column"><?= htmlspecialchars($data['Tonase']); ?></td>
                    <td><?= htmlspecialchars($data['Weight']); ?></td>
                    <td><?= "Rp. ".number_format($data['price-mold'])." ,-"; ?></td>
                    <td><?= htmlspecialchars($data['remark']); ?></td>
                    <td><?= htmlspecialchars($data['status']); ?></td>
                </tr>
            <?php endforeach; ?>

            <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loadingModalLabel">Processing</h5>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <p class="mt-3">Please wait while we process your request.</p>
            </div>
        </div>
    </div>
</div>

        </tbody>
    </table>
</div>
<script>
    document.getElementById('btn-reset').addEventListener('click', function () {
        $('#loadingModal').modal('show'); // Show the loading modal
        fetch('<?= base_url("splitdataset/resetStatus"); ?>')
            .then(response => response.json())
            .then(data => {
                $('#loadingModal').modal('hide'); // Hide the loading modal
                if (data.status === 'success') {
                    alert('Status berhasil direset.');

                    // Kosongkan nilai persentase input
                    document.getElementById('percentageInput').value = '';

                    document.querySelector('.alert-info').innerHTML = 'Persentase data training set: 0% dan testing set: 0%';

                    fetch('<?= base_url("splitdataset/deleteAllData"); ?>')
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert('Data berhasil dihapus dari tabel.');
                                window.location.reload();
                            } else {
                                alert('Gagal menghapus data dari tabel: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus data dari tabel.');
                        });
                } else {
                    alert('Gagal mereset status.');
                }
            })
            .catch(error => {
                $('#loadingModal').modal('hide'); // Hide the loading modal in case of error
                console.error('Error:', error);
                alert('Terjadi kesalahan saat melakukan reset status.');
            });
    });

    document.getElementById('btn-proses').addEventListener('click', function () {
        var percentage = document.getElementById('percentageInput').value;
        if (percentage !== '') {
            $('#loadingModal').modal('show'); // Show the loading modal
            fetch('<?= base_url("splitdataset/splitPersen"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'percentageInput=' + percentage,
            })
            .then(response => response.json())
            .then(data => {
                $('#loadingModal').modal('show'); // Show the loading modal
                if (data.status === 'success') {
                    alert('Data berhasil dipisahkan berdasarkan persentase.');
                    fetch('<?= base_url("splitdataset/performance"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'percentageInput=' + percentage,
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#loadingModal').modal('show'); // Show the loading modal
                        if (data.status === 'success') {
                            alert('Performa berhasil dihitung.');
                            window.location.href = '<?= base_url("splitdataset/showResults"); ?>';
                        } else {
                            console.error('Error in calculating performance:', data.message);
                            alert('Gagal menghitung performa: ' + data.message);
                        }
                    })
                    .catch(error => {
                        $('#loadingModal').modal('hide'); // Hide the loading modal in case of error
                        console.error('Error during performance calculation:', error);
                        alert('Terjadi kesalahan saat menghitung performa. Silakan cek konsol untuk detail lebih lanjut.');
                    });
                } else {
                    console.error('Error during data split:', data.message);
                    alert('Gagal memisahkan data: ' + data.message);
                }
            })
            .catch(error => {
                $('#loadingModal').modal('hide'); // Hide the loading modal in case of error
                console.error('Error during splitPersen:', error);
                alert('Terjadi kesalahan saat memproses data.');
            });
        } else {
            alert('Masukkan persentase terlebih dahulu.');
        }
    });
</script>


<?= $this->include('template/footerforcontent'); ?>
