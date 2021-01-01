<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'vpengadaan') {

        $mintgl = $_GET['mintgl'];
        $maxtgl = $_GET['maxtgl'];
        $query  = mysqli_query($db, "SELECT * FROM pengadaan WHERE DATE(tgl_pengadaan) BETWEEN '$mintgl' AND '$maxtgl' ORDER BY tgl_pengadaan ASC");

        $hitung = mysqli_num_rows($query);
        if ($hitung > 0) {
            $_SESSION['mintgl'] = $_GET['mintgl'];
            $_SESSION['maxtgl'] = $_GET['maxtgl'];
            echo "<script>window.open('modules/lappengadaan/laporan.php')</script>";
        } else {
            echo "<script>alert('Belum Ada Pengadaan Bahan Baku Untuk Hari Ini')</script>";
            echo "<script>window.location='admin.php?page=home'</script>";
        }
    }
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'vpengambilan') {

        $mintgl = $_GET['mintgl'];
        $maxtgl = $_GET['maxtgl'];
        $query  = mysqli_query($db, "SELECT * FROM pengambilan WHERE DATE(tgl_pengambilan) BETWEEN '$mintgl' AND '$maxtgl' ORDER BY tgl_pengambilan ASC");

        $hitung = mysqli_num_rows($query);
        if ($hitung > 0) {
            $_SESSION['mintgl'] = $_GET['mintgl'];
            $_SESSION['maxtgl'] = $_GET['maxtgl'];
            echo "<script>window.open('modules/lapambil/laporan.php')</script>";
        } else {
            echo "<script>alert('Belum Ada Pemngambilan Bahan Baku Untuk Hari Ini')</script>";
            echo "<script>window.location='admin.php?page=home'</script>";
        }
    }
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'vjual') {

        $mintgl = $_GET['mintgl'];
        $maxtgl = $_GET['maxtgl'];
        $query  = mysqli_query($db, "SELECT * FROM penjualan WHERE DATE(tgl_jual) BETWEEN '$mintgl' AND '$maxtgl' AND tipe_jual='Biasa' AND status!='Dibatalkan' ORDER BY tgl_jual ASC");

        $hitung = mysqli_num_rows($query);
        if ($hitung > 0) {
            $_SESSION['mintgl'] = $_GET['mintgl'];
            $_SESSION['maxtgl'] = $_GET['maxtgl'];
            echo "<script>window.open('modules/lapjual/laporan.php')</script>";
        } else {
            echo "<script>alert('Belum Ada Transaksi Penjualan Untuk Hari Ini')</script>";
            echo "<script>window.location='admin.php?page=home'</script>";
        }
    }
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'vcat') {

        $mintgl = $_GET['mintgl'];
        $maxtgl = $_GET['maxtgl'];
        $query  = mysqli_query($db, "SELECT * FROM penjualan JOIN pembayaran ON pembayaran.kd_penjualan=penjuala.kd_penjualan WHERE DATE(tgl_jual) BETWEEN '$mintgl' AND '$maxtgl' AND tipe_jual='Catering' AND pembayaran.status_bayar='Lunas' ORDER BY tgl_jual ASC");

        $hitung = mysqli_num_rows($query);
        if ($hitung > 0) {
            $_SESSION['mintgl'] = $_GET['mintgl'];
            $_SESSION['maxtgl'] = $_GET['maxtgl'];
            echo "<script>window.open('modules/lapcatering/laporan.php')</script>";
        } else {
            echo "<script>alert('Belum Ada Transaksi Catering Untuk Hari Ini')</script>";
            echo "<script>window.location='admin.php?page=home'</script>";
        }
    }
}
?>
<div class="container-fluid">
    <h1 class="mt-4"><i class="fa fa-home"></i>Beranda</h1>
    <ol class="breadcrumb mb-4">
        <marquee behavior="" direction="">
            <li class="breadcrumb-item active">
                Selamat Datang <?= $_SESSION['nama']; ?> Di Sistem Informasi Penjualan Chicken Hitz
            </li>
        </marquee>
    </ol>
    <div class="row">
        <?php if ($_SESSION['level'] == 'Admin') { ?>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <?php
                        $date = date('Y-m-d');
                        $qr = mysqli_query($db, "SELECT COUNT(kd_penjualan) AS totaljual FROM penjualan WHERE DATE(tgl_jual)='$date' AND tipe_jual='Biasa' AND status!='Dibatalkan'");
                        $ouput = mysqli_fetch_assoc($qr);
                        ?>
                        <h4><?= $ouput['totaljual']; ?></h4>
                        <p>Penjualan <?php echo date('d-m-Y'); ?></p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=penjualan">Selengkapnya</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <?php
                        $qr1 = mysqli_query($db, "SELECT COUNT(kd_penjualan) AS totalcat FROM penjualan WHERE DATE(tgl_jual)='$date' AND tipe_jual='Catering' AND status!='Dibatalkan'");
                        $ouput1 = mysqli_fetch_assoc($qr1);
                        ?>
                        <h4><?= $ouput1['totalcat']; ?></h4>
                        <p>Catering <?php echo date('d-m-Y'); ?></p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=catering">Selengkapnya</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <?php
                        $qr3 = mysqli_query($db, "SELECT COUNT(kd_pengadaan) AS totalada FROM pengadaan WHERE DATE(tgl_pengadaan)='$date'");
                        $ouput3 = mysqli_fetch_assoc($qr3);
                        ?>
                        <h4><?= $ouput3['totalada']; ?></h4>
                        <p>Pengadaan <?php echo date('d-m-Y'); ?></p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=pengadaan">Selengkapnya</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <?php
                        $qr2 = mysqli_query($db, "SELECT COUNT(kd_menu) AS totalmenu FROM menu");
                        $ouput2 = mysqli_fetch_assoc($qr2);
                        ?>
                        <h4><?= $ouput2['totalmenu']; ?></h4>
                        <p>Menu</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=menu">Selengkapnya</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div><?php } else { ?>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>Laporan <br> Bahan Baku</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="modules/lapbahan/laporan.php" target="_blank">Lihat Laporan Bahan Baku</a>
                        <div class=" small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>Laporan <br>Pengadaan</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=home&aksi=vpengadaan&mintgl=<?php echo date('Y-m-d'); ?>&maxtgl=<?php echo date('Y-m-d'); ?>">Lihat Laporan Pengadaan Bahan</a>
                        <div class=" small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>Laporan <br> Penjualan</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=home&aksi=vjual&mintgl=<?php echo date('Y-m-d'); ?>&maxtgl=<?php echo date('Y-m-d'); ?>">Lihat Laporan Penjualan</a>
                        <div class=" small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>Laporan <br> Catering</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=home&aksi=vcat&mintgl=<?php echo date('Y-m-d'); ?>&maxtgl=<?php echo date('Y-m-d'); ?>">Lihat Laporan Catering</a>
                        <div class=" small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>Laporan <br> Keuntungan</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="admin.php?page=ceklapuntung">Lihat Laporan Keuntungan</a>
                        <div class=" small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>