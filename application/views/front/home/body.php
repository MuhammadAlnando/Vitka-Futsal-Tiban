<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <?php if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    } ?>
    <div style="text-align: center; margin-top: 50px; margin-bottom: 100px;">    
        <img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" style="width: 400px;">
    </div>    

    <h4 style="text-align: center; font-family: 'Arial', sans-serif;">Nikmati pengalaman Sewa lapangan</h4>
    <h4 style="text-align: center; font-family: 'Arial', sans-serif;">secara online dengan mudah dan cepat.</h4>
    <br><br>

    <div style="text-align: center; margin-bottom: 50px;">
        <img src="<?php echo base_url('assets/images/banner.jpeg'); ?>" alt="Promo Diskon 50%" style="width: 60%; height: auto; object-fit: cover;">
    </div>
    <?php $this->load->view('front/home/lapangan_new'); ?>

    
    <hr>
     <?php $this->load->view('front/page/contact'); ?>
    
	


</div>

<?php $this->load->view('front/footer'); ?>

<!-- Pastikan Anda sudah memuat Font Awesome di header Anda -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
