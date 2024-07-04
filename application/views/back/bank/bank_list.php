<?php $this->load->view('back/meta') ?>
  <div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><?php echo $title ?></h1> <!-- Pastikan ini sesuai dengan variabel $title -->
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-primary">
              <div class="box-body">
                <a href="<?php echo base_url('admin/bank/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Bank</a>
                <hr>
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <div class="table-responsive no-padding">
                  <table id="datatable" class="table table-striped">
                    <thead>
                      <tr>
                        <th style="text-align: center">No.</th>
                        <th style="text-align: center">Nama Bank</th>
                        <th style="text-align: center">Atas Nama</th>
                        <th style="text-align: center">No. Rekening</th>
                        <th style="text-align: center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($data_bank as $bank){ ?>
                        <tr>
                          <td style="text-align: center"><?php echo $no++ ?></td>
                          <td style="text-align: center"><?php echo $bank->nama_bank ?></td>
                          <td style="text-align: center"><?php echo $bank->atas_nama ?></td>
                          <td style="text-align: center"><?php echo $bank->norek ?></td>
                          <td style="text-align: center">
                            <?php
                            echo anchor(site_url('admin/bank/edit/'.$bank->id_bank),'<i class="fa fa-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                            echo anchor(site_url('admin/bank/delete/'.$bank->id_bank),'<i class="fa fa-remove"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php $this->load->view('back/footer') ?>
  </div>
  <?php $this->load->view('back/js') ?>
  <!-- DATA TABLES-->
  <link href="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $('#datatable').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aaSorting": [[0,'desc']],
    "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
  });
  </script>
</body>
</html>
