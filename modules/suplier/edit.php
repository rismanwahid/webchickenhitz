<?php
if (isset($_POST['simpan'])) {
    $kd_suplier  = $_POST['kd_suplier'];
    $nm_suplier   = $_POST['nm_suplier'];
    $email   = $_POST['email'];
    $nope = $_POST['nope'];
    $alamat = $_POST['alamat'];

    mysqli_query($db, "UPDATE suplier SET
    nm_suply = '$nm_suplier',
    email = '$email',
    no_hp = '$nope',
    alamat = '$alamat' WHERE kd_suply='$kd_suplier'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=suplier'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=suplier">Data Suplier</a></li>
        <li class="breadcrumb-item active">Edit Data Suplier</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Data Suplier</b>
        </div>
        <form role="form" method="POST">
            <?php
            $id = $_GET['kd_suply'];
            $query  = mysqli_query($db, "SELECT * FROM suplier WHERE kd_suply='$id'");
            $pecah = mysqli_fetch_assoc($query)
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label>KD Suplier</label>
                    <input type="text" class="form-control" name="kd_suplier" value="<?= $pecah['kd_suply']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Suplier</label>
                    <input type="text" class="form-control" name="nm_suplier" value="<?= $pecah['nm_suply']; ?>">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $pecah['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="nope">No HP</label>
                    <input type="number" class="form-control" name="nope" value="<?= $pecah['no_hp']; ?>">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" cols="30" rows="3" class="form-control"><?= $pecah['alamat']; ?></textarea>
                </div>

            </div>
            <div class="card-footer">
                <a href="admin.php?page=suplier" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>