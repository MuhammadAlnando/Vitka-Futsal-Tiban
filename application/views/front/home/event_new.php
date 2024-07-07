<hr>
<h3 align="center"><b>ACARA TERBARU</b></h3>
<hr>

<div class="container">
  <div class="row">
    <?php foreach($event_new as $event): ?>
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card shadow-sm" style="border-radius: 10px;">
          <a href="<?php echo base_url("event/$event->slug_event") ?>">
            <?php if(empty($event->foto)): ?>
              <img src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" class="card-img-top" style="border-radius: 10px 10px 0 0; width: 100%; height: auto;" alt="No Image">
            <?php else: ?>
              <img src="<?php echo base_url('assets/images/event/'.$event->foto.'_thumb'.$event->foto_type) ?>" class="card-img-top" style="border-radius: 10px 10px 0 0; width: 100%; height: auto;" alt="<?php echo $event->nama_event ?>">
            <?php endif; ?>
          </a>
          <div class="card-body">
            <h5 class="card-title"><a href="<?php echo base_url("event/$event->slug_event") ?>" style="color: black;"><?php echo character_limiter($event->nama_event, 100) ?></a></h5>
            <p><i class="fa fa-calendar"></i> <?php echo date("j F Y", strtotime($event->created_at)); ?></p>
            <p>
              <?php 
              $deskripsi = strip_tags($event->deskripsi);
              if (strlen($deskripsi) > 100) {
                $deskripsi = substr($deskripsi, 0, 100) . '...';
              }
              echo $deskripsi;
              ?>
            </p>
            <a href="<?php echo base_url("event/$event->slug_event") ?>" class="btn btn-sm btn-primary" style="background-color: #223C95; border: none;">Selengkapnya <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
