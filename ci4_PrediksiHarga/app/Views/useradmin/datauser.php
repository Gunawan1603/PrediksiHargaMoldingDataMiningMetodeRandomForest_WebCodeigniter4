<?= $this->include('template/adminheaderforcontent'); ?>

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
                                
                                <p class="text-right">
                                <a href="<?= base_url('/useradmin/register'); ?>" class="btn btn-out waves-effect waves-light btn-primary btn-square"><i class="fa fa-plus"></i> Registrasi</a>
                                </p>
                            </div>
                            
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="datatableFbr" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Email-User</th>
                                                <th>User-Password</th>
                                                <th>Level-Role</th>
                                                <th>User-Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if($users): foreach($users as $row): 
                                        
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $no++; ?></th>
                                                    <td class="text-center"><?= $row['user_id']; ?></td>
                                                    <td><?= $row['user_name']; ?></td>
                                                    <td><?= $row['user_email']; ?></td>
                                                    <td><?= $row['user_password'] ?></td>
                                                    <td><?= $row['role'] ?></td>
                                                    <td><?= $row['user_created_at'] ?></td>
                                                    <td>
                                                        <a href="<?= base_url('users/edit/'.$row['user_id']); ?>" class="btn btn-sm waves-effect waves-light btn-primary btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="<?= base_url('users/delete/'.$row['user_id']); ?>" class="btn btn-sm waves-effect waves-light btn-danger btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; else: ?>
                                                <tr>
                                                    <td colspan="8">Tidak ada data</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div> <?php // end of table-responsive ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footerforcontent'); ?>