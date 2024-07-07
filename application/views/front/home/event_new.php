<hr><h3 align="center"><b>ACARA TERBARU</b></h3><hr>
<div class="container">
  <div class="row">
    <?php foreach($event_new as $event){ ?>
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="thumbnail" style="background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 15px;">
          <a href="<?php echo base_url("event/$event->slug_event") ?>">
            <?php
            if(empty($event->foto)) {
              echo "<img src='".base_url()."assets/images/no_image_thumb.png' style='width:100%; border-radius: 10px 10px 0 0;'>";
            } else {
              echo "<img src='".base_url()."assets/images/event/".$event->foto.'_thumb'.$event->foto_type."' style='width:100%; border-radius: 10px 10px 0 0;'>";
            }
            ?>
          </a>
          <div class="caption" style="padding: 10px;">
            <h4><a href="<?php echo base_url("event/$event->slug_event") ?>" style="color: black;"><?php echo character_limiter($event->nama_event,100) ?></a></h4>
            <i class="fa fa-calendar"></i> <?php echo date("j F Y", strtotime($event->created_at)); ?>
            <br><br>
            <p>
              <?php 
              $deskripsi = strip_tags($event->deskripsi);
              if (strlen($deskripsi) > 30) {
                $deskripsi = substr($deskripsi, 0, 30) . '...';
              }
              echo $deskripsi;
              ?>
            </p>
            <br>
            <p>
              <a href="<?php echo base_url("event/$event->slug_event") ?>">
                <button type="button" name="button" class="btn btn-sm btn-primary" style="background-color: #223C95; border: none;">Selengkapnya</button>
              </a>
            </p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
