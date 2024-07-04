<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	

	<div class="row">
		<div class="col-md-8"><h1>Kategori: <?php echo ucfirst($this->uri->segment(3)) ?></h1><hr>
			<?php foreach($kategori_data as $kategori){ ?>
				<h2><a href="<?php echo base_url('event/').$kategori->slug_event ?>"><?php echo $kategori->nama_event ?></a></h2>
				<a href="<?php echo base_url("event/$kategori->slug_event ") ?>">
					<?php
					if(empty($kategori->foto)) {echo "<img class='img-responsive' src='".base_url()."assets/images/no_image_thumb.png'>";}
					else { echo " <img class='img-responsive' src='".base_url()."assets/images/event/".$kategori->foto.'_thumb'.$kategori->foto_type."'> ";}
					?>
				</a>
				<p>
					<i class="fa fa-user"></i> <?php echo $kategori->created_by ?>
					<i class="fa fa-calendar"></i> <?php echo date("j F Y", strtotime($kategori->created_at)); ?>
				</p>
				<p><?php echo character_limiter($kategori->deskripsi,350) ?></p>
				<a class="btn btn-sm btn-primary" style="background-color: #223C95;" href="<?php echo base_url("event/$kategori->slug_event ") ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
			<?php } ?>
			<div align="center"><?php echo $this->pagination->create_links() ?></div>
		</div>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>
