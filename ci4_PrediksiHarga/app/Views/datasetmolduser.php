<?= $this->include('template/headerforcontentuser'); ?>

<!-- Page-header end -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5><?= strtoupper($title); ?></h5>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                    </div>
                                    <div class="col-md-10 text-right">
                                        <a href="<?= base_url('user/datasetuser/add'); ?>" class="btn btn-out waves-effect waves-light btn-primary btn-square"><i class="fa fa-plus"></i> Add Data</a>                         
                                    </div>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="datatableFbr" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Grade-Mold</th>
                                                <th>Customer</th>
                                                <th>Part-Application</th>
                                                <th>Qty-Produk</th>
                                                <th>Cosmetic</th>
                                                <th>Tonase</th>
                                                <th>Resin-Plastic</th>
                                                <th>Cavity-Material</th>
                                                <th>Core-Material</th>
                                                <th>Slide-System</th>
                                                <th>Lift-Core-System</th>
                                                <th>Mold-Design-Type</th>
                                                <th>Hot-Runner-System</th>
                                                <th>Mold-Base-Order-Company</th>
                                                <th>Weight</th>
                                                <th>Price-Mold</th>
                                                <th>Remark</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if($datasetmold): foreach($datasetmold as $row): 
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $no++; ?></th>
                                                    <td><?= $row['id']; ?></td>
                                                    <td><?= $row['grade-mold']; ?></td>
                                                    <td><?= $row['customer']; ?></td>
                                                    <td><?= $row['part-application']; ?></td>
                                                    <td><?= $row['qty-produk']; ?></td>
                                                    <td><?= $row['cosmetic']; ?></td>
                                                    <td><?= $row['Tonase'] ?></td>
                                                    <td><?= $row['Resin-plastic'] ?></td>
                                                    <td><?= $row['Cavity-Material'] ?></td>
                                                    <td><?= $row['Core-Material'] ?></td>
                                                    <td><?= $row['Slide-System'] ?></td>
                                                    <td><?= $row['Lift-Core-System'] ?></td>
                                                    <td><?= $row['Mold-Design-Type'] ?></td>
                                                    <td><?= $row['Hot-Runner-System'] ?></td>
                                                    <td><?= $row['Mold-Base-Order-Company'] ?></td>
                                                    <td><?= $row['Weight'] ?></td>
                                                    <td><?= "Rp. ".number_format($row['price-mold'])." ,-"; ?></td>
                                                    <td><?= $row['remark'] ?></td>
                                                    <td><?= $row['status'] ?></td>
                                                    <td>
                                                        <a href="<?= base_url('user/datasetuser/edit/'.$row['id']); ?>" class="btn btn-sm waves-effect waves-light btn-primary btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="<?= base_url('user/datasetuser/delete/'.$row['id']); ?>" class="btn btn-sm waves-effect waves-light btn-danger btn-outline-danger" onclick="showLoading(); return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; else: ?>
                                                <tr>
                                                    <td colspan="21">Tidak ada data</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Processing...</p>
            </div>
        </div>
    </div>
</div>
<!-- End Loading Modal -->

<script>
    // Add event listener to the search input
    document.getElementById('searchInput').addEventListener('input', function () {
        var searchValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#datatableFbr tbody tr');

        rows.forEach(function (row) {
            var text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchValue) ? 'table-row' : 'none';
        });
    });

    function deleteAllData() {
        if (confirm('Apakah Anda yakin ingin menghapus semua data?')) {
            showLoading();
            window.location.href = "<?= base_url('dataset/deleteAllData'); ?>";
        }
    }

    function showLoading() {
        $('#loadingModal').modal('show'); // Show the loading modal
    }
</script>

<?= $this->include('template/footerforcontent'); ?>
