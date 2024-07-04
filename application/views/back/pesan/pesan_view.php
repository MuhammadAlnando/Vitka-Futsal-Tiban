<?php $this->load->view('back/meta'); ?>
<div class="wrapper">
    <?php $this->load->view('back/navbar'); ?>
    <?php $this->load->view('back/sidebar'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo $title; ?></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informasi Pesan</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive no-padding">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 200px;">Nama Pengirim:</th>
                                    <td><?php echo isset($pesan_detail['nama_pengirim']) ? $pesan_detail['nama_pengirim'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Subjek:</th>
                                    <td><?php echo isset($pesan_detail['subjek']) ? $pesan_detail['subjek'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Isi Pesan:</th>
                                    <td><?php echo isset($pesan_detail['pesan']) ? $pesan_detail['pesan'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal:</th>
                                    <td><?php echo isset($pesan_detail['tanggal']) ? date('d-m-Y H:i:s', strtotime($pesan_detail['tanggal'])) : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo base_url('admin/pesan'); ?>" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('back/footer'); ?>
</div>

<?php $this->load->view('back/js'); ?>
<!-- Data Tables -->
<link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
    });
</script>
