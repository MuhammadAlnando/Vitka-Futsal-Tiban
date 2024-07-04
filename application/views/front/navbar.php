<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #223C95">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url() ?>">
        <img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" width="100px" style="background-color: white; padding: 5px; border-radius: 12px; margin-top: -11px;">
    </a>
</div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" style="text-align: center;">
        <li class="<?php if($this->uri->segment(1) == ""){echo "active";} ?>">
          <a href="<?php echo base_url() ?>">Beranda</a>
        </li>
        <li class="<?php if($this->uri->segment(1) == "event"){echo "active";} ?>">
          <a href="<?php echo base_url('event') ?>">Acara</a>
        </li>
        <li class="<?php if($this->uri->segment(1) == "about"){echo "active";} ?>">
          <a href="<?php echo base_url('about') ?>">Tentang</a>
        </li>
        <li class="<?php if($this->uri->segment(1) == "lapangan"){echo "active";} ?>">
          <a href="<?php echo base_url('lapangan') ?>">Lapangan</a>
        </li>
        <li class="<?php if($this->uri->segment(1) == "cart" && $this->uri->segment(2) == ""){echo "active";} ?>">
          <a href="<?php echo base_url('cart') ?>">Pemesanan</a>
        </li>
      </ul>

      <?php if($this->session->userdata('usertype') != NULL): ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Halo, <?php echo $this->session->userdata('username') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('cart/history') ?>">Riwayat Booking</a></li>
              <li><a href="<?php echo base_url('auth/profil') ?>">Profil Saya</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo base_url('auth/logout') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      <?php else: ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('auth/register') ?>">Register</a></li>
          <li><a href="<?php echo base_url('auth/login') ?>">Login</a></li>
        </ul>
      <?php endif; ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  <style>
    .navbar-default .navbar-nav > li > a:hover {
      color: #EB7622; /* Ubah ke warna yang diinginkan */
    }
  </style>
</nav>
