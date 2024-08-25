<?=$this->extend("layout")?>
  
<?=$this->section("content")?>

<style>
    .login-card {
        width: 400px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .user-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        display: block;
    }
</style>
    <div class="row justify-content-md-center mt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-body">                 
                   <div class="container">
                  
                     <div class="text-center">
                     <h3 class="mb-4">Login SI Prediksi Harga molding Random Forest</h3>
                     <img src="<?= base_url('assets/images/user.png'); ?>" alt="User Icon" class="user-icon">
                     </div>
                 
                    <h5 class="card-title mb-4">Sign In Admin</h5>
                    <?php if(session()->getFlashdata('error')):?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif;?>
                    <form action="<?php echo base_url('/login'); ?>" method="post">
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email address</label>
                            <input type="user_email" class="form-control" id="user_email" name="user_email">
                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="user_password" class="form-control" id="user_password" name="user_password">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <p class="text-center">Don't have account? <a href="<?php echo base_url('/register'); ?>">Register here</a><p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
</div>
  
<?=$this->endSection()?>