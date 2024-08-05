<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>RIWAYAT SEWA</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Pesan sesi akan ditampilkan sebagai pop-up -->
                    <div id="notification" style="display: none;">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div id="notification_type" style="display: none;">
                        <?php echo $this->session->flashdata('message_type'); ?>
                    </div>
                    <div class="box-body table-responsive padding">
                        <?php if(empty($cek_cart_history->id_trans)): ?>
                            Anda belum ada transaksi <br><br><br><br><br><br><br>
                        <?php else: ?>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Invoice</th>
                                        <th style="text-align: center">Dibuat</th>
                                        <th style="text-align: center">Grand Total</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Lampiran</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($cart_history as $history): ?>
                                        <tr>
                                            <td style="text-align:center"><?php echo $no++ ?></td>
                                            <td style="text-align:center"><?php echo $history->id_invoice ?></a></td>
                                            <td style="text-align:center"><?php echo tgl_indo($history->created_date) ?></td>
                                            <td style="text-align:center"><?php echo number_format($history->grand_total) ?></a></td>
                                            <td style="text-align:center">
                                                <?php if($history->status == '1'): ?>
                                                    <button type="button" name="status" class="btn btn-danger">BELUM LUNAS</button>
                                                <?php elseif($history->status == '2'): ?>
                                                    <button type="button" name="status" class="btn btn-primary" style="background-color:forestgreen; border: none;">LUNAS</button>
                                                    <?php elseif($history->status == '3'): ?>
                                                        <button type="button" name="status" class="btn btn-danger">DITOLAK/EXPIRED</button>
                                                <?php elseif($history->status == '5'): ?>
                                                    <button type="button" name="status" class="btn btn-warning">MENUNGGU</button>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align:center">
                                            <?php if (empty($history->bukti_pembayaran)): ?>
                                                <!-- Tombol untuk memicu modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal<?php echo $history->id_trans; ?>">
                                                    <i class="glyphicon glyphicon-upload"></i> Upload Bukti Pembayaran
                                                </button>

                                                <!-- Modal untuk upload bukti pembayaran -->
                                                <div class="modal fade" id="uploadModal<?php echo $history->id_trans; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel<?php echo $history->id_trans; ?>">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="uploadModalLabel<?php echo $history->id_trans; ?>">Upload Bukti Pembayaran</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url('cart/upload_bukti/') . $history->id_trans; ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="bukti_pembayaran">Pilih File Bukti Pembayaran</label>
                                                                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- Jika sudah diupload, tampilkan gambar -->
                                                <img src="<?php echo base_url('assets/images/transaksi/') . $history->bukti_pembayaran; ?>" alt="Bukti Pembayaran" style="max-width: 100px; max-height: 100px;" />
                                            <?php endif; ?>
                                            </td>
                                            <td style="text-align:center">
                                                <a href="<?php echo base_url('cart/history_detail/') . $history->id_trans ?>">
                                                    <button name="update" class="btn btn-warning"><i class="glyphicon glyphicon-zoom-in"></i> Detail</button>
                                                </a>
                                                <!-- Tombol Cancel -->
                                                <?php if($history->status != '2' && $history->status != '3' && $history->status != '5'): ?>
                                                    <a href="<?php echo base_url('cart/cancel/') . $history->id_trans ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?');"><i class="glyphicon glyphicon-remove"></i> Batal</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Memeriksa apakah ada notifikasi dan menampilkannya sebagai pop-up
    document.addEventListener('DOMContentLoaded', function() {
        var message = document.getElementById('notification').innerText;
        var messageType = document.getElementById('notification_type').innerText;

        if (message) {
            if (messageType == 'success') {
                swal("Sukses", message, "success");
            } else if (messageType == 'error') {
                swal("Gagal", message, "error");
            }
        }
    });
</script>

<?php $this->load->view('front/footer'); ?>
