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
                            </div>
                            <div class="card-block">
                                <!-- 
                                    // ===========================================================
                                    // =============== You Can Place the Data Here ===============
                                    // ===========================================================
                                -->
                                <form class="form-material" action="<?= base_url('datasetuser/save') ?>" method="POST">
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
                                        <select name="customer" class="form-control" required="">
                                            <option value="">Pilih Customer</option>
                                            <option value="LGEIN">LGEIN</option>
                                            <option value="EPSON">EPSON</option>
                                            <option value="YAMAHA">YAMAHA</option>
                                            <option value="API">API</option>
                                            <option value="BAHANA">BAHANA</option>
                                            <option value="BUMJIN">BUMJIN</option>
                                            <option value="DAE YOUNG APEX">DAE YOUNG APEX</option>
                                            <option value="EDC">EDC</option>
                                            <option value="EDC (AWP)">EDC (AWP)</option>
                                            <option value="EMSONIC">EMSONIC</option>
                                            <option value="FRINA LESTARI">FRINA LESTARI</option>
                                            <option value="FUJISEAT">FUJISEAT</option>
                                            <option value="HOCK JAYA">HOCK JAYA</option>
                                            <option value="HONDA LOCK">HONDA LOCK</option>
                                            <option value="HONORIS">HONORIS</option>
                                            <option value="ICHIKOH">ICHIKOH</option>
                                            <option value="IKPI">IKPI</option>
                                            <option value="INDOPLAT">INDOPLAT</option>
                                            <option value="INOAC">INOAC</option>
                                            <option value="KITADA">KITADA</option>
                                            <option value="KOITO">KOITO</option>
                                            <option value="MANDIRI">MANDIRI</option>
                                            <option value="MITSUYOSHI">MITSUYOSHI</option>
                                            <option value="NIJES">NIJES</option>
                                            <option value="NISSHO">NISSHO</option>
                                            <option value="OPSINDO">OPSINDO</option>
                                            <option value="PARAGON">PARAGON</option>
                                            <option value="RPT">RPT</option>
                                            <option value="SMI">SMI</option>
                                            <option value="SUGITY">SUGITY</option>
                                            <option value="TENMA">TENMA</option>
                                            <option value="THAI SUMMIT">THAI SUMMIT</option>
                                            <option value="YEMI">YEMI</option>
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
                                        <select name="Resin-plastic" class="form-control" required="">
                                        <option value="">Resin-Plastic</option>
                                        <option value="ABS">ABS</option>
                                        <option value="PP">PP</option>
                                        <option value="PC">PC</option>
                                        <option value="PA66">PA66</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select name="cosmetic" class="form-control" required="">
                                            <option value="">Pilih Cosmetic</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
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
                                    <div class="form-group form-primary">
                                        <select name="Mold-Design-Type" class="form-control" required="">
                                            <option value="">Pilih Mold-Design-Type</option>
                                            <option value="2P">2-Plate</option>
                                            <option value="3P">3-Plate</option>
                                            <option value="4P">4-Plate</option>
                                            <option value="HR">Hot-Runner</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select name="Hot-Runner-System" class="form-control" required="">
                                            <option value="">Pilih Hot-Runner-System</option>
                                            <option value="YUDO">YUDO</option>
                                            <option value="HOTPLUS">HOTPLUS</option>
                                            <option value="HOTSYS">HOTSYS</option>
                                            <option value="MOLD-MASTER">MOLD-MASTER</option>
                                            <option value="YUDO-INDONESIA">YUDO-INDONESIA</option>
                                            <option value="NOTYET">NOTYET</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select name="Mold-Base-Order-Company" class="form-control" required="">
                                            <option value="">Pilih Mold-Base-Order-Company</option>
                                            <option value="GAYA">GAYA</option>
                                            <option value="SURYAMAS">SURYAMAS</option>
                                            <option value="SEHYUN">SEHYUN</option>
                                            <option value="BUMHAN(KOREA)">BUMHAN(KOREA)</option>
                                            <option value="BMT(CHINA)">BMT(CHINA)</option>
                                            <option value="JXMould(CHINA)">JXMould(CHINA)</option>
                                            <option value="PJM">PJM</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="number" name="Weight" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Weight</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="number" name="price-mold" step="0.01" class="form-control" required="" placeholder="=> Masukkan harga dalam format xx.xx">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Price-Mold</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select name="remark" class="form-control" required="">
                                            <option value="">Pilih Remark</option>
                                            <option value="Mahal">Mahal</option>
                                            <option value="Murah">Murah</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                  
                                    <div class="form-group form-primary">
                                        <button class="btn btn-out waves-effect waves-light btn-primary btn-square" name="save"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footerforcontent'); ?>
