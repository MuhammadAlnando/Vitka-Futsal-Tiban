<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Detail Lapangan</h2>
            <hr>
            <div class="row">
                <div class="col-lg-6 mb-4" style="margin-bottom: 100px;">
                    <div class="card shadow-sm" style="height: 100%;">
                        <?php if(empty($lapangan->foto)): ?>
                            <img class="card-img-top" src="<?= base_url('assets/images/no_image_thumb.png') ?>" style="height: 200px;">
                        <?php else: ?>
                            <img class="card-img-top" src="<?= base_url('assets/images/lapangan/' . $lapangan->foto) ?>" style="height: 300px;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm" style="height: 100%;">
                        <div class="card-body">
                            <h3 class="card-title"><b><?= $lapangan->nama_lapangan ?></b></h3><hr>
                          
                            Harga (Buka - 17.00) : <strong style="color:red">Rp <?= $lapangan->harga ?></strong> / jam <br>
                            Harga (18.00 - 21.00): <strong style="color:red">Rp <?= $lapangan->harga_malam ?></strong> / jam
                            <br><br>
                            <p><strong>Deskripsi:</strong> <br>Promo potongan harga <strong>50%</strong> khusus untuk jam ( Buka - 17.00 )</p>
                            <br>
                            <input type="date" id="tanggal_pilihan" class="form-control mb-2" style="width: 460px;" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>">
                            <br>
                            <strong>Jadwal yang tersedia:</strong> <br>
                            <div class="jam-mulai" id="jam_mulai_<?= $lapangan->id_lapangan ?>" style="min-height: 100px;">
                                <!-- Tempat untuk menampilkan tanggal dan jam mulai -->
                            </div>
                            
                            <a href="<?= base_url('cart/buy/') . $lapangan->id_lapangan ?>" class="btn btn-primary" style="background-color: #223C95; border: none;">
                                <i class="fa fa-futbol-o"></i> Sewa Lapangan
                            </a>
                            <button type="button" class="btn btn-danger" style="border: none;" data-toggle="modal" data-target="#rulesModal">
                                <i class="fa fa-exclamation-triangle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="rulesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" style="text-align: center;" id="rulesModalLabel"><strong>ATURAN PENGGUNAAN LAPANGAN</strong></h5>
            </div>
            <div class="modal-body">
                Harap pengguna Lapangan Vitka Futsal memperhatikan hal-hal sebagai berikut:
                <ul>
                    <li>Dilarang membuang sampah sembarangan.</li>
                    <li>Dilarang merokok di dalam lapangan.</li>
                    <li>Untuk pemain cadangan tidak diperkenankan berada di dalam lapangan.</li>
                    <li>Yang diperbolehkan berada di dalam lapangan hanya pemain dan wasit.</li>
                    <li>Tidak diperkenankan makan di dalam lapangan.</li>
                    <li>Gunakan lapangan sesuai waktu dan segera tinggalkan lapangan setelah waktu habis.</li>
                    <li>Harap menyimpan barang berharga di tempat yang aman, jika terjadi kehilangan di luar tanggung jawab pihak pengelola.</li>
                    <li>Memakai pakaian dan sepatu yang olahraga yang sesuai.</li>
                </ul>
                Terima kasih atas kerja samanya, salam olahraga!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk AJAX Call -->
<script>
$(document).ready(function() {
    loadJamMulai(); // Load jam mulai untuk tanggal hari ini saat halaman pertama kali dibuka

    $('#tanggal_pilihan').on('change', function() {
        loadJamMulai(); // Load jam mulai saat tanggal pilihan diubah
    });

    function loadJamMulai() {
        var url = "<?php echo base_url('cart/getJamMulai'); ?>";
        var tanggal_pilihan = $('#tanggal_pilihan').val();
        
        $.ajax({
            type: "POST",
            url: url,
            data: {
                tanggal: tanggal_pilihan,
                lapangan_id: <?= $lapangan->id_lapangan; ?> // Sesuaikan dengan cara penanganan variabel PHP di JavaScript
            },
            dataType: "json",
            success: function(data) {
                var jamMulaiHtml = '';
                var today = new Date();
                var selectedDate = new Date(tanggal_pilihan);
                var available = false; // Flag untuk mengecek ketersediaan jam
                
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
                    jamMulaiHtml = '<p><strong style="color: red;">Sold Out</strong></p>';
                }
                
                $('#jam_mulai_<?= $lapangan->id_lapangan ?>').html(jamMulaiHtml);
            }
        });
    }
});
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
