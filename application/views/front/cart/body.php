<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>DETAIL PENYEWAAN</h2>
            <hr>
            <form action="<?php echo base_url('cart/checkout') ?>" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
                        <div class="box-body table-responsive padding">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Lapangan</th>
                                        <th style="text-align: center">Harga Siang</th>
                                        <th style="text-align: center">Harga Malam</th>
                                        <th style="text-align: center">Tanggal</th>
                                        <th style="text-align: center">Jam Mulai</th>
                                        <th style="text-align: center">Durasi</th>
                                        <th style="text-align: center">Jam Selesai</th>
                                        <th style="text-align: center">Total</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($cart_data as $cart) { ?>
                                        <tr>
    <td style="text-align:left"><?php echo $cart->nama_lapangan ?></td>
    <td style="text-align:center"><?php echo number_format($cart->harga); ?></td>
    <td style="text-align:center"><?php echo number_format($cart->harga_malam); ?></td>
    <td style="text-align:center">
        <?php echo form_input($tanggal) ?>
        <input type="hidden" name="harga_siang[]" value="<?php echo $cart->harga ?>">
        <input type="hidden" name="harga_malam[]" value="<?php echo $cart->harga_malam ?>">
        <input type="hidden" name="lapangan[]" value="<?php echo $cart->lapangan_id ?>">
        <input type="hidden" name="id_transdet[]" value="<?php echo $cart->id_transdet ?>">
        <input type="hidden" value="<?php echo $cart->lapangan_id; ?>" class="lapangan_id">
    </td>
    <td style="text-align:center">
        <?php echo form_dropdown('jam_mulai[]', array('' => '- Pilih Tanggal Dulu -'), '', 'class="jam_mulai"'); ?>
        <span class="loading_container" style="display:none;">
            <img src="<?php echo base_url(); ?>assets/template/frontend/img/loading.gif" style="display:inline;" />&nbsp;memuat data ...
        </span>
    </td>
    <td style="text-align:center">
        <input type="number" name="durasi[]" class="durasi" min="1">
    </td>
    <td style="text-align:center" class="jam_selesai"></td>
    <td style="text-align:center" class="subtotal"></td>
    <td style="text-align:center">
        <a href="<?php echo base_url('cart/delete/') . $cart->id_transdet ?>" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
    </td>
</tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
    <th>Diskon</th>
    <td align="center">Rp</td>
    <td align="right" id="total_diskon">0</td>
</tr>
                        <tr>
                            <th>SubTotal</th>
                            <td align="center">Rp</td>
                            <td align="right" id="subtotal_bawah"></td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Grand Total</th>
                            <td align="center">Rp</td>
                            <td align="right"><b>
                                    <div id="grandtotal"></div>
                                </b></td>
                        </tr>
                    </tbody>
                </table>

                <?php if ($cek_keranjang != NULL) { ?>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group"><label>Catatan</label>
                                <input type="text" name="catatan" class="form-control">
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($customer_data->id_trans)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <a href="<?php echo base_url() ?>">
                                <button name="hapus" type="button" class="btn btn-primary" style="background-color: #223C95; border: none;" aria-label="Left Align" title="Lanjut Belanja">
                                    <span  aria-hidden="true"></span> Kembali
                                </button>
                            </a>
                            <?php if ($cek_keranjang != NULL) { ?>
                                <button name="checkout" type="submit" class="btn btn-success" style="border: none;" aria-label="Left Align" title="Checkout">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Checkout
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <input type="hidden" name="id_trans" value="<?php echo $customer_data->id_trans ?>">
                <?php } ?>
                <?php echo form_close() ?>
            </form>
        </div>

        <link href="<?php echo base_url('assets/plugins/') ?>datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/plugins/') ?>datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
           const numberWithCommas = (x) => {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}


$(function() {
    $(document).on("focus", ".tanggal", function() {
        $(this).datepicker({
            startDate: '0',
            endDate: '+14d',  // Batas maksimal dua minggu dari hari ini
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    });

    $('.tanggal').on('changeDate', function(ev) {
        var tanggal_el = $(this);
        var tanggal_val = tanggal_el.val();
        var jam_mulai_el = tanggal_el.parent().parent().find(".jam_mulai");
        var durasi_el = tanggal_el.parent().parent().find(".durasi");
        var jam_selesai_el = durasi_el.parent().parent().find(".jam_selesai");
        var loading_container_el = tanggal_el.parent().parent().find(".loading_container");
        var lapangan_id_el = tanggal_el.parent().parent().find(".lapangan_id");

        jam_mulai_el.hide();
        loading_container_el.show();

        $.post('<?php echo base_url(); ?>Cart/getJamMulai', {
    tanggal: tanggal_val,
    lapangan_id: lapangan_id_el.val()
}, function(data) {
    jam_mulai_el.show();
    loading_container_el.hide();
    jam_mulai_el.html("");

    jam_mulai_el.append("<option value='' selected='selected'>- Pilih Jam Mulai -</option>");

    var count = 0;
    // Di dalam $.post
var now = moment(); // Jam saat ini
var weekday = moment(tanggal_val).isoWeekday(); // Mendapatkan hari dalam minggu (1 untuk Senin, 7 untuk Minggu)

data.forEach(function(item, index) {
    var jam_mulai = moment(item.jam_mulai, 'HH:mm:ss');

    // Validasi untuk hari Senin - Kamis dari 15:00 hingga 21:00
    if (weekday >= 1 && weekday <= 4) { // Senin - Kamis
        if (jam_mulai.isAfter(now.startOf('day').add(14, 'hours')) && jam_mulai.isBefore(now.startOf('day').add(22, 'hours'))) {
            jam_mulai_el.append("<option durasi='" + item.durasi + "'>" + item.jam_mulai + "</option>");
            count++;
        }
    }
    // Validasi untuk hari Jumat - Minggu dari 07:00 hingga 21:00
    else if (weekday >= 5 && weekday <= 7) { // Jumat - Minggu
        if (jam_mulai.isAfter(now.startOf('day').add(6, 'hours')) && jam_mulai.isBefore(now.startOf('day').add(22, 'hours'))) {
            jam_mulai_el.append("<option durasi='" + item.durasi + "'>" + item.jam_mulai + "</option>");
            count++;
        }
    }
});


    if (count == 0) {
        jam_mulai_el.append("<option value=''>Jam penuh</option>");
    }
}, 'json');

    });
    $(document).on("change", ".jam_mulai", function() {
    var durasi_el = $(this).closest("tr").find(".durasi");
    durasi_el.val(1); // Set nilai durasi menjadi 1 secara otomatis
});

$(document).on("change", ".harga_selector", function() {
    var parentRow = $(this).closest("tr");
    var harga_siang = parseFloat(parentRow.find(".harga_siang").text());
    var harga_malam = parseFloat(parentRow.find(".harga_malam").text());

    var selected_value = $(this).val();
    if (selected_value === 'siang') {
        parentRow.find(".input_harga").val(harga_siang);
    } else if (selected_value === 'malam') {
        parentRow.find(".input_harga").val(harga_malam);
    }
});



$(document).on("change", ".jam_mulai, .durasi", function() {
    var parentRow = $(this).closest("tr");
    var jam_mulai_val = parentRow.find(".jam_mulai").val();
    var durasi_val = parentRow.find(".durasi").val();
    var harga_siang = parseFloat(parentRow.find("input[name='harga_siang[]']").val());
    var harga_malam = parseFloat(parentRow.find("input[name='harga_malam[]']").val());

    if (isNaN(harga_siang)) {
        harga_siang = 0;
    }
    if (isNaN(harga_malam)) {
        harga_malam = 0;
    }

    if (jam_mulai_val && durasi_val) {
        var jam_mulai_moment = moment(jam_mulai_val, 'HH:mm:ss');
        var jam_selesai_moment = jam_mulai_moment.clone().add(durasi_val, 'hours');

        // Batasi jam selesai maksimal pukul 22:00
        if (jam_selesai_moment.hour() >= 22) {
            jam_selesai_moment.hour(22).minute(0).second(0);

            // Tampilkan notifikasi peringatan
            alert("Jam selesai tidak boleh melewati pukul 22:00. Silakan atur ulang jam mulai atau durasi.");
        }

        parentRow.find(".jam_selesai").text(jam_selesai_moment.format('HH:mm:ss'));

        var total_harga = 0;
        var total_diskon_siang = 0;

        for (var i = 0; i < durasi_val; i++) {
            var current_hour = moment(jam_mulai_val, 'HH:mm:ss').add(i, 'hours');
            var current_hour_number = current_hour.hour();

            if (current_hour_number >= 18 || current_hour_number < 7) {
                total_harga += harga_malam;
            } else {
                total_harga += harga_siang;

                // Diskon hanya untuk harga siang
                var diskon_siang = harga_siang * 0.5; // 50% diskon
                total_diskon_siang += diskon_siang;
            }
        }

        parentRow.find(".subtotal").text(numberWithCommas(total_harga));
        $('#subtotal_bawah').text(numberWithCommas(total_harga));

        var grand_total = total_harga - total_diskon_siang;
        $("#grandtotal").text(numberWithCommas(grand_total));

        $("#total_diskon").text(numberWithCommas(total_diskon_siang));
    }
});


});

        </script>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
