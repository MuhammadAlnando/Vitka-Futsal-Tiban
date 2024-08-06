<footer style="background-color: #223C95; color: white; padding: 20px 0; margin-bottom: -30px; margin-top: 30px;">
  <div class="container">
    <div class="row" style="margin-left: 50px;">
      <!-- Logo and Company Name -->
      <div class="col-md-4 text-center text-md-left mb-4" style="background-color:white; border-radius: 10px; height: 100px; padding: 10px; margin-top: 10px; width: 230px;">
        <?php if (isset($company)) : ?>
          <?php if (empty($company->foto)) : ?>
            <img src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" class="img-fluid" alt="No Image" style="max-width: 100px; height: auto;">
          <?php else : ?>
            <img src="<?php echo base_url('assets/images/company/' . $company->foto . $company->foto_type) ?>" class="img-fluid" alt="<?php echo $company->company_name ?>" style="max-width: 200px; height: auto; background-color: white;">
          <?php endif; ?>
        <?php endif; ?>
       
      </div>

      <!-- Contact Information -->
      <div class="col-md-4 mb-4" style="margin-left: 100px;">
        <h5>Informasi Kontak</h5>
        <ul class="list-unstyled">
          <?php if (isset($company)) : ?>
            <li style="display: flex; align-items: center; margin-bottom: 10px;">
  <i class="fas fa-map-marker-alt" style="font-size: 1.2em; margin-right: 10px;"></i>
  <a href="https://maps.app.goo.gl/cXdR6Y6XuG3aFtbw9" target="_blank" style="margin: 0; color: inherit; text-decoration: none;">
    <?php echo $company->company_address ?>
  </a>
</li>

            <li style="display: flex; align-items: center; margin-bottom: 10px;">
  <i class="fas fa-envelope" style="font-size: 1.2em; margin-right: 10px;"></i>
  <p style="margin: 0;">
    <?php if (!empty($company->company_email)) : ?>
      <a href="mailto:<?php echo $company->company_email; ?>" style="color: white; text-decoration: none;">
        <?php echo $company->company_email; ?>
      </a>
    <?php else: ?>
      No email address available
    <?php endif; ?>
  </p>
</li>

            <li style="display: flex; align-items: center; margin-bottom: 10px;">
  <i class="fas fa-phone" style="font-size: 1.2em; margin-right: 10px;"></i>
  <p style="margin: 0;">
    <?php if (!empty($kontak)) : ?>
      <?php $nohp_list = array(); ?>
      <?php foreach ($kontak as $contact) : ?>
        <?php
        // Format nomor telepon untuk WhatsApp
        $formatted_nohp = preg_replace('/[^0-9]/', '', $contact->nohp);
        $nohp_list[] = '<a href="https://wa.me/' . $formatted_nohp . '" target="_blank" style="color: white;">' . $contact->nohp . '</a>';
        ?>
      <?php endforeach; ?>
      <?php echo implode(' / ', $nohp_list); ?>
    <?php else: ?>
      No contact number available
    <?php endif; ?>
  </p>
</li>

            <?php if ($company->company_fax > 0) : ?>
              <li style="display: flex; align-items: center;">
                <i class="fas fa-fax" style="font-size: 1.2em; margin-right: 10px;"></i>
                <p style="margin: 0;"><?php echo $company->company_fax ?></p>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Description -->
      <div class="col-md-4 mb-4" style="margin-left: 20px;">
      <h5>Jam Operasional</h5>
        <?php if (isset($company)) : ?>
          <p style="text-align:left;"><?php echo $company->company_desc ?></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="row">
      <div class="col-lg-12 text-center">
        <hr style="border-color: white; margin: 10px;">
        <p style="margin: 0;">© 2024 Vitka <a href="#" style="color: #EB7622; text-decoration: none;">Futsal</a>. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
