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
      <i class="fa fa-home" aria-hidden="true"></i></a>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" style="text-align: center;">
      <!-- <li style="margin-left: 32rem;">.</li>   -->
      <!-- <li class="<?php if($this->uri->segment(1) == ""){echo "active";} ?>">
          <a href="<?php echo base_url() ?>">Beranda</a>
        </li> -->
        <!-- <li class="<?php if($this->uri->segment(1) == "event"){echo "active";} ?>">
          <a href="<?php echo base_url('event') ?>">Acara</a>
        </li> -->
        <!-- <li class="<?php if($this->uri->segment(1) == "about"){echo "active";} ?>">
          <a href="<?php echo base_url('about') ?>">Tentang</a>
        </li> -->
         <!-- Tambahkan link Hubungi Kami di sini -->
         <!-- <li class="<?php if($this->uri->segment(1) == "contact"){echo "active";} ?>">
          <a href="<?php echo base_url('contact') ?>">Hubungi Kami</a>
        </li> -->
        <!-- <li class="<?php if($this->uri->segment(1) == "lapangan"){echo "active";} ?>">
          <a href="<?php echo base_url('lapangan') ?>">Lapangan</a>
        </li> -->
        
       
      </ul>

      <?php if($this->session->userdata('usertype') != NULL): ?>
        <ul class="nav navbar-nav navbar-right">
          
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Halo, <?php echo $this->session->userdata('username') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('auth/profil') ?>"><i class="fas fa-user"></i> Profil Saya</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo base_url('auth/logout') ?>" style="color:red;"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
          </li>
          <li class="<?php if($this->uri->segment(1) == 'cart/history' && $this->uri->segment(2) == '') { echo 'active'; } ?>">
    <a href="<?php echo base_url('cart/history') ?>">
        <i class="fas fa-history"></i>
    </a>
</li>
          <li class="<?php if($this->uri->segment(1) == 'cart' && $this->uri->segment(2) == '') { echo 'active'; } ?>">
    <a href="<?php echo base_url('cart') ?>">
        <i class="fas fa-shopping-cart"></i>
    </a>
</li>

        </ul>
      <?php else: ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('auth/login') ?>">Login</a></li>
        </ul>
      <?php endif; ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    .navbar-default .navbar-nav > li > a:hover {
      color: #EB7622; /* Ubah ke warna yang diinginkan */
    }

    .navbar-brand:hover a{
    color: #EB7622;
}

.navbar-brand a{
    color: #ffffff; /* Warna default */
    transition: color 0.3s ease; /* Efek transisi warna */
}

.navbar-brand:hover i{
    color: #EB7622; /* Warna hover */
}

  </style>
</nav>
