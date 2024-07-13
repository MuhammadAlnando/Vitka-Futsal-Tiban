<!-- application/views/front/lapangan/lapangan_detail.php -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Detail Lapangan</h2>
            <hr>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm" style="height: 100%;" >
                        <?php if(empty($lapangan->foto)): ?>
                            <img class="card-img-top" src="<?= base_url('assets/images/no_image_thumb.png') ?>" style="height: 200px;">
                        <?php else: ?>
                            <img class="card-img-top" src="<?= base_url('assets/images/lapangan/' . $lapangan->foto) ?>" style="height: 300px;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm" style="height: 100%;" >
                        <div class="card-body">
                            <h3 class="card-title"><b><?= $lapangan->nama_lapangan ?></b></h3><hr>
                          
                            Harga: <strong style="color:red">Rp <?= $lapangan->harga ?></strong> / jam
                            <br>
                            <br>
                            <strong>Jadwal Hari ini:</strong> <br>
                            <div class="jam-mulai" id="jam_mulai_<?= $lapangan->id_lapangan ?>">
                                <!-- Tempat untuk menampilkan tanggal dan jam mulai -->
                            </div>

                            
                            <a href="<?= base_url('cart/buy/') . $lapangan->id_lapangan ?>" class="btn btn-primary" style="background-color: #223C95; border: none;">
                                <i class="fa fa-shopping-cart"></i> Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script untuk AJAX Call -->
<script>
$(document).ready(function() {
    var url = "<?php echo base_url('cart/getJamMulai'); ?>";
  
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var tanggal_sekarang = yyyy + '-' + mm + '-' + dd;
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            tanggal: tanggal_sekarang,
            lapangan_id: '<?= $lapangan->id_lapangan; ?>'
        },
        dataType: "json",
        success: function(data) {
            var jamMulaiHtml = '<p>';
            var jamSekarang = today.getHours() + ':' + today.getMinutes();
            var available = false; // Flag untuk mengecek ketersediaan jam
            
            $.each(data, function(index, value) {
                var jam_mulai = value.jam_mulai;
                
                if (compareTimes(jam_mulai, jamSekarang)) {
                    jamMulaiHtml += '<span class="jam-mulai-item">' + jam_mulai + '</span> ';
                    available = true;
                }
            });
            
            if (!available) {
                jamMulaiHtml = '<p><strong style="color: red;">Sold Out</strong></p>';
            } else {
                jamMulaiHtml += '</p>';
            }
            
            $('#jam_mulai_<?= $lapangan->id_lapangan ?>').html(jamMulaiHtml);
        }
    });
});

// Fungsi untuk membandingkan dua waktu (HH:MM)
function compareTimes(time1, time2) {
    var t1 = new Date();
    var parts1 = time1.split(':');
    t1.setHours(parts1[0], parts1[1], 0, 0);
    
    var t2 = new Date();
    var parts2 = time2.split(':');
    t2.setHours(parts2[0], parts2[1], 0, 0);
    
    return t1 > t2; // Mengembalikan true jika time1 > time2
}
</script>

<!-- Style untuk Border Jam Mulai -->
<style>
.jam-mulai-item {
    display: inline-block;
    padding: 5px 10px;
    margin: 5px;
    border: 1px solid #ddd; /* Ganti warna dan ketebalan border sesuai kebutuhan */
    border-radius: 5px;
}
</style>
