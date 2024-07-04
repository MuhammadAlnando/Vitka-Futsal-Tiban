<!-- application/views/front/lapangan/lapangan_view.php -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>LAPANGAN</h2>
      <hr>
      <div class="row">
        <?php foreach($lapangan_new as $lapangan){ ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="thumbnail">
              <?php
              if(empty($lapangan->foto)) {
                echo "<img class='card-img-top' src='".base_url()."assets/images/no_image_thumb.png'>";
              } else {
                echo "<img class='card-img-top' src='".base_url()."assets/images/lapangan/".$lapangan->foto."'>";
              }
              ?>
              <div class="caption">
                <p class="card-text"><b><?php echo $lapangan->nama_lapangan ?></b></p>
                <hr>
                <a href="<?php echo base_url('cart/buy/').$lapangan->id_lapangan ?>">
                  <button class="btn btn-sm btn-primary" style="background-color: #223C95; border: none;">
                    <i class="fa fa-shopping-cart"></i> <b>Rp <?php echo $lapangan->harga ?> /jam</b>
                  </button>
                </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
