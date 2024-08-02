<!-- application/views/front/lapangan/lapangan_detail.php -->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>LAPANGAN</h2>
      <hr>
      <div class="row">
        <?php foreach($lapangan_new as $lapangan): ?>
          <div class="col-lg-4 mb-4"> <!-- Kolom untuk setiap lapangan -->
            
          <h3 class="card-title"><b><?= $lapangan->nama_lapangan ?></b></h3>
            <a href="<?= base_url('lapangan/detail/') . $lapangan->id_lapangan ?>" style="text-decoration: none;">
              <div class="card shadow-sm" style="height: 100%;">
                <?php if(empty($lapangan->foto)): ?>
                  <img class="card-img-top" src="<?= base_url('assets/images/no_image_thumb.png') ?>" style="height: 170px;">
                <?php else: ?>
                  <img class="card-img-top" src="<?= base_url('assets/images/lapangan/' . $lapangan->foto) ?>" style="height: 170px;">
                <?php endif; ?>
                <div class="card-body text-right" style="margin: 10px 57px 0 0;">
                  <button class="btn btn-sm btn-primary" style="background-color: #223C95; border: none; width: 100%;">
                    <b>Detail Lapangan</b>
                  </button>
                  
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

