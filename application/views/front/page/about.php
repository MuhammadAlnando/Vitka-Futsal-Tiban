<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <h2 class="mt-4 mb-4">PROFIL <?php echo strtoupper($company->company_name) ?></h2>
    <hr>

    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <?php if (empty($company->foto)) : ?>
                <img src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" class="img-fluid" alt="No Image" style="max-width: 100%; height: auto;">
            <?php else : ?>
                <img src="<?php echo base_url('assets/images/company/' . $company->foto . $company->foto_type) ?>" class="img-fluid" alt="<?php echo $company->company_name ?>" style="max-width: 100%; height: auto;">
            <?php endif; ?>
            <p style="text-align:left;"><strong>Lokasi:</strong></p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0683880503657!2d103.97571017310094!3d1.110910062301181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98b8dfaccab27%3A0xa988646eb2338a7f!2sVitka%20Futsal%20Tiban!5e0!3m2!1sid!2sid!4v1721286839237!5m2!1sid!2sid" width="350" height="210" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tentang <?php echo $company->company_name ?></h5>
                    <p class="card-text text-justify"><?php echo $company->company_desc ?></p>
                </div>
            </div><br>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li style="margin: 10px 0;"><i class="fas fa-map-marker-alt"></i> <?php echo $company->company_address ?></li>
                        <li style="margin: 10px 0;"><i class="fas fa-envelope"></i> <?php echo $company->company_email ?></li>
                        <li style="margin: 10px 0;"><i class="fas fa-phone"></i> 
                <?php if (!empty($kontak)) : ?>
                    <?php $nohp_list = array(); ?>
                    <?php foreach ($kontak as $contact) : ?>
                        <?php $nohp_list[] = $contact->nohp; ?>
                    <?php endforeach; ?>
                    <?php echo implode(' / ', $nohp_list); ?>
                <?php else: ?>
                    <span>No contact number available</span>
                <?php endif; ?>
            </li>
            
                        <?php if ($company->company_fax > 0) : ?>
                            <li style="margin: 10px 0;"><i class="fas fa-fax"></i> <?php echo $company->company_fax ?></li>
                        <?php endif; ?>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
