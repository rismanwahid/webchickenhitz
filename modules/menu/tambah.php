<?php
if (isset($_POST['simpan'])) {
    $kd_menu  = $_POST['kd_menu'];
    $kd_ktgr   = $_POST['kd_ktgr'];
    $nm_menu = $_POST['nm_menu'];
    $harga = $_POST['harga'];
    $desk = $_POST['desk'];
    $status = $_POST['status'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_new    = date('dmYHis') . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], "img/menu/" . $gambar_new);
    mysqli_query($db, "INSERT INTO menu(kd_menu,kd_ktgr,nama_menu,harga,deskripsi,gambar,status) VALUES ('$kd_menu','$kd_ktgr','$nm_menu','$harga','$desk','$gambar_new','$status')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=menu'</script>";
}

?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=menu">Data Menu</a></li>
        <li class="breadcrumb-item active">Tambah Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Menu</b>
        </div>
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Menu</label>
                    <?php

                    $sql1  = "SELECT max(kd_menu) AS terakhirpas FROM menu";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 5, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "MENU-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_menu" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kd_ktgr" class="form-control">
                        <?php
                        $qr = mysqli_query($db, "SELECT * FROM kategori");
                        $hitung = mysqli_num_rows($qr);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($qr)) {
                        ?>
                                <option value="<?php echo $pecah['kd_ktgr']; ?>"><?php echo $pecah['nm_ktgr']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" name="nm_menu" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="desk" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="idkaryawan">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tersedia">
                        <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tidak Tersedia">
                        <label class="form-check-label" for="inlineRadio2">Tidak Tersedia</label>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="admin.php?page=menu" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>