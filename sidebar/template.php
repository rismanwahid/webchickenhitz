<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link" href="admin.php?page=home">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Beranda
                </a>
                <?php if ($_SESSION['level'] == 'Admin') { ?>
                    <div class="sb-sidenav-menu-heading">Data Master</div>
                    <a href="admin.php?page=karyawan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Karyawan
                    </a>
                    <a href="admin.php?page=datplg" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Pelanggan
                    </a>
                    <a href="admin.php?page=suplier" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Suplier
                    </a>
                    <a href="admin.php?page=bahanbku" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Bahan Baku
                    </a>
                    <a href="admin.php?page=kategori" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Kategori
                    </a>
                    <a href="admin.php?page=menu" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Menu
                    </a>
                    <a href="admin.php?page=paketcat" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Paket Catering
                    </a>
                    <a href="admin.php?page=resep" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Resep
                    </a>
                    <a href="admin.php?page=datongkir" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Kabupaten
                    </a>
                    <a href="admin.php?page=kecamatan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Kecamatan
                    </a>
                    <a href="admin.php?page=kelurahan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Kelurahan
                    </a>
                    <div class="sb-sidenav-menu-heading">Transaksi</div>
                    <a href="admin.php?page=pengadaan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-shopping-cart"></i></div>
                        Pengadaan Bahan
                    </a>
                    <!-- <a href="admin.php?page=pengambilan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-shopping-cart"></i></div>
                        Pengambilan Bahan
                    </a> -->
                    <a href="admin.php?page=penjualan" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-shopping-cart"></i></div>
                        Penjualan
                    </a>
                    <a href="admin.php?page=catering" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-shopping-cart"></i></div>
                        Catering
                    </a><?php } ?>
                <?php if ($_SESSION['level'] == 'Owner') { ?>
                    <div class="sb-sidenav-menu-heading">Laporan</div>
                    <a href="modules/lapbahan/laporan.php" target="_blank" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Bahan Baku
                    </a>
                    <a href="admin.php?page=ceklapbeli" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Pengadaan Bahan
                    </a>
                    <!-- <a href="admin.php?page=ceklapambil" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Pengambilan Bahan
                    </a> -->
                    <a href="admin.php?page=ceklapjual" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Penjualan
                    </a>
                    <a href="admin.php?page=ceklapcat" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Catering
                    </a>
                    <a href="admin.php?page=ceklapuntung" class="nav-link collapsed">
                        <div class="sb-nav-link-icon"><i class="fa  fa-file-pdf"></i></div>
                        Laporan Keuntungan
                    </a><?php } ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Login Sebagai:</div>
            <?= $_SESSION['level']; ?>
        </div>
    </nav>
</div>