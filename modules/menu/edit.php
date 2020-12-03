<?php
if (isset($_POST['simpan'])) {
    $kd_menu  = $_POST['kd_menu'];
    $kd_ktgr   = $_POST['kd_ktgr'];
    $nm_menu = $_POST['nm_menu'];
    $harga = $_POST['harga'];
    $desk = $_POST['desk'];
    $status = $_POST['status'];

    if ($_FILES["gambar"]["name"] == "") {
        $update_gambar  = "";
    } else {
        $nama_file  = $_FILES["gambar"]["name"];
        $gambar_new    = date('dmYHis') . $nama_file;
        $update_gambar = ",gambar='$gambar_new'";
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/menu/" . $gambar_new);
    }

    mysqli_query($db, "UPDATE menu SET
    kd_menu = '$kd_menu',
    kd_ktgr = '$kd_ktgr',
    nama_menu = '$nm_menu',
    harga = '$harga',
    deskripsi = '$desk',
    status = '$status' $update_gambar WHERE kd_menu='$kd_menu'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=menu'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=menu">Data Menu</a></li>
        <li class="breadcrumb-item active">Edit Data Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Data Menu</b>
        </div>
        <form role="form" method="POST" enctype="multipart/form-data">
            <?php
            $id = $_GET['kd_menu'];
            $query  = mysqli_query($db, "SELECT menu.*,kategori.nm_ktgr FROM menu JOIN kategori ON menu.kd_ktgr=kategori.kd_ktgr WHERE menu.kd_menu='$id'");
            $pecah = mysqli_fetch_assoc($query)
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label>KD Menu</label>
                    <input type="text" class="form-control" name="kd_menu" value="<?= $pecah['kd_menu']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kd_ktgr" class="form-control">
                        <?php
                        $query1 = mysqli_query($db, "SELECT * FROM kategori");

                        while ($row = mysqli_fetch_array($query1)) {
                            if ($pecah['kd_ktgr'] == $row['kd_ktgr']) {
                                echo "<option value=$row[kd_ktgr] selected>$row[nm_ktgr]</option>";
                            } else {
                                echo "<option value=$row[kd_ktgr]>$row[nm_ktgr]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" name="nm_menu" value="<?= $pecah['nama_menu']; ?>">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" value="<?= $pecah['harga']; ?>">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="desk" cols="30" rows="5" class="form-control"><?= $pecah['deskripsi']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar</label><br>
                    <img src="img/menu/<?php echo $pecah['gambar']; ?> " width="100px"><br><br>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="idkaryawan">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" <?php if ($pecah['status'] == "Tersedia") {
                                                                                        echo "checked='true'";
                                                                                    }
                                                                                    ?> value="Tersedia">
                        <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" <?php if ($pecah['status'] == "Tidak Tersedia") {
                                                                                        echo "checked='true'";
                                                                                    }
                                                                                    ?> value="Tidak Tersedia">
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