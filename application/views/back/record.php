<section class="content">
  <!-- penampilan total record -->
  <div class="row">
    <div class='col-lg-12'>
      <div class='small-box bg-teal'>
        <div class='inner'><h3> Rp <?php echo number_format($omset_harian) ?> </h3><p><b>OMSET HARI INI</b></p></div>
        <div class='inner'><h3> Rp <?php echo number_format($omset_bulanan) ?> </h3><p><b>OMSET BULAN INI</b></p></div>
        <div class='inner'><h3> Rp <?php echo number_format($omset_tahunan) ?> </h3><p><b>OMSET TAHUN INI</b></p></div>
        <div class='icon'><span>&#x1F4B5;</span></div>
        <a href='<?php echo base_url('admin/transaksi') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-orange'>
        <div class='inner'><h3> <?php echo $total_event ?> </h3><p><b>EVENT</b></p></div>
        <div class='icon'><span>&#x1F4F0;</span></div>
        <a href='<?php echo base_url('admin/event') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-green'>
        <div class='inner'><h3> <?php echo $total_lapangan ?> </h3><p><b>LAPANGAN</b></p></div>
        <div class='icon'><span>&#x26BD;</span></div>
        <a href='<?php echo base_url('admin/lapangan') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-aqua'>
        <div class='inner'><h3> <?php echo $total_kategori ?> </h3><p><b>KATEGORI</b></p></div>
        <div class='icon'><span>&#x1F4F0;</span></div>
        <a href='<?php echo base_url('admin/kategori') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>

    <div class='col-lg-3'>
      <div class='small-box bg-maroon'>
        <div class='inner'><h3> <?php echo $total_slider ?> </h3><p><b>SLIDER</b></p></div>
        <div class='icon'><span>&#x1F4B3;</span></div>
        <a href='<?php echo base_url('admin/slider') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
  </div>
</section><!-- /.content -->
