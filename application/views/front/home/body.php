<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
<?php if ($this->session->flashdata('message')) {
		echo $this->session->flashdata('message');
	} ?>
<div style="text-align: center; margin-top: 50px">	
<img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" style="width: 400px;">
</div>	
<div style="text-align: center; margin: 50px 0 50px 0">
		<a href="<?php echo base_url('lapangan'); ?>"> <!-- Link to lapangan_view -->
		<button class="btn btn-primary" style="background-color: #223C95; border: none;">Booking Sekarang</button>

		</a>
	</div>

	<h4 style="text-align: center;">Nikmati pengalaman booking lapangan</h4>
	<h4 style="text-align: center;">dan berbagai acara menarik dengan mudah dan cepat.</h4>
	<hr>
	<hr>
	
	<?php $this->load->view('front/home/slider'); ?>
	<?php $this->load->view('front/home/event_new'); ?>

</div>

<?php $this->load->view('front/footer'); ?>