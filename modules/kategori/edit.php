<?php
if (isset($_POST['simpan'])) {
    $kd_ktgr  = $_POST['kd_ktgr'];
    $nm_ktgr   = $_POST['nm_ktgr'];

    mysqli_query($db, "UPDATE kategori SET
    nm_ktgr = '$nm_ktgr' WHERE kd_ktgr='$kd_ktgr'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=kategori'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kategori">Data Kategori</a></li>
        <li class="breadcrumb-item active">Edit Data Kategori</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Data Kategori</b>
        </div>
        <form role="form" method="POST">
            <?php
            $id = $_GET['kd_ktgr'];
            $query  = mysqli_query($db, "SELECT * FROM kategori WHERE kd_ktgr='$id'");
            $pecah = mysqli_fetch_assoc($query)
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label>KD Kategori</label>
                    <input type="text" class="form-control" name="kd_ktgr" value="<?= $pecah['kd_ktgr']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="nm_ktgr" value="<?= $pecah['nm_ktgr']; ?>">
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kategori" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>