<?= $this->include('template/headerforcontentuser'); ?>

<!-- File: Views/prediksi.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Harga Molding</title>
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-submit {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Prediksi Harga Molding</h1>

    <!-- Alert untuk menampilkan pesan jika data label belum diinput -->
    <div id="alertLabelMissing" class="alert alert-danger" style="display: none;" role="alert">
        Silakan pilih semua label sebelum melakukan prediksi.
    </div>
    
    <form id="predictionForm" action="<?= base_url('PrediksiPriceUser/proses_prediksiharga') ?>" method="post">
    <div class="form-group form-primary">
        <select name="grade-mold" class="form-control" required="">
            <option value="">Pilih Grade-Mold</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="part-application" class="form-control" required="">
            <option value="">Pilih Part-Application</option>
            <option value="AC">AC</option>
            <option value="Camera">Camera</option>
            <option value="Car">Car</option>
            <option value="Loundry">Loundry</option>
            <option value="MotorCycle">MotorCycle</option>
            <option value="Piano">Piano</option>
            <option value="Printer">Printer</option>
            <option value="Refrigerator">Refrigerator</option>
            <option value="Speaker">Speaker</option>
            <option value="TV-Monitor">TV-Monitor</option>
            <option value="WaterMeter">WaterMeter</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="qty-produk" class="form-control" required="">
            <option value="">Pilih Qty-Produk</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="8">8</option>
            <option value="16">16</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="Tonase" class="form-control" required="">
            <option value="">Pilih Tonase</option>
            <option value="30">30 Ton</option>
            <option value="40">40 Ton</option>
            <option value="50">50 Ton</option>
            <option value="60">60 Ton</option>
            <option value="70">70 Ton</option>
            <option value="75">75 Ton</option>
            <option value="80">80 Ton</option>
            <option value="100">100 Ton</option>
            <option value="110">110 Ton</option>
            <option value="120">120 Ton</option>
            <option value="125">125 Ton</option>
            <option value="130">130 Ton</option>
            <option value="140">140 Ton</option>
            <option value="150">150 Ton</option>
            <option value="160">160 Ton</option>
            <option value="170">170 Ton</option>
            <option value="180">180 Ton</option>
            <option value="200">200 Ton</option>
            <option value="210">210 Ton</option>
            <option value="220">220 Ton</option>
            <option value="230">230 Ton</option>
            <option value="250">250 Ton</option>
            <option value="260">260 Ton</option>
            <option value="300">300 Ton</option>
            <option value="330">330 Ton</option>
            <option value="350">350 Ton</option>
            <option value="360">360 Ton</option>
            <option value="380">380 Ton</option>
            <option value="450">450 Ton</option>
            <option value="550">550 Ton</option>
            <option value="600">600 Ton</option>
            <option value="650">650 Ton</option>
            <option value="850">850 Ton</option>
            <option value="1100">1100 Ton</option>
            <option value="1250">1250 Ton</option>
            <option value="1300">1300 Ton</option>
            <option value="1680">1680 Ton</option>
            <option value="1800">1800 Ton</option>
            <option value="2300">2300 Ton</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="Cavity-Material" class="form-control" required="">
            <option value="">Pilih Cavity-Material</option>
            <option value="CENA-1">CENA-1</option>
            <option value="CENA-G">CENA-G</option>
            <option value="HP4M">HP4M</option>
            <option value="HP4">HP4</option>
            <option value="HPM7">HPM7</option>
            <option value="NAK80">NAK80</option>
            <option value="P20">P20</option>
            <option value="PX4">PX4</option>
            <option value="PXA30">PXA30</option>
            <option value="S50C">S50C</option>
            <option value="S55C">S55C</option>
            <option value="S-718">S-718</option>
            <option value="SKD61">SKD61</option>
            <option value="STAVAX">STAVAX</option>
            <option value="2316">2316</option>
            <option value="2738">2738</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="Core-Material" class="form-control" required="">
            <option value="">Pilih Core-Material</option>
            <option value="CENA-G">CENA-G</option>
            <option value="HP4">HP4</option>
            <option value="HP4M">HP4M</option>
            <option value="HPM7">HPM7</option>
            <option value="NAK80">NAK80</option>
            <option value="P20">P20</option>
            <option value="PX4">PX4</option>
            <option value="PXA30">PXA30</option>
            <option value="S50C">S50C</option>
            <option value="S55C">S55C</option>
            <option value="SKD61">SKD61</option>
            <option value="STAVAX">STAVAX</option>
            <option value="2316">2316</option>
            <option value="2738">2738</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="Slide-System" class="form-control" required="">
            <option value="">Pilih Slide-System</option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
        <select name="Lift-Core-System" class="form-control" required="">
            <option value="">Pilih Lift-Core-System</option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>
        <span class="form-bar"></span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-submit">Prediksi</button>
    </div>
</form>

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

    function validateForm(event) {
        var isValid = true;
        var form = document.getElementById('predictionForm');
        var selects = form.getElementsByTagName('select');

        for (var i = 0; i < selects.length; i++) {
            if (selects[i].value === '') {
                isValid = false;
                break;
            }
        }

        if (!isValid) {
            $('#alertLabelMissing').show(); // Show alert if any label is not selected
            alert('Silakan pilih semua label sebelum melakukan prediksi.'); // Show validation message
            event.preventDefault(); // Prevent form submission
        } else {
            $('#alertLabelMissing').hide(); // Hide alert if all labels are selected
            showLoading(); // Show loading modal
        }
    }

    // Attach validateForm function to form submit event
    document.getElementById('predictionForm').addEventListener('submit', validateForm);
</script>

<?= $this->include('template/footerforcontent'); ?>
