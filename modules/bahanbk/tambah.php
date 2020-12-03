<?php
if (isset($_POST['simpan'])) {
    $kd_bk  = $_POST['kd_bk'];
    $nm_bk   = $_POST['nm_bk'];
    $suplier   = $_POST['suplier'];
    $stok = $_POST['stok'];

    mysqli_query($db, "INSERT INTO bahan_baku(kd_bk,nm_bk,stok,kd_suply) VALUES ('$kd_bk','$nm_bk','$stok','$suplier')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=bahanbku'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=bahanbku">Data Bahan Baku</a></li>
        <li class="breadcrumb-item active">Tambah Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Bahan Baku</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Bahan Baku</label>
                    <?php

                    $sql1  = "SELECT max(kd_bk) AS terakhirpas FROM bahan_baku";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 3, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "BK-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_bk" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Bahan Baku</label>
                    <input type="text" class="form-control" name="nm_bk">
                </div>
                <div class="form-group">
                    <label>Suplier</label>
                    <select name="suplier" class="form-control">
                        <?php
                        $qr = mysqli_query($db, "SELECT suplier.kd_suply,suplier.nm_suply FROM suplier");
                        $hitung = mysqli_num_rows($qr);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($qr)) {
                        ?>
                                <option value="<?php echo $pecah['kd_suply']; ?>"><?php echo $pecah['nm_suply']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nope">Stok</label>
                    <input type="number" class="form-control" name="stok">
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=bahanbku" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>