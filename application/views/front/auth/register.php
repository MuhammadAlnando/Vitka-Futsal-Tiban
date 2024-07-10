<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <h2 class="card-header">REGISTER</h2>
                <div class="card-body">
                    <p class="card-text">Sudah punya akun? Silahkan <a href="<?php echo base_url('auth/login') ?>">Login disini</a></p>
                    <?php echo $message; ?>
                    <?php echo form_open("auth/register"); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <?php echo form_input($name, '', 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <?php echo form_password($password, '', 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <label>No. Hp</label>
                                    <?php echo form_input($phone, '', 'class="form-control"'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <?php echo form_input($username, '', 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <?php echo form_password($password_confirm, '', 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <?php echo form_input($email, '', 'class="form-control"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <?php echo form_textarea($alamat, '', 'class="form-control" rows="3"'); ?>
                        </div>
                        <div class="row">
          <div class="col-sm-6"><label>Provinsi</label>
            <?php echo form_dropdown('', $ambil_provinsi, '', $provinsi_id); ?><br>
          </div>
          <div class="col-sm-6"><label>Kabupaten/ Kota</label>
            <?php echo form_dropdown('', array(''=>'- Pilih Kota -'), '', $kota_id); ?>
          </div>
        </div>
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-warning">Cancel</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>

<script type="text/javascript">
    function tampilKota() {
        provinsi_id = document.getElementById("provinsi_id").value;
        $.ajax({
            url: "<?php echo base_url();?>auth/pilih_kota/" + provinsi_id,
            success: function(response) {
                $("#kota_id").html(response);
            },
            dataType: "html"
        });
        return false;
    }
</script>
