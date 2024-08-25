<?=$this->extend("layout")?>
  
<?=$this->section("content")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= base_url('/loginstyle.css');?>"> 

    <div class="jumbotron">
            <div class="card">
                <div class="card-body">
                <div class="d-grid gap-2">
                <center> <h1 class="bi-person"></h1> </Center>
                </div>
                    <center> <h3 class="card-title mb-4">Sign In</h3> </center>
                    <a> <div class="login-box">
                    <span></span>
                    <br>
                    <span></span>
                    <?php if(session()->getFlashdata('error')):?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif;?>
                    <form action="<?php echo base_url('/useradmin/login'); ?>" method="post">
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email User</label>
                            <div class="input-group">
                            <input type="user_email" class="form-control" id="user_email" name="user_email" placeholder="Masukkan E-mail user anda">
                            <a href="" class="input-group-text"><i class="bi bi-person" ></i></a>

                        </div>
                       
                            <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Masukkan password anda">
                                    <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                             <button type="submit" name= "login" class="btn btn-primary btn-block">
                             Login </button>  
                        </div>
                        <br>
                        <center> <a type="submit" name= "cancel"  href="<?= base_url('homepjm');?>" class="btn btn-danger btn-block">Cancel </a> </center>
                        </div>
                    </form>
                    
                    </a>
                </div>
            </div>
        </div>
    </div>
     
</div>

</div>
                    
</body>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "bi bi-eye-slash" );
                    $('#show_hide_password i').removeClass( "bi bi-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "bi bi-eye-slash" );
                    $('#show_hide_password i').addClass( "bi bi-eye" );
                }
            });
            });
        </script>

<?=$this->endSection()?>