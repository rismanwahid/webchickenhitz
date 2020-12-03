<?php
if (isset($_POST['simpan'])) {
    $kd_ktgr  = $_POST['kd_ktgr'];
    $nm_ktgr   = $_POST['nm_ktgr'];

    mysqli_query($db, "INSERT INTO kategori(kd_ktgr,nm_ktgr) VALUES ('$kd_ktgr','$nm_ktgr')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=kategori'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kategori">Data Kategori</a></li>
        <li class="breadcrumb-item active">Tambah Kategori</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Katgori</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Kategori</label>
                    <?php

                    $sql1  = "SELECT max(kd_ktgr) AS terakhirpas FROM kategori";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 5, 2);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "KTGR-" . sprintf("%02s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_ktgr" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="nm_ktgr">
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kategori" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>