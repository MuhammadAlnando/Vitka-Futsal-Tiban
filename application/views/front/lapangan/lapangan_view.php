<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>LAPANGAN</h2>
      <hr>
      <div class="row">
        <?php foreach($lapangan_new as $lapangan): ?>
          <div class="col-lg-4 mb-4"> <!-- Kolom untuk setiap lapangan -->
          <h3 class="card-title"><b><?= $lapangan->nama_lapangan ?></b></h3>
            <div class="card shadow-sm" style="height: 100%;">
              <?php if(empty($lapangan->foto)): ?>
                <img class="card-img-top" src="<?= base_url('assets/images/no_image_thumb.png') ?>" style="height: 200px;">
              <?php else: ?>
                <img class="card-img-top" src="<?= base_url('assets/images/lapangan/' . $lapangan->foto) ?>" style="height: 200px;">
              <?php endif; ?>
              <div class="card-body">
                <br>
                <strong>Tersedia Sekarang:</strong> 
                <div class="jam-mulai" id="jam_mulai_<?= $lapangan->id_lapangan ?>">
                  <!-- Tempat untuk menampilkan tanggal dan jam mulai -->
                </div>
                
                <a href="<?= base_url('cart/buy/') . $lapangan->id_lapangan ?>" class="btn btn-sm btn-primary" style="background-color: #223C95; border: none;">
                  <i class="fa fa-shopping-cart"></i> <b>Rp <?= $lapangan->harga ?> /jam</b>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>


<!-- Script untuk AJAX Call -->
<script>
$(document).ready(function() {
  var url = "<?php echo base_url('cart/getJamMulai'); ?>";
  
  <?php foreach($lapangan_new as $lapangan): ?>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var tanggal_sekarang = yyyy + '-' + mm + '-' + dd;
    var tanggal_lapangan = '<?= date("Y-m-d"); ?>';
    
    if (tanggal_lapangan === tanggal_sekarang) {
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
            var durasi = value.durasi;
            
            if (compareTimes(jam_mulai, jamSekarang)) {
              jamMulaiHtml += '<span class="jam-mulai-item">' + jam_mulai + '</span> ';
              available = true;
            }
          });
          
          if (!available) {
            jamMulaiHtml = '<p><strong style="color: red;">Sold Out</strong></p>';
            $('#buy_<?= $lapangan->id_lapangan ?>').removeClass('disabled').attr('href', '<?= base_url("cart/buy/") . $lapangan->id_lapangan ?>').css('pointer-events', 'auto');
          } else {
            jamMulaiHtml += '</p>';
            $('#buy_<?= $lapangan->id_lapangan ?>').removeClass('disabled').attr('href', '<?= base_url("cart/buy/") . $lapangan->id_lapangan ?>').css('pointer-events', 'auto');
          }
          
          $('#jam_mulai_<?= $lapangan->id_lapangan ?>').html(jamMulaiHtml);
        }
      });
    }
  <?php endforeach; ?>
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

<!-- CSS untuk menambahkan border pada jam mulai -->
<style>

.jam-mulai-item {
  display: inline-block;
  padding: 5px;
  margin-right: 5px;
  background-color: #f0f0f0;
  border-radius: 3px;
}
</style>
