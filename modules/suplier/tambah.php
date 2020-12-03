<?php
if (isset($_POST['simpan'])) {
    $kd_suplier  = $_POST['kd_suplier'];
    $nm_suplier   = $_POST['nm_suplier'];
    $email   = $_POST['email'];
    $nope = $_POST['nope'];
    $alamat = $_POST['alamat'];

    mysqli_query($db, "INSERT INTO suplier(kd_suply,nm_suply,email,no_hp,alamat) VALUES ('$kd_suplier','$nm_suplier','$email','$nope','$alamat')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=suplier'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=suplier">Data Suplier</a></li>
        <li class="breadcrumb-item active">Tambah Suplier</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Suplier</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Suplier</label>
                    <?php

                    $sql1  = "SELECT max(kd_suply) AS terakhirpas FROM suplier";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 6, 3);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "SUPLY-" . sprintf("%03s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_suplier" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Suplier</label>
                    <input type="text" class="form-control" name="nm_suplier">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="nope">No HP</label>
                    <input type="number" class="form-control" name="nope">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" cols="30" rows="3" class="form-control"></textarea>
                </div>

            </div>
            <div class="card-footer">
                <a href="admin.php?page=suplier" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>