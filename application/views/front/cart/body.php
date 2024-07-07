<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>DETAIL BOOKING</h2>
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
                                        <th style="text-align: center">Harga</th>
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
                                            <td style="text-align:center" class="harga_per_jam"><?php echo number_format($cart->harga) ?></td>
                                            <td style="text-align:center">
                                                <?php echo form_input($tanggal) ?>
                                                <input type="hidden" name="harga_jual[]" value="<?php echo $cart->harga ?>">
                                                <input type="hidden" name="lapangan[]" value="<?php echo $cart->lapangan_id ?>">
                                                <input type="hidden" name="id_transdet[]" value="<?php echo $cart->id_transdet ?>">
                                                <input type="hidden" value="<?php echo $cart->lapangan_id; ?>" class="lapangan_id">
                                            </td>
                                            <td style="text-align:center">
                                                <?php echo form_dropdown('', array('' => '- Pilih Tanggal Dulu -'), '', $jam_mulai); ?>
                                                <span class="loading_container" style="display:none;">
                                                    <img src="<?php echo base_url(); ?>assets/template/frontend/img/loading.gif" style="display:inline;" />&nbsp;memuat data ...</span>
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
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Lanjut Belanja
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
            endDate: '+14d',  // Menambahkan batas maksimal dua minggu dari hari ini
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    });

    $('.tanggal').on('changeDate', function(ev) {
    var tanggal_el = $(this);
    var tanggal_val = $(this).val();
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
            var now = moment(); // Jam saat ini

            data.forEach(function(item, index) {
                var jam_mulai = moment(item.jam_mulai, 'HH:mm:ss');

                // Validasi untuk tanggal hari ini
                if (tanggal_val === moment().format('YYYY-MM-DD')) {
                    if (jam_mulai.isAfter(now)) {
                        jam_mulai_el.append("<option durasi='" + item.durasi + "'>" + item.jam_mulai + "</option>");
                        count++;
                    }
                } else {
                    // Tidak ada validasi tambahan untuk tanggal hari esok
                    jam_mulai_el.append("<option durasi='" + item.durasi + "'>" + item.jam_mulai + "</option>");
                    count++;
                }
            });

            durasi_el.val(0);
            jam_selesai_el.html("");

            if (count == 0) {
                jam_mulai_el.html("");
                jam_mulai_el.append("<option value='' selected='selected'>- Tidak ada pilihan -</option>");
            }

        },
        'json'
    );
});



    $(document).on("change", ".jam_mulai", function() {
        var jam_mulai_el = $(this);
        var durasi_el = jam_mulai_el.parent().parent().find(".durasi");
        durasi_el.val(jam_mulai_el.find(":selected").attr("durasi")).change();
    });

    $(document).on("change keyup", ".durasi", function() {
        var durasi_el = $(this);
        var durasi = $(this).val();

        if (durasi == "") {
            durasi = 0;
            durasi_el.val(durasi);
        }

        var jam_mulai_el = durasi_el.parent().parent().find(".jam_mulai");
        var jam_selesai_el = durasi_el.parent().parent().find(".jam_selesai");

        var harga_per_jam_el = durasi_el.parent().parent().find(".harga_per_jam");
        var subtotal_el = durasi_el.parent().parent().find(".subtotal");

        if (jam_mulai_el.val() != "") {
            var jam_selesai = moment("01-01-2018 " + jam_mulai_el.val(), "MM-DD-YYYY HH:mm:ss").add(parseInt(durasi), 'hours').format('HH:mm:ss');
            jam_selesai_el.html(jam_selesai);

            var harga_per_jam = harga_per_jam_el.html().replace(/,/g, '');
            var harga_per_jam_int = parseInt(harga_per_jam);

            subtotal_el.html(numberWithCommas(harga_per_jam_int * parseInt(durasi)));

            var subtotal_bawah = 0;
            $('.subtotal').each(function(i, obj) {
                var a_subtotal_html = $(this).html().trim().replace(/,/g, '');
                if (a_subtotal_html == "") {
                    a_subtotal_html = "0";
                }

                var a_subtotal_html_int = parseInt(a_subtotal_html);
                subtotal_bawah += a_subtotal_html_int;
            });

            var diskon = 0; // Default diskon jika tidak ada nilai
            if ($('#diskon').length) {
                diskon = parseInt($('#diskon').val().replace(/,/g, '')) || 0;
            }

            $("#subtotal_bawah").html(numberWithCommas(subtotal_bawah));
            var gtotal = subtotal_bawah - diskon;
            $("#grandtotal").html(numberWithCommas(gtotal));
        }
    });
});
        </script>
    </div>
</div>
<?php $this->load->view('front/footer'); ?>
