<?= $this->include('template/headerforcontent'); ?>

<!-- views/insert_csv.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Excel CSV to MySQL</title>
    <meta name="description" content="The tiny framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <strong>Upload CSV File</strong>
        </div>
        <div class="card-body">
            <div class="mt-2">
                <?php if (session()->has('message')): ?>
                    <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>
                <?php $validation = \Config\Services::validation(); ?>
            </div>
            <form id="uploadForm" action="<?php echo base_url('/dataset/insert_csv');?>" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <div class="mb-3">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>                       
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark" onclick="showLoading()">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Modal -->
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
<!-- End Loading Modal -->

<script>
    function showLoading() {
        $('#loadingModal').modal('show'); // Show the loading modal
    }

</script>

<?= $this->include('template/footerforcontent'); ?>
</body>
</html>
