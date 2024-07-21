<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <?php if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    } ?>
    <div style="text-align: center; margin-top: 50px; margin-bottom: 100px;">    
        <img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" style="width: 400px;">
    </div>    

    <h4 style="text-align: center;">Nikmati pengalaman Sewa lapangan</h4>
    <h4 style="text-align: center;">secara online dengan mudah dan cepat.</h4>
    <br><br>

    <div style="text-align: center; margin-bottom: 50px;">
        <img src="<?php echo base_url('assets/images/banner.jpeg'); ?>" alt="Promo Diskon 50%" style="width: 85%; height: auto; object-fit: cover;">
    </div>
    <div class="reasons" style="text-align: center; margin-top: 50px;">
        <h3>Kenapa Memilih Vitka Futsal Tiban?</h3>
		<br>
        <div class="reasons-container" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 20px;">
            <div class="reason" style="flex: 1; max-width: 300px; text-align: center; font-size: 18px;">
                <i class="fa fa-futbol-o" style="font-size: 24px; color: black;"></i>
                <h4 style="margin: 10px 0;">Fasilitas Berkualitas</h4>
                <p>Fasilitas lengkap untuk pengalaman bermain yang optimal.</p>
            </div>
            <div class="reason" style="flex: 1; max-width: 300px; text-align: center; font-size: 18px;">
                <i class="fas fa-calendar-check" style="font-size: 24px; color: black;"></i>
                <h4 style="margin: 10px 0;">Pemesan Mudah dan Cepat</h4>
                <p>Pesan lapangan secara online dengan cepat dan mudah kapan saja.</p>
            </div>
            <div class="reason" style="flex: 1; max-width: 300px; text-align: center; font-size: 18px;">
                <i class="fas fa-smile" style="font-size: 24px; color: black;"></i>
                <h4 style="margin: 10px 0;">Pelayanan Ramah</h4>
                <p>Siap membantu Anda dengan layanan yang ramah dan profesional.</p>
            </div>
        </div>
    </div>
	<br><br><br><br>
	<br>
	 <!-- <?php $this->load->view('front/home/event_new'); ?> -->
    
	<!--  -->


</div>

<?php $this->load->view('front/footer'); ?>

<!-- Pastikan Anda sudah memuat Font Awesome di header Anda -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
