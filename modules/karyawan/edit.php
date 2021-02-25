<?php
if (isset($_POST['simpan'])) {
    $id_karyawan  = $_POST['id_karyawan'];
    $nama_karyawan   = $_POST['nama_karyawan'];
    $jk   = $_POST['jk'];
    $email   = $_POST['email'];
    $pass   = $_POST['email'];
    $nope = $_POST['nope'];
    $jabatan  = $_POST['jabatan'];
    $alamat  = $_POST['alamat'];

    mysqli_query($db, "UPDATE karyawan SET
    nm_karyawan = '$nama_karyawan',
    jk = '$jk',
    jabatan = '$jabatan',
    no_hp = '$nope',
    alamat = '$alamat' WHERE id_karyawan='$id_karyawan'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=karyawan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=karyawan">Data Karyawan</a></li>
        <li class="breadcrumb-item active">Edit Data Karyawan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Data Karyawan</b>
        </div>
        <form role="form" method="POST">
            <?php
            $id = $_GET['id_karyawan'];
            $query  = mysqli_query($db, "SELECT * FROM karyawan WHERE id_karyawan='$id'");
            $pecah = mysqli_fetch_assoc($query)
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="idkaryawan">ID Karyawan</label>
                    <input type="text" class="form-control" name="id_karyawan" value="<?= $pecah['id_karyawan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <?php
                    echo "<input type='text' name='nama_karyawan' value='$pecah[nm_karyawan]' class='form-control' size='120' onkeypress='return event.charCode < 48 || event.charCode  >57'>";
                    ?>
                </div>
                <div class="form-group">
                    <label for="idkaryawan">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" <?php if ($pecah['jk'] == "Laki-Laki") {
                                                                                    echo "checked='true'";
                                                                                }
                                                                                ?> value="Laki-Laki">
                        <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" <?php if ($pecah['jk'] == "Perempuan") {
                                                                                    echo "checked='true'";
                                                                                }
                                                                                ?> value="Perempuan">
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $pecah['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" name="jabatan">
                        <option <?php if ($pecah['jabatan'] == "Admin") {
                                    echo "selected='true'";
                                }
                                ?>>Admin</option>
                        <option <?php if ($pecah['jabatan'] == "Owner") {
                                    echo "selected='true'";
                                }
                                ?>>Owner</option>
                    </select>
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
                <a href="admin.php?page=karyawan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>