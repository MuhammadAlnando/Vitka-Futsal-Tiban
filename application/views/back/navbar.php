<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo base_url('admin/dashboard') ?>" class="logo" style="background-color: #222D32;">
    <span class="logo-mini"><b style="color: #fff;">VITKA</b></span>
    <span class="logo-lg"><b style="color: #EB7622;">VITKA FUTSAL</b></span>
  </a>

  <!-- Navbar -->
  <nav class="navbar navbar-static-top" role="navigation" style="background-color: #222D32;">
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Dropdown User -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i> Halo, <?php echo $this->session->userdata('name') ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User Name -->
            <li role="separator" class="divider"></li>
            <li><h4 style="text-align: center;"><?php echo $this->session->userdata('name') ?></h4></li>
            <li role="separator" class="divider"></li>
            <!-- Menu Items -->
            <li><a href="<?php echo base_url('admin/auth/edit_user/') . $this->session->userdata('user_id') ?>"><i class="fa fa-edit"></i> Edit Profil</a></li>
            <li><a href="<?php echo base_url('admin/auth/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
