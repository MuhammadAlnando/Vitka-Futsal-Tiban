<?php $this->load->view('back/meta') ?>
<?php $this->load->view('back/navbar') ?>
<?php $this->load->view('back/sidebar') ?>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><?php echo $title ?></h1>
      </section>
      <!-- Main content -->
      <?php $this->load->view('back/record'); ?>
      <?php $this->load->view('back/stats'); ?>
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div><!-- ./wrapper -->
  <?php $this->load->view('back/js') ?>
</body>
</html>
