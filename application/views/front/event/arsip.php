<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<style>
    .card {
        height: 100%;
    }

    .card-img-top {
        width: 100%;
        height: 200px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
        object-fit: cover; /* Untuk memastikan gambar terpotong jika perlu */
        border-radius: 10px 10px 0 0; /* Memberikan sudut melengkung di bagian atas */
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>SEMUA ACARA</h2>
            <hr>
            <div class="row">
                <?php foreach($event_all as $key => $event): ?>
                    <div class="col-md-4 mb-4" style="margin-bottom:50px;">
                        <div class="card shadow-sm">
                            <?php if(!empty($event->foto)): ?>
                                <a href="<?php echo base_url("event/$event->slug_event") ?>">
                                    <img class="card-img-top" src="<?php echo base_url('assets/images/event/'.$event->foto.'_thumb'.$event->foto_type) ?>" alt="<?php echo $event->nama_event ?>">
                                </a>
                            <?php else: ?>
                                <a href="<?php echo base_url("event/$event->slug_event") ?>">
                                    <img class="card-img-top" src="<?php echo base_url('assets/images/no_image_thumb.png') ?>" alt="<?php echo $event->nama_event ?>">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?php echo base_url('event/').$event->slug_event ?>" style="color: black;"><?php echo $event->nama_event ?></a></h5>
                              
                                <p class="card-text">
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
                    <?php 
                    // Tambahkan clearfix setiap 3 kolom untuk menangani baris baru
                    if (($key + 1) % 3 == 0): ?>
                        <div class="w-100"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <?php echo $this->pagination->create_links() ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
