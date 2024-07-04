<?php $this->load->view('back/meta'); ?>
<div class="wrapper">
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Daftar Pesan</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Semua Pesan</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengirim</th>
                            <th>Subjek</th>
                            <th>Isi Pesan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesan_list)) {
                            foreach ($pesan_list as $key => $pesan) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo isset($pesan['nama_pengirim']) ? $pesan['nama_pengirim'] : ''; ?></td>
                                    <td><?php echo isset($pesan['subjek']) ? $pesan['subjek'] : ''; ?></td>
                                    <td><?php echo isset($pesan['pesan']) ? $pesan['pesan'] : ''; ?></td>
                                    <td><?php echo isset($pesan['tanggal']) ? date('d-m-Y H:i:s', strtotime($pesan['tanggal'])) : ''; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/pesan/view/'.$pesan['id']); ?>" class="btn btn-xs btn-primary">Lihat</a>
                                        <a href="<?php echo base_url('admin/pesan/delete/'.$pesan['id']); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin ingin menghapus pesan ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5">Belum ada pesan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('back/footer'); ?>
</div>
<?php $this->load->view('back/js'); ?>

<!-- DATA TABLES -->
<link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "pageLength": 10 // Jumlah default data per halaman
        });
    });
</script>

</body>
</html>
