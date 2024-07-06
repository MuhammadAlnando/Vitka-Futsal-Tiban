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
								<a href="<?php echo base_url('admin/slider/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
								<hr>
								<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <div class="table-responsive no-padding">
									<table id="datatable" class="table table-striped">
										<thead>
											<tr>
												<th style="text-align: center">No. Urut</th>
												<th style="text-align: center">Nama <?php echo $module ?></th>
												<th style="text-align: center">Img</th>
												<th style="text-align: center">Aksi</th>
											</tr>
										</thead>
                    <tbody>
                      <?php $no=1; foreach($get_all as $data){ ?>
                        <tr>
                          <td style="text-align: center"><?php echo $no++ ?></td>
                          <td style="text-align: center"><?php echo $data->nama_slider ?></td>
                          <td style="text-align: center"><img src="<?php echo base_url('assets/images/slider/').$data->foto.$data->foto_type ?>" width="300px"></td>
                        
                          <td style="text-align: center">
                            <?php
                            echo anchor(site_url('admin/slider/update/'.$data->id_slider),'<i class="fa fa-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                            echo anchor(site_url('admin/slider/delete/'.$data->id_slider),'<i class="fa fa-remove"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
									</table>
                </div>
							</div>
						</div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div><!-- ./wrapper -->
  <?php $this->load->view('back/js') ?>
	<!-- DATA TABLES-->
  <link href="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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