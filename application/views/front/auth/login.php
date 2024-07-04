<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>
<?php echo $script_captcha; // javascript recaptcha ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row" style="min-height: 100vh;">
                <div class="col-lg-5 order-lg-2 d-flex align-items-center justify-content-center mb-3 mb-lg-0 h-100">
                    <img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" class="align-self-center" style="margin-top:14rem; width: 100%; max-width: 400px;">
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2>LOGIN</h2>
                    <p>Belum punya akun? Silahkan Register <a href="<?php echo base_url('auth/register') ?>">disini</a></p>
                    <hr><?php echo $message;?>
                    <?php echo form_open("auth/login");?>
                        <div class="form-group has-feedback">
                            <label>Email</label>
                            <?php echo form_input($identity) ?>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password</label>
                            <?php echo form_password($password); ?>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <p><?php echo $captcha ?></p>
                        <a href="#" data-toggle="modal" data-target="#pswreset" style="color: #223C95;">Lupa Password?</a>
                        <hr>
                        <div class="form-group">
    <button type="submit" name="submit" class="btn btn-primary" style="background-color: #223C95; border: none; width: 100%;">Login</button>
</div>

    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pswreset" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open("auth/forgot_password");?>
      <div class="modal-body">
        <div class="form-group">
          <label>Silahkan Masukkan Username Anda</label>
          <input class="form-control" name="identity" type="text" id="identity" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

