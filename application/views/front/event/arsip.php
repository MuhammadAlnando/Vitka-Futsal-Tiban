<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>SEMUA ACARA</h2>
            <hr>
            <div class="row">
                <?php foreach($event_all as $event): ?>
                    <div class="col-md-4 mb-4">
                        <div class="media d-flex flex-column align-items-start" style="background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 15px;">
                            <?php if(!empty($event->foto)): ?>
                                <a href="<?php echo base_url("event/$event->slug_event") ?>" class="mb-3">
                                    <img class="img-responsive" style="width: 100%; height: auto; border-radius: 10px 10px 0 0;" src="<?php echo base_url('assets/images/event/'.$event->foto.'_thumb'.$event->foto_type) ?>">
                                </a>
                            <?php else: ?>
                                <a href="<?php echo base_url("event/$event->slug_event") ?>" class="mb-3">
                                    <img class="img-responsive" style="width: 100%; height: auto; border-radius: 10px 10px 0 0;" src="<?php echo base_url('assets/images/no_image_thumb.png') ?>">
                                </a>
                            <?php endif; ?>
                            <div class="media-body">
                                <h3 class="mt-0"><a href="<?php echo base_url('event/').$event->slug_event ?>" style="color: black;"><?php echo $event->nama_event ?></a></h3>
                                <p><i class="fa fa-calendar"></i> <?php echo date("j F Y", strtotime($event->created_at)); ?></p>
                                <p>
                                    <?php 
                                    $deskripsi = strip_tags($event->deskripsi);
                                    if (strlen($deskripsi) > 30) {
                                        $deskripsi = substr($deskripsi, 0, 30) . '...';
                                    }
                                    echo $deskripsi;
                                    ?>
                                </p>
                                <a class="btn btn-sm btn-primary" style="background-color: #223C95; border: none;" href="<?php echo base_url("event/$event->slug_event") ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div align="center"><?php echo $this->pagination->create_links() ?></div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
