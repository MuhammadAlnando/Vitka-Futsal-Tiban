<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    

    <div class="col-lg-12"><h2>TRANSAKSI SELESAI</h2><hr>
			<h4>INVOICE NO. <?php echo $cart_finished_row->id_invoice ?> (<font color='red'>BELUM LUNAS</font>)</h4>
			<?php echo form_open('cart/download_invoice/'.$cart_finished_row->id_trans, array("target"=>"_blank")) ?>
				<button type="submit" name="download_invoice" class="btn btn-sm btn-success">Download Invoice</button>
			<?php echo form_close() ?>
			
			<br>

			<div class="row">
			  <div class="col-lg-12">
          <div class="box-body table-responsive padding">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
									<th style="text-align: center">No.</th>
                  <th style="text-align: center">Lapangan</th>
									<th style="text-align: center">Tanggal</th>
                  <th style="text-align: center">Mulai</th>
									<th style="text-align: center">Durasi</th>
									<th style="text-align: center">Selesai</th>
                  <th style="text-align: center">Total</th>
                </tr>
              </thead>
              <tbody>
              <?php $no=1; foreach ($cart_finished as $cart){ ?>
                <tr>
                  <td style="text-align:center"><?php echo $no++ ?></td>
                  <td style="text-align:left"><?php echo $cart->nama_lapangan ?></td>
									<td style="text-align:center"><?php echo tgl_indo($cart->tanggal) ?></td>
                  <td style="text-align:center"><?php echo $cart->jam_mulai ?></td>
									<td style="text-align:center"><?php echo $cart->durasi ?></td>
									<td style="text-align:center"><?php echo $cart->jam_selesai ?></td>
                  <td style="text-align:right"><?php echo number_format($cart->total) ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
  			  </div>
  			</div>
  		</div>

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered">
					  <tbody>
							<tr>
					      <th scope="row">SubTotal</th>
					      <td align="right">Rp</td>
								<td align="right"><?php echo number_format($cart_finished_row->subtotal) ?></td>
					    </tr>
							
							<tr>
					      <th scope="row">Grand Total</th>
					      <td align="right">Rp</td>
								<td align="right"><b><?php echo number_format($cart_finished_row->grand_total) ?></b></td>
					    </tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row">
					<label>Catatan:</label><br>
					<?php if($cart_finished_row->catatan != NULL){?>
			      <?php echo $cart_finished_row->catatan ?>
			    <?php } else{echo "-";} ?>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<hr><h4>Pembayaran</h4>
					<!-- Tombol untuk memicu modal -->
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal<?php echo  $cart_finished_row->id_trans; ?>">
        <i class="glyphicon glyphicon-upload"></i> Upload Bukti Pembayaran
    </button>
	
    <!-- Modal untuk upload bukti pembayaran -->
    <div class="modal fade" id="uploadModal<?php echo  $cart_finished_row->id_trans; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel<?php echo  $cart_finished_row->id_trans; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="uploadModalLabel<?php echo  $cart_finished_row->id_trans; ?>">Upload Bukti Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('cart/upload_bukti/') .  $cart_finished_row->id_trans; ?>" method="post" enctype="multipart/form-data">
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
					<p>Anda dapat melakukan pembayaran melalui nomor rekening kami dibawah ini:</p>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="text-align: center">No.</th>
								<th style="text-align: center">Bank</th>
								<th style="text-align: center">Atas Nama</th>
								<th style="text-align: center">No. Rekening</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($data_bank as $bank){ ?>
							<tr>
								<td align="center"><?php echo $no++ ?></td>
								<td align="center"><?php echo $bank->nama_bank ?></td>
								<td align="center"><?php echo $bank->atas_nama ?></td>
								<td align="center"><?php echo $bank->norek ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<hr><h4>PERHATIAN</h4><hr>
					<ul>
					<li>Jumlah yang harus Anda bayarkan adalah sebesar: Rp <b><?php echo number_format($cart_finished_row->grand_total) ?></b></li>
			      <li>Silahkan melakukan konfirmasi pembayaran ke halaman berikut ini, <a href="<?php echo base_url('contact') ?>">klik disini</a> atau langsung menghubungi kami ke customer service yang telah disediakan dan melampirkan foto bukti bayarnya.</li>
			      <li>Kami akan segera memproses pemesanan Anda setelah mendapatkan konfirmasi pembayaran segera mungkin.</li>
					</ul>
					<p align="center">~ Terima Kasih ~</p>
				</div>
			</div>
	  </div>
  </div>
</div>

<?php $this->load->view('front/footer'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#submit').on('click', function(e) {
        e.preventDefault();
        
        var formData = new FormData($('#contactForm')[0]);

        $.ajax({
            url: '<?php echo base_url("admin/transaksi/upload_bukti_pembayaran"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Success:', response);
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#notification').html('<div class="alert alert-success">' + res.message + '</div>');
                } else {
                    $('#notification').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
                $('#notification').html('<div class="alert alert-danger">Gagal mengupload bukti pembayaran.</div>');
            }
        });
    });
});
</script>
