<?php $this->load->view('back/meta') ?>
<div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo $title ?></h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : ''; ?>
                            <div class="mb-3" style="margin-bottom: 15px;">
                                <button id="printToday" class="btn btn-info">Print Hari Ini</button>
                                <button id="printWeek" class="btn btn-info">Print Minggu Ini</button>
                                <button id="printMonth" class="btn btn-info">Print Bulan Ini</button>
                                <button id="printYear" class="btn btn-info">Print Tahun Ini</button>
                            </div>
                            <div class="table-responsive no-padding">
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No.</th>
                                            <th style="text-align: center">Invoice</th>
                                            <th style="text-align: center">Atas Nama</th>
                                            <th style="text-align: center">Dibuat</th>
                                            <th style="text-align: center">Grand Total</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">Bukti Pembayaran</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($get_all as $data) { ?>
                                        <tr>
                                            <td style="text-align:center"><?php echo $no++ ?></td>
                                            <td style="text-align:center"><?php echo $data->id_invoice ?></td>
                                            <td style="text-align:center"><?php echo $data->name ?></td>
                                            <td style="text-align:center"><?php echo tgl_indo($data->created_date) ?></td>
                                            <td style="text-align:center"><?php echo number_format($data->grand_total) ?></td>
                                            <td style="text-align:center">
                                                <?php
                                                switch ($data->status) {
                                                    case '0':
                                                        echo '<button type="button" class="btn btn-primary"><i class="fa fa-ban"></i> BELUM CHECKOUT</button>';
                                                        break;
                                                    case '1':
                                                        echo '<button type="button" class="btn btn-warning"><i class="fa fa-minus-circle"></i> BELUM LUNAS</button>';
                                                        break;
                                                    case '2':
                                                        echo '<button type="button" class="btn btn-success"><i class="fa fa-check"></i> LUNAS</button>';
                                                        break;
                                                    case '3':
                                                        echo '<button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> DITOLAK/EXPIRED</button>';
                                                        break;
                                                    case '5':
                                                        echo '<button type="button" class="btn btn-warning"><i class="fa fa-minus-circle"></i> MENUNGGU</button>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align:center">
                                                <?php if ($data->bukti_pembayaran) { ?>
                                                <a href="<?php echo base_url('assets/images/transaksi/'.$data->bukti_pembayaran) ?>" target="_blank">
                                                    <img src="<?php echo base_url('assets/images/transaksi/'.$data->bukti_pembayaran) ?>" width="50">
                                                </a>
                                                <?php } else { ?>
                                                <span>Tidak ada bukti</span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center">
    <?php if($data->status != '2' && $data->status != '3' && $data->status != '0'){ ?>
        <a href="<?php echo base_url('admin/transaksi/set_lunas/'.$data->id_trans) ?>" class="btn btn-success"><i class="fa fa-check"></i>Lunas</a>
    <?php } ?>
    <?php if($data->status != '3' && $data->status != '2'){ ?>
        <a href="<?php echo base_url('admin/transaksi/set_tolak/'.$data->id_trans) ?>" class="btn btn-danger"><i class="fa fa-times"></i>Tolak</a>
    <?php } ?>
    <a href="<?php echo base_url('admin/transaksi/detail/'.$data->id_trans) ?>" class="btn btn-primary"><i class="fa fa-search-plus"></i></a>
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
<link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#datatable').DataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aaSorting": [[0,'desc']],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
    });

    $('#printToday').on('click', function() {
        printFilteredData('today');
    });

    $('#printWeek').on('click', function() {
        printFilteredData('week');
    });

    $('#printMonth').on('click', function() {
        printFilteredData('month');
    });

    $('#printYear').on('click', function() {
        printFilteredData('year');
    });

    function printFilteredData(period) {
        var url = '<?php echo base_url('admin/transaksi/print/') ?>' + period;
        window.open(url, '_blank');
    }
});
</script>
</body>
</html>
