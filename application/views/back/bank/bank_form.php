<?php $this->load->view('back/meta') ?>
<div class="wrapper">
  <?php $this->load->view('back/navbar') ?>
  <?php $this->load->view('back/sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $title ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          <div class="box box-primary">
            <div class="box-body">
              <form action="<?php echo isset($bank) ? base_url('admin/bank/update') : base_url('admin/bank/save'); ?>" method="post">
                <?php if (isset($bank)) { ?>
                  <input type="hidden" name="id" value="<?php echo $bank->id_bank; ?>">
                <?php } ?>
                <div class="form-group">
                  <label for="nama_bank">Nama Bank:</label>
                  <input type="text" name="nama_bank" class="form-control" value="<?php echo isset($bank) ? $bank->nama_bank : ''; ?>" required>
                </div>
                <div class="form-group">
                  <label for="atas_nama">Atas Nama:</label>
                  <input type="text" name="atas_nama" class="form-control" value="<?php echo isset($bank) ? $bank->atas_nama : ''; ?>" required>
                </div>
                <div class="form-group">
                  <label for="norek">No. Rekening:</label>
                  <input type="text" name="norek" class="form-control" value="<?php echo isset($bank) ? $bank->norek : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($bank) ? 'Update' : 'Simpan'; ?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php $this->load->view('back/footer') ?>
</div>
<?php $this->load->view('back/js') ?>
</body>
</html>
