<?php
if (isset($_POST['simpan'])) {
    $kd_tarif  = $_POST['kd_tarif'];
    $nm_wilayah   = $_POST['nm_wilayah'];
    $tarif   = $_POST['tarif'];

    mysqli_query($db, "INSERT INTO kabupaten(kd_tarif,nm_kabupaten,tarif) VALUES ('$kd_tarif','$nm_wilayah','$tarif')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=datongkir'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=datongkir">Data Tarif Pengiriman</a></li>
        <li class="breadcrumb-item active">Tambah Tarif Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Tarif Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Tarif Pengiriman</label>
                    <?php

                    $sql1  = "SELECT max(kd_tarif) AS terakhirpas FROM kabupaten";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 7, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "ONGKIR-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_tarif" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Wilayah</label>
                    <?php
                    echo "<input type='text' name='nm_wilayah' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control'>";
                    ?>
                </div>
                <div class="form-group">
                    <label>Tarif</label>
                    <input type="number" class="form-control" min="0" name="tarif" required>
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=datongkir" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>