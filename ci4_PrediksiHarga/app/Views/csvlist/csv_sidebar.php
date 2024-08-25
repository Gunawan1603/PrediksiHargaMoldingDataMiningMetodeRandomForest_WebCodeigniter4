<?= $this->include('template/headerforcontent'); ?>

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
                                
                            </div>

                            <div class="card-block">
                                <div class="table-responsive">
                                    <div class="scrollable-table">
                                        <table id="datatableFbr" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>File Name</th>
                                                    <th>File</th>
                                                    <th>URL</th>
                                                    <th>Is Active</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($csvFiles) && is_array($csvFiles)): ?>
                                                    <?php foreach ($csvFiles as $file): ?>
                                                        <tr>
                                                            <td><?= esc($file['id']); ?></td>
                                                            <td><?= esc($file['file_name']); ?></td>
                                                            <td><?= esc($file['file']); ?></td>
                                                            <td><a href="<?= esc($file['url']); ?>"><?= esc($file['url']); ?></a></td>
                                                            <td><?= esc($file['is_active'] ? 'Yes' : 'No'); ?></td>
                                                            <td>
                                                                <!-- Tombol Download CSV -->
                                                                <a href="<?php echo site_url('dataset/download/' . $file['id']); ?>" class="btn btn-sm waves-effect waves-light btn-primary btn-outline-primary" onclick="return confirm('Are you sure you want to download this file?');">
                                                                    <i class="fa fa-download"></i> Download
                                                                </a>
                                                                <!-- Tombol Delete -->
                                                                <a href="<?= base_url('dataset/deleteCsvFile/' . $file['id']); ?>" class="btn btn-sm waves-effect waves-light btn-danger btn-outline-danger" onclick="return confirm('Are you sure you want to delete this file?');">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6">No CSV files found</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end of scrollable-table -->
                                </div> <!-- end of table-responsive -->
                            </div> <!-- end of card-block -->
                        </div> <!-- end of card -->
                    </div> <!-- end of col-sm-12 -->
                </div> <!-- end of row -->
            </div> <!-- end of page-body -->
        </div> <!-- end of page-wrapper -->
    </div> <!-- end of main-body -->
</div> <!-- end of pcoded-inner-content -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                if (!confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>

<?= $this->include('template/footerforcontent'); ?>
