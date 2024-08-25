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
                                
                                <form class="form-material" action="<?= base_url('users/update/'.$row['user_id']) ?>" method="POST">
                                    <div class="form-group form-info form-static-label">
                                        <input type="text" name="user_name" class="form-control" value="<?= $row['user_name']; ?>" 
                                        <span class="form-bar"></span>
                                        <label class="float-label">User Name | <i class="fa fa-ban"></i></label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="user_email" class="form-control" value="<?= $row['user_email']; ?>" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">User Email</label>
                                    </div>
                                    
                                    <div class="form-group form-primary">
                                        <textarea name="role" class="form-control" required=""><?= $row['role']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Level</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <textarea name="user_password" class="form-control" required=""><?= $row['user_password']; ?></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
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