<section class="content">
  <!-- penampilan total record -->
  <div class="row">
    <div class='col-lg-6'>
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
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_event ?> </h3><p><b>ACARA</b></p></div>
        <div class='icon'><span>&#x1F4F0;</span></div>
        <a href='<?php echo base_url('admin/event') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-green'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_lapangan ?> </h3><p><b>LAPANGAN</b></p></div>
        <div class='icon'><span>&#x26BD;</span></div>
        <a href='<?php echo base_url('admin/lapangan') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-aqua'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_kategori ?> </h3><p><b>KATEGORI</b></p></div>
        <div class='icon'><span>&#x1F4F0;</span></div>
        <a href='<?php echo base_url('admin/kategori') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-teal'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_customer ?> </h3><p><b>CUSTOMER</b></p></div>
        <div class='icon'><i class='fa fa-user'></i></div>
        <a href='<?php echo base_url('admin/auth') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
      </div>
    </div>

    
  </div>
</section><!-- /.content -->
