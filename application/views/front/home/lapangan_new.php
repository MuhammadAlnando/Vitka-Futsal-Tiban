<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center">JADWAL LAPANGAN</h2>
      <hr>
      <div class="form-group">
        <label for="tanggal_pilihan">Pilih Tanggal:</label>
        <input type="date" id="tanggal_pilihan" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>">
      </div>
      <div class="row">
        <?php foreach($lapangan_new as $lapangan): ?>
          <div class="col-md-6 mb-4">
            <div class="card" style="margin-bottom: 30px;">
              <div class="card-img-container">
                <img class="card-img-top" src="<?= empty($lapangan->foto) ? base_url('assets/images/no_image_thumb.png') : base_url('assets/images/lapangan/' . $lapangan->foto) ?>" alt="<?= $lapangan->nama_lapangan ?>">
                <div class="price-overlay">
                  <div class="price-normal">
                    (Buka-17.00)<br>
                    <s>Rp <?= number_format($lapangan->harga, 0, ',', '.') ?></s>
                    <span class="highlighted-price">Rp <?= number_format($lapangan->harga / 2, 0, ',', '.') ?></span>
                  </div>
                  <div class="price-night">
                    (18.00-22.00)<br>
                    <span>Rp <?= number_format($lapangan->harga_malam, 0, ',', '.') ?></span>
                  </div>
                </div>
                <div class="discount-badge" style="margin-left: -15px;">50% OFF</div> <!-- Discount badge -->
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $lapangan->nama_lapangan ?></h5>
                <p>Jadwal Tersedia:</p>
                <div class="jam-mulai" id="jam_mulai_<?= $lapangan->id_lapangan ?>">
                  <!-- Tempat untuk menampilkan jadwal mulai -->
                </div>
                <div class="mt-3" style="margin-top: 10px;">
                  <a href="<?= base_url('cart/buy/') . $lapangan->id_lapangan ?>" class="btn btn-primary" style="background-color: #223C95; border:none;">
                    <b>Sewa</b>
                  </a>
                  <a href="<?= base_url('lapangan/detail/' . $lapangan->id_lapangan) ?>" class="btn btn-primary" style="background-color:#EB7622; border:none;">
                    <b>Detail</b>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS for carousel functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- AJAX Script -->
<script>
$(document).ready(function() {
    loadJamMulai(); // Load times for the initial date when the page loads

    $('#tanggal_pilihan').on('change', function() {
        loadJamMulai(); // Reload times when the date is changed
    });

    function loadJamMulai() {
        var url = "<?php echo base_url('cart/getJamMulai'); ?>";
        var tanggal_pilihan = $('#tanggal_pilihan').val();
        
        $('.jam-mulai').each(function() {
            var lapanganId = $(this).attr('id').split('_')[2]; // Extract the lapangan ID from the ID attribute

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    tanggal: tanggal_pilihan,
                    lapangan_id: lapanganId
                },
                dataType: "json",
                success: function(data) {
                    var jamMulaiHtml = '';
                    var today = new Date();
                    var selectedDate = new Date(tanggal_pilihan);
                    var available = false; // Flag to check availability
                    
                    $.each(data, function(index, value) {
                        var jam_mulai = value.jam_mulai;
                        var jam_mulai_parts = jam_mulai.split(':');
                        var jam_mulai_date = new Date(selectedDate);
                        jam_mulai_date.setHours(jam_mulai_parts[0], jam_mulai_parts[1]);

                        var currentDay = selectedDate.toLocaleString('en-us', { weekday: 'long' });

                        // Monday to Thursday: 15:00 to 22:00
                        if (['Monday', 'Tuesday', 'Wednesday', 'Thursday'].includes(currentDay)) {
                            if (jam_mulai_parts[0] >= 15 && jam_mulai_parts[0] < 22) {
                                if (selectedDate > today || (selectedDate.toDateString() === today.toDateString() && jam_mulai_date > today)) {
                                    jamMulaiHtml += '<span class="jam-mulai-item">' + jam_mulai + '</span> ';
                                    available = true;
                                }
                            }
                        // Friday to Sunday: 07:00 to 22:00
                        } else if (['Friday', 'Saturday', 'Sunday'].includes(currentDay)) {
                            if (jam_mulai_parts[0] >= 7 && jam_mulai_parts[0] < 22) {
                                if (selectedDate > today || (selectedDate.toDateString() === today.toDateString() && jam_mulai_date > today)) {
                                    jamMulaiHtml += '<span class="jam-mulai-item">' + jam_mulai + '</span> ';
                                    available = true;
                                }
                            }
                        }
                    });
                    
                    if (!available) {
                        jamMulaiHtml = '<p><strong class="sold-out">Sold Out</strong></p>';
                    }
                    
                    $('#jam_mulai_' + lapanganId).html(jamMulaiHtml);
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + status + " - " + error);
                    $('#jam_mulai_' + lapanganId).html('<p><strong class="sold-out">Untuk dapat melihat jadwal, silahkan login terlebih dahulu.</strong></p>');
                }
            });
        });
    }
});
</script>

<!-- Style for Schedule Availability -->
<style>
.jam-mulai-item {
    display: inline-block;
    padding: 2px 4px;
    margin: 3px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f8f9fa;
    color: #000;
}

.sold-out {
    color: red;
}

.card-img-container {
    position: relative;
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease-in-out; /* Animation for image */
}

.card-img-top:hover {
    transform: scale(1.05); /* Zoom in on hover */
}

.price-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    text-align: center;
    padding: 10px;
    font-size: 18px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.card-img-container:hover .price-overlay {
    opacity: 1; /* Show price overlay on hover */
}

.price-normal, .price-night {
    flex: 1;
}

.highlighted-price {
    color: #EB7622; /* Highlight color for discount price */
    font-weight: bold; /* Bold text */
    font-size: 1.2em; /* Slightly larger than regular text */
}

.discount-badge {
    position: absolute;
    top: 10px;
    left: 0px;
    background-color: #FF0000; /* Red background for the badge */
    color: #FFFFFF; /* White text */
    padding: 5px 10px;
    border-radius: 50px;
    font-weight: bold;
    font-size: 1.2em;
    transform: rotate(-30deg); /* Rotate the badge for a dynamic effect */
    z-index: 10; /* Ensure the badge appears above other content */
}
</style>
