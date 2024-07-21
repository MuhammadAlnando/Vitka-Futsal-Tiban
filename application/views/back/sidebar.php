<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
            <li class="header"><font style="font-size: 16px;color: white; font-weight: bold">MENU UTAMA</font></li>
            <li <?php if($this->uri->segment(2)=="dashboard"){echo "class='active'";} ?>>
                <a href="<?php echo base_url('admin/dashboard') ?>">
                    <span>&#x1F3E0;</span> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() ?>" target="_blank">
                    <span>&#x1F30E;</span> <span>Lihat Website</span>
                </a>
            </li>
            <li <?php if($this->uri->segment(2)=="transaksi" && $this->uri->segment(3)!="update_diskon"){echo "class='active'";} ?>>
                <a href="<?php echo base_url('admin/transaksi') ?>">
                    <span>&#x1F4D4;</span> <span>Transaksi</span>
                </a>
            </li>
            <li <?php if($this->uri->segment(2) == "lapangan"){echo "class='active'";} ?>>
                <a href='<?php echo base_url('admin/lapangan') ?>'><span>&#x26BD;</span> Lapangan </a>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == "event"){echo "active";} ?>">
                <a href='#'>
                    <span>&#x1F4F0;</span><span> Acara </span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>
                    <li <?php if($this->uri->segment(2) == "event" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
                        <a href='<?php echo base_url('admin/event') ?>'><span>&#x1F4C3;</span> Data Acara </a>
                    </li>
                    <li <?php if($this->uri->segment(2) == "kategori" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
                        <a href='<?php echo base_url('admin/kategori') ?>'><span>&#x1F4D6;</span> Data Kategori </a>
                    </li>
                </ul>
            </li>
            
            <?php if ($this->ion_auth->is_superadmin()): ?>
            <li <?php if($this->uri->segment(2) == "bank" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
                <a href='<?php echo base_url('admin/bank') ?>'><span>&#x1F4B3;</span> Metode Pembayaran </a>
            </li>
            <?php endif ?>
            <?php if ($this->ion_auth->is_superadmin()): ?>
            <li <?php if($this->uri->segment(2) == "kontak" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
                <a href='<?php echo base_url('admin/kontak') ?>'><span>&#x260E;</span> Kontak </a>
            </li>
            <?php endif ?>
            <li <?php if($this->uri->segment(2) == "pesan"){echo "class='active'";} ?>>
    <a href='<?php echo base_url('admin/pesan') ?>'><span>&#x1F4E7;</span> Pesan </a>
</li>

            <!-- Akhir menu Pesan -->
            <li class="header"><font style="font-size: 16px;color: white; font-weight: bold">PENGATURAN</font></li>
            <?php if ($this->ion_auth->is_superadmin()): ?>
            <li <?php if($this->uri->segment(2) == "company" && $this->uri->segment(3) == ""){echo "class='active'";} ?>><a href='<?php echo base_url() ?>admin/company/update/1'> <span>&#x1F3E2;</span> <span>Profil Perusahaan</span> </a> </li>
            <?php endif ?>
            <?php if ($this->ion_auth->is_superadmin()): ?>
                <li <?php if($this->uri->segment(2) == "auth" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
                    <a href='<?php echo base_url() ?>admin/auth/'><span>&#x1F464;</span> Data User</a>
                </li>
            <?php endif ?>
            <!-- <li> <a href='<?php echo base_url() ?>admin/auth/logout'> <span>&#x1F6AA;</span> <span>Keluar</span> </a> </li> -->
        </ul>
    </section>
</aside>
