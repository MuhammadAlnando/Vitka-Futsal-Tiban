<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>HUBUNGI KAMI</h2>
            <hr>
            <?php echo validation_errors(); ?>
            <?php if ($this->session->flashdata('message')) {
                echo $this->session->flashdata('message');
            } ?>
            <form id="contactForm" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama Pengirim" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select class="form-control" id="subjek" name="subjek">
                            <option value="Konfirmasi Pemesanan">Konfirmasi Pemesanan</option>
                            <option value="Masukan">Masukan</option>
                            <option value="Pengaduan">Pengaduan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <textarea class="form-control" id="pesan" name="pesan" rows="5" placeholder="Isi Pesan"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userfile">Upload Gambar</label>
                    <input type="file" name="userfile" id="userfile" size="20" onchange="previewImage(event)" accept="image/*" />
                    <br>
                    <img id="preview" src="#" alt="Preview Gambar" style="max-width: 40%; display: none;" />
                </div>
                <button type="button" id="submit" class="btn btn-sm btn-primary" style="pointer-events: all; cursor: pointer;">Kirim</button>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Ambil informasi nama pengguna dari session atau data pengguna terautentikasi
    var name = '<?php echo $this->session->userdata("name"); ?>'; // Sesuaikan dengan nama key yang sesuai dengan data pengguna

    // Set nilai otomatis untuk input nama_pengirim
    $('#nama_pengirim').val(name);

    $('#submit').click(function() {
        var formData = new FormData($('#contactForm')[0]);
        
        $.ajax({
            url: '<?php echo base_url('admin/pesan/save'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesan Terkirim!',
                        text: 'Pesan Anda telah berhasil terkirim.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#contactForm')[0].reset();
                    $('#preview').attr('src', '#').css('display', 'none');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mengirim pesan. Silakan coba lagi.',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengirim pesan.',
                });
            }
        });
    });
});

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
