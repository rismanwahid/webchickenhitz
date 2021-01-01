<?php

if (isset($_POST['cetak'])) {

    $mintgl  = $_POST['mintgl'];
    $maxtgl  = $_POST['maxtgl'];

    $query  = mysqli_query($db, "SELECT * FROM penjualan WHERE DATE(tgl_jual) BETWEEN '$mintgl' AND '$maxtgl' ORDER BY tgl_jual ASC");

    $hitung = mysqli_num_rows($query);
    if ($hitung > 0) {
        $_SESSION['mintgl'] = $_POST['mintgl'];
        $_SESSION['maxtgl'] = $_POST['maxtgl'];
        echo "<script>window.open('modules/lapuntung/laporan.php')</script>";
    } else {
        echo "<script>alert('Laporan Tidak Ditemukan')</script>";
        echo "<script>window.location='admin.php?page=ceklapuntung'</script>";
    }
}
?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Cek Laporan Keuntungan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Cek Laporan Keuntungan</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Dari Tanggal</label>
                    <input type="date" class="form-control" name="mintgl" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="maxtgl" max="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=home" class="btn btn-warning">Kembali</a>
                <button type="submit" name="cetak" class="btn btn-success">Lihat Laporan</button>
            </div>
        </form>
    </div>
</div>