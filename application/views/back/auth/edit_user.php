<?php $this->load->view('back/meta') ?>
<?php $this->load->view('back/navbar') ?>
<?php $this->load->view('back/sidebar') ?>

<!-- application/views/back/edit_user.php -->
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo $title ?></h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('admin/auth/update_user/'.$user->id); ?>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" value="<?php echo set_value('name', $user->name); ?>">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo set_value('username', $user->username); ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo set_value('email', $user->email); ?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address"><?php echo set_value('address', $user->address); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo set_value('phone', $user->phone); ?>">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Password Confirm</label>
                                <input type="password" class="form-control" name="password_confirm">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="<?php echo base_url('admin/auth'); ?>" class="btn btn-default">Kembali</a>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php $this->load->view('back/footer') ?>
</div>
<?php $this->load->view('back/js') ?>
