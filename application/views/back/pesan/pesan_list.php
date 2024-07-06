<?php $this->load->view('back/meta') ?>
<div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo $title ?></h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <a id="delete-all" class="btn btn-sm btn-danger">&#x1F5D1;Hapus</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all-checkbox"></th>
                                <th>No</th>
                                <th>Nama Pengirim</th>
                                <th>Subjek</th>
                                <th>Isi Pesan</th>
                                <th>Lampiran</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesan_list)) {
                                foreach ($pesan_list as $key => $pesan) { ?>
                                    <tr>
                                        <td><input type="checkbox" class="select-checkbox" data-id="<?php echo $pesan['id']; ?>"></td>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo isset($pesan['nama_pengirim']) ? $pesan['nama_pengirim'] : ''; ?></td>
                                        <td><?php echo isset($pesan['subjek']) ? $pesan['subjek'] : ''; ?></td>
                                        <td><?php echo isset($pesan['pesan']) ? $pesan['pesan'] : ''; ?></td>
                                        <td>
                                            <?php if (!empty($pesan['lampiran'])): ?>
                                                <img src="<?php echo base_url('assets/images/pesan/') . $pesan['lampiran']; ?>" alt="lampiran" style="max-width: 100px;">
                                            <?php else: ?>
                                                Tidak ada lampiran
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo isset($pesan['tanggal']) ? date('d-m-Y H:i:s', strtotime($pesan['tanggal'])) : ''; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/pesan/view/'.$pesan['id']); ?>" class="btn btn-xs btn-primary">Lihat</a>
                                            <a href="<?php echo base_url('admin/pesan/delete/'.$pesan['id']); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin ingin menghapus pesan ini?')">Hapus</a>
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="8">Belum ada pesan.</td>
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
            "pageLength": 10
        });

        $('#select-all-checkbox').click(function() {
            var checked = this.checked;
            $('.select-checkbox').each(function() {
                this.checked = checked;
            });
        });

        $('#select-all').click(function() {
            $('.select-checkbox').prop('checked', true);
        });

        $('#delete-all').click(function() {
            var ids = [];
            $('.select-checkbox:checked').each(function() {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                if (confirm('Anda yakin ingin menghapus pesan yang dipilih?')) {
                    $.ajax({
                        url: '<?php echo base_url('admin/pesan/delete_multiple'); ?>',
                        type: 'POST',
                        data: {ids: ids},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan saat menghapus pesan.');
                        }
                    });
                }
            } else {
                alert('Tidak ada pesan yang dipilih.');
            }
        });
    });
</script>
