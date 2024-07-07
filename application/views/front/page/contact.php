<?p<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>HUBUNGI KAMI</h2>
            <hr>
            <?php echo validation_errors(); ?>
            <?php if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-info">'.$this->session->flashdata('message').'</div>';
            } ?>
            <form id="contactForm" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama Pengirim" readonly value="<?php echo $this->session->userdata('name'); ?>">
                </div>
                <div class="form-group">
                    <select class="form-control" id="subjek" name="subjek">
                        <option value="" disabled selected>Isi Subjek</option>
                        <option value="Konfirmasi Pemesanan">Acara/Event</option>
                        <option value="Masukan">Masukan</option>
                        <option value="Pengaduan">Pengaduan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="pesan" name="pesan" rows="5" placeholder="Isi Pesan"></textarea>
                </div>
                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" name="userfile" class="form-control">
                    <div class="text-danger"><?= form_error('userfile'); ?></div>
                </div>
                <button type="button" id="submit" class="btn btn-sm btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    var name = '<?php echo $this->session->userdata("name"); ?>';
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengirim pesan.',
                });
            }
        });
    });
});
</script>
