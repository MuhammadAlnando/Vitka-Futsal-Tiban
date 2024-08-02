<section class="content">
  <div class="row">
    <!-- Omset dan Lapangan -->
    <div class='col-lg-6'>
      <div class='small-box bg-teal'>
        <div class='inner'><h3> Rp <?php echo number_format($omset_harian) ?> </h3><p><b>OMSET HARI INI</b></p></div>
        <div class='inner'><h3> Rp <?php echo number_format($omset_bulanan) ?> </h3><p><b>OMSET BULAN INI</b></p></div>
        <div class='inner'><h3> Rp <?php echo number_format($omset_tahunan) ?> </h3><p><b>OMSET TAHUN INI</b></p></div>
        <div class='icon'><span>&#x1F4B5;</span></div>
        <a href='<?php echo base_url('admin/transaksi') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <!-- <div class='col-lg-3'>
      <div class='small-box bg-yellow'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $company_name ?> </h3><p><b>PERUSAHAAN</b></p></div>
        <div class='icon'><i class='fa fa-building'></i></div>
        <a href='<?php echo base_url('admin/company/update/1') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
      
      </div>
    </div> -->
    <div class='col-lg-3'>
      <div class='small-box bg-green'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_lapangan ?> </h3><p><b>LAPANGAN</b></p></div>
        <div class='icon'><span>&#x26BD;</span></div>
        <a href='<?php echo base_url('admin/lapangan') ?>' class='small-box-footer'>Selengkapnya <span>&#x27A1;</span></a>
      </div>
    </div>
    <div class='col-lg-3'>
      <div class='small-box bg-teal'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_customer ?> </h3><p><b>CUSTOMER</b></p></div>
        <div class='icon'><i class='fa fa-user'></i></div>
        <a href='<?php echo base_url('admin/auth') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
      </div>
    </div>

    <!-- Jumlah Pesan -->
    <div class='col-lg-3'>
      <div class='small-box bg-blue'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_pesan ?> </h3><p><b>JUMLAH PESAN</b></p></div>
        <div class='icon'><i class='fa fa-envelope'></i></div>
        <a href='<?php echo base_url('admin/pesan') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
      </div>
    </div>

    <!-- Company -->
    

    <!-- Jumlah Transaksi -->
    <div class='col-lg-3'>
      <div class='small-box bg-purple'>
        <div class='inner' style="height: 130px;"><h3> <?php echo $total_transaksi ?> </h3><p><b>JUMLAH TRANSAKSI</b></p></div>
        <div class='icon'><i class='fa fa-exchange'></i></div>
        <a href='<?php echo base_url('admin/transaksi') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
      </div>
    </div>

  </div>
  
</section><!-- /.content -->
