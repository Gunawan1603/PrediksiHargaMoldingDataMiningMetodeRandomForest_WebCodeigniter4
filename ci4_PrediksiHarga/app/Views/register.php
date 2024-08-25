<?=$this->extend("layout")?>
  
<?=$this->section("content")?>
  
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Register</h5>
                    <form action="<?php echo base_url('/register'); ?>" method="post">
                    <div class="mb-3">
                            <label for="user_name" class="form-label">Nama user</label>
                            <input type="user_name" class="form-control" id="user_name" name="user_name" value="<?= set_value('user_name') ?>">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('user_name') ?></small>
                            <?php endif;?>
                        </div>
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email address</label>
                            <input type="user_email" class="form-control" id="user_email" name="user_email" value="<?= set_value('user_email') ?>">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('user_email') ?></small>
                            <?php endif;?>
                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="user_password" class="form-control" id="user_password" name="user_password">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('user_password') ?></small>
                            <?php endif;?>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="user_password" class="form-control" id="confirm_password" name="confirm_password">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                            <?php endif;?>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Level</label>
                            <input type="role" class="form-control" id="role" name="role">
                            <?php if(isset($validation)):?>
                                <small class="text-danger"><?= $validation->getError('role') ?></small>
                            <?php endif;?>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Register Now</button>
                            <p class="text-center">Have already an account <a href="<?php echo base_url('/login'); ?>">Login here</a><p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
</div>
  
<?=$this->endSection()?>