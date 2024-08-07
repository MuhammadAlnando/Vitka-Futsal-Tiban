<style>
  footer {
    background-color: #223C95;
    color: white;
    padding: 20px 0;
    margin-bottom: -30px;
    margin-top: 30px;
  }
  
  footer .container {
    padding: 0;
  }
  
  footer .row {
    margin-left: 50px;
  }
  
  .footer-logo {
    background-color: white;
    border-radius: 10px;
    height: 100px;
    padding: 10px;
    margin-top: 10px;
    width: 230px;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }
  
  .footer-logo:hover {
    background-color: #f0f0f0;
    transform: scale(1.05);
  }

  .footer-contact h5 {
    margin-bottom: 15px;
  }
  
  .footer-contact ul {
    padding-left: 0;
  }
  
  .footer-contact li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .footer-contact i {
    font-size: 1.2em;
    margin-right: 10px;
  }
  
  .footer-contact a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .footer-contact a:hover {
    color: #EB7622;
  }
  
  .footer-description h5 {
    margin-bottom: 15px;
  }
  
  .footer-description p {
    text-align: left;
  }
  
  .footer-bottom {
    text-align: center;
  }
  
  .footer-bottom p a {
    color: #EB7622;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .footer-bottom p a:hover {
    color: #ffffff;
  }
</style>

<footer>
  <div class="container">
    <div class="row">
      <!-- Logo and Company Name -->
      <div class="col-md-4 mb-4 footer-logo">
        <?php if (isset($company)) : ?>
          <?php if (empty($company->foto)) : ?>
            <img src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" class="img-fluid" alt="No Image" style="max-width: 100px; height: auto;">
          <?php else : ?>
            <img src="<?php echo base_url('assets/images/company/' . $company->foto . $company->foto_type) ?>" class="img-fluid" alt="<?php echo $company->company_name ?>" style="max-width: 200px; height: auto; background-color: white;">
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <!-- Contact Information -->
      <div class="col-md-4 mb-4 footer-contact" style="margin-left:100px;">
        <h5>Informasi Kontak</h5>
        <ul class="list-unstyled">
          <?php if (isset($company)) : ?>
            <li>
              <i class="fas fa-map-marker-alt"></i>
              <a href="https://maps.app.goo.gl/cXdR6Y6XuG3aFtbw9" target="_blank">
                <?php echo $company->company_address ?>
              </a>
            </li>
            <li>
              <i class="fas fa-envelope"></i>
              <p>
                <?php if (!empty($company->company_email)) : ?>
                  <a href="mailto:<?php echo $company->company_email; ?>">
                    <?php echo $company->company_email; ?>
                  </a>
                <?php else: ?>
                  No email address available
                <?php endif; ?>
              </p>
            </li>
            <li>
              <i class="fas fa-phone"></i>
              <p>
                <?php if (!empty($kontak)) : ?>
                  <?php $nohp_list = array(); ?>
                  <?php foreach ($kontak as $contact) : ?>
                    <?php
                    $formatted_nohp = preg_replace('/[^0-9]/', '', $contact->nohp);
                    $nohp_list[] = '<a href="https://wa.me/' . $formatted_nohp . '" target="_blank">' . $contact->nohp . '</a>';
                    ?>
                  <?php endforeach; ?>
                  <?php echo implode(' / ', $nohp_list); ?>
                <?php else: ?>
                  No contact number available
                <?php endif; ?>
              </p>
            </li>
            <?php if ($company->company_fax > 0) : ?>
              <li>
                <i class="fas fa-fax"></i>
                <p><?php echo $company->company_fax ?></p>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Description -->
      <div class="col-md-4 mb-4 footer-description">
        <h5>Jam Operasional</h5>
        <?php if (isset($company)) : ?>
          <p><?php echo $company->company_desc ?></p>
        <?php endif; ?>
      </div>
      
    </div>
    <hr style="border-color: white; margin: 10px;">
    <!-- Footer Bottom -->
    <div class="row footer-bottom">
      <div class="col-lg-12">
       
        <p style="margin: 0;">© 2024 Vitka <a href="#">Futsal</a>. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
