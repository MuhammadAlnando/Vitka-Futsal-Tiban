<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2><?php echo strtoupper($event_detail->nama_event) ?></h2>
            <a href="<?php echo base_url('assets/images/event/').$event_detail->foto.$event_detail->foto_type ?>" title="<?php echo $event_detail->nama_event ?>">
                <img src="<?php echo base_url('assets/images/event/').$event_detail->foto.'_thumb'.$event_detail->foto_type ?>" alt="<?php echo $event_detail->nama_event ?>" class="img-responsive" style="width: 100%; height: auto;">
            </a>

            <p><?php echo $event_detail->deskripsi ?></p>
            
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
