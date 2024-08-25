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
                                //<h5><?= strtoupper($title); ?></h5>
                                
                                <p class="text-right">
                                
                                </p>
                            </div>
                            
                            <div class="card-block">
                                <!-- 
                                    // ===========================================================
                                    // =============== You Can Place the Data Here ===============
                                    // ===========================================================
                                -->
                                <?php 
                                foreach($data as $row): 
                                
                                ?>
                                
                                <form class="form-material" action="<?= base_url('user/datasetuser/update/'.$row['id']) ?>" method="POST">
                                    <div class="form-group form-info form-static-label">
                                        <input type="text" name="grade-mold" class="form-control" value="<?= $row['grade-mold']; ?>" 
                                        <span class="form-bar"></span>
                                        <label class="float-label">Grade-Mold | <i class="fa fa-ban"></i></label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="grade-mold" class="form-control" value="<?= $row['grade-mold']; ?>" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Grade-mold</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="customer" class="form-control" value="<?= $row['customer']; ?>" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">customer</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="part-application" class="form-control" value="<?= $row['part-application']; ?>" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Part-application</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="qty-produk" class="form-control" value="<?= $row['qty-produk']; ?>" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Qty-Product</label>
                                    </div>
                                    
                                    <div class="form-group form-primary">
                                        <textarea name="cosmetic" class="form-control" required=""><?= $row['cosmetic']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Cosmetic</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <textarea name="Tonase" class="form-control" required=""><?= $row['Tonase']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Tonase</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <textarea name="Resin-plastic" class="form-control" required=""><?= $row['Resin-plastic']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Resin-plastic</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Cavity-Material" class="form-control" required=""><?= $row['Cavity-Material']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Cavity-Material</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Core-Material" class="form-control" required=""><?= $row['Core-Material']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Core-Material</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Slide-System" class="form-control" required=""><?= $row['Slide-System']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Slide-System</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Lift-Core-System" class="form-control" required=""><?= $row['Lift-Core-System']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Lift-Core-System</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Mold-Design-Type" class="form-control" required=""><?= $row['Mold-Design-Type']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Mold-Design-Type</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Hot-Runner-System" class="form-control" required=""><?= $row['Hot-Runner-System']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Hot-Runner-System</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <textarea name="Mold-Base-Order-Company" class="form-control" required=""><?= $row['Mold-Base-Order-Company']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Mold-Base-Order-Company</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <textarea name="Weight" class="form-control" required=""><?= $row['Weight']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Weight</label>
                                    </div>

                                    <div class="form-group form-primary">
                                      <input type="number" name="price-mold" step="0.01" class="form-control" value="<?= $row['price-mold']; ?>" required="">
                                       <span class="form-bar"></span>
                                       <label class="float-label">Price-Mold</label>
                                     </div>

                                    <div class="form-group form-primary">
                                        <textarea name="remark" class="form-control" required=""><?= $row['remark']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Remark</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <button class="btn btn-out waves-effect waves-light btn-primary btn-square" name="save"><i class="fa fa-save"></i> Update</button>
                                </form>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footerforcontent'); ?>