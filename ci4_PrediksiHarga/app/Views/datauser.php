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
                                <div class="text-right">
                                    <!-- <a href="<?= base_url('/logoutregister'); ?>" class="btn btn-out waves-effect waves-light btn-primary btn-square"><i class="fa fa-plus"></i> Logout/Registrasi</a> -->
                                     <a href="<?php echo base_url('admin/loginadmin'); ?>" class="btn btn-out waves-effect waves-light btn-primary btn-square"><i class="fa fa-plus"></i> Logout/Registrasi</a>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="table-responsive">
                                    <div class="scrollable-table">
                                        <table id="datatableFbr" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Id</th>
                                                    <th>Name</th>
                                                    <th>Email-User</th>
                                                    <th>Level-Role</th>
                                                    <th>Password</th>
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
                                                        <td><?= $row['role'] ?></td>
                                                        <td><?= $row['user_password'] ?></td>
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
                                    </div> <?php // end of scrollable-table ?>
                                </div> <?php // end of table-responsive ?>
                            </div> <?php // end of card-block ?>
                        </div> <?php // end of card ?>
                    </div> <?php // end of col-sm-12 ?>
                </div> <?php // end of row ?>
            </div> <?php // end of page-body ?>
        </div> <?php // end of page-wrapper ?>
    </div> <?php // end of main-body ?>
</div> <?php // end of pcoded-inner-content ?>

<?= $this->include('template/footerforcontent'); ?>
