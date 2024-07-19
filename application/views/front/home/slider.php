<script src="<?php echo base_url('assets/plugins/slider/src/')?>slippry.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/slider/dist/')?>slippry.css" />

<div class="big-title" data-animation="fadeInDown" data-animation-delay="02">
    <ul id="thumbnails">
        <?php foreach($slider_data as $index => $slider): ?>
            <li>
                <a href="<?php echo $slider->link ?>" target="_self">
                    <img src="<?php echo base_url('assets/images/slider/') . $slider->foto . $slider->foto_type ?>">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?php echo base_url('lapangan'); ?>" class="btn btn-primary slider-button">Sewa Sekarang</a>
</div>


<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var thumbs = jQuery('#thumbnails').slippry({
            // general elements & wrapper
            slippryWrapper: '<div class="slippry_box thumbnails" />',
            // options
            transition: 'vertical',
            auto: true, // set to true for auto slideshow
            pause: 3000, // delay between slides in milliseconds (e.g. 3000 = 3 seconds)
            onSlideBefore: function (el, index_old, index_new) {
                jQuery('.thumbs a img').removeClass('active');
                jQuery('img', jQuery('.thumbs a')[index_new]).addClass('active');
            }
        });

        // Optional: Add navigation click handler (if needed)
        jQuery('.thumbs a').click(function () {
            thumbs.goToSlide($(this).data('slide'));
            return false;
        });
    });
</script>
<style>
    .slider-button {
        position: absolute;
        top: 150%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10; /* Pastikan z-index cukup tinggi agar tombol tampil di atas slider */
        background-color: #EB7622;
        border: none;
        padding: 10px 20px;
        color: white;
        text-decoration: none; /* Hapus dekorasi tautan */
    }
</style>


