<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url('assets/template/backend/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE CSS -->
    <link href="<?php echo base_url('assets/template/backend/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png'); ?>" />
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            width: 360px;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .login-logo {
            margin-bottom: 20px;
        }
        .login-logo b {
            font-size: 24px;
        }
        .btn-primary {
            background-color: #223C95;
            border-color: #223C95;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #1a2a6b;
            border-color: #1a2a6b;
        }
        .modal-header .close {
            color: #000;
        }
    </style>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery-3.3.1.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('assets/template/backend/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <?php echo $script_captcha; // JavaScript reCAPTCHA ?>
</head>
<body class="login-page">

    <div class="login-box">
        <div class="login-logo text-center">
            <p class="text-center">Admin Login</p>
            <hr>
        </div>
        <?php echo $message; ?>
        <?php echo form_open("admin/auth/login"); ?>
            <div class="form-group has-feedback">
                <?php echo form_input($identity, '', ['class' => 'form-control', 'placeholder' => 'Username']); ?>
                <span class="fas fa-user form-control-feedback" style="margin-top: 10px;"></span>
            </div>
            <div class="form-group has-feedback">
                <?php echo form_password($password, '', ['class' => 'form-control', 'placeholder' => 'Password']); ?>
                <span class="fas fa-lock form-control-feedback" style="margin-top: 10px;"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p><?php echo $captcha; ?></p>
                    <!-- <p><a href="#" data-toggle="modal" data-target="#pswreset"><b>Lupa Password?</b></a></p> -->
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div><!-- /.login-box -->

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
                            <label for="identity">Silahkan masukkan Email Anda</label>
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
