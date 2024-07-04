<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <h2>PROFIL <?php echo strtoupper($company->company_name) ?></h2>
    <hr>

    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <?php if (empty($company->foto)) : ?>
                <img src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" class="img-fluid" style="max-width: 100%; height: auto;">
            <?php else : ?>
                <img src="<?php echo base_url('assets/images/company/' . $company->foto . $company->foto_type) ?>" class="img-fluid" title="<?php echo $company->company_name ?>" alt="<?php echo $company->company_name ?>" style="max-width: 100%; height: auto;">
            <?php endif; ?>
        </div>

        <div class="col-md-8" style="padding-left: 100px;">
        <p><b>Tentang:</b><br>
            <p class="text-justify"><?php echo $company->company_desc ?></p>

            <br>
            <p><b>Alamat:</b><br>
                <?php echo $company->company_address ?>
            </p>
            <p><b>Email:</b><br>
                <?php echo $company->company_email ?>
            </p>
            <p><b>Telepon:</b><br>
                <?php echo $company->company_phone ?>
                <?php if ($company->company_phone2 > 0) {
                    echo " / " . $company->company_phone2;
                } ?>
            </p>
            <?php if ($company->company_fax > 0) : ?>
                <p><b>Fax:</b><br>
                    <?php echo $company->company_fax ?>
                </p>
            <?php endif; ?>
            
            <div class="text-center mt-4">
                <a href="<?php echo base_url('contact'); ?>" class="btn btn-primary" style="width: 100%; background-color: #223C95; border: none;">Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
