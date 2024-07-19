<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url('assets/template/backend/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE CSS -->
    <link href="<?php echo base_url('assets/template/backend/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery-3.3.1.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('assets/template/backend/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png'); ?>" />
    <?php echo $script_captcha; // javascript recaptcha ?>
</head>
<body class="login-page">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-box" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); border-radius: 10px;">
                    <div class="login-box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Form Login -->
                                <div class="login-logo" style="text-align: center;">
                                    <b>Admin</b> Login
                                    <hr>
                                </div>
                                <?php echo $message; ?>
                                <?php echo form_open("admin/auth/login"); ?>
                                    <div class="form-group has-feedback">
                                        <?php echo form_input($identity); ?>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <?php echo form_password($password); ?>
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p><?php echo $captcha ?></p>
                                            <!-- <p><a href="#" data-toggle="modal" data-target="#pswreset"><b>Lupa Password?</b></a></p> -->
                                            <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #223C95;">Sign In</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div><!-- /.login-box-body -->
                </div><!-- /.login-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container -->

    <!-- Modal Reset Password -->
    <div id="pswreset" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Reset Password</b></h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open("admin/auth/forgot_password"); ?>
                        <div class="form-group">
                            <label>Silahkan masukkan Email Anda</label>
                            <input class="form-control" name="identity" type="text" id="identity" />
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
