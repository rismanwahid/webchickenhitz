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

    $result = mysqli_query($db, "SELECT emails FROM users WHERE emails='$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email Sudah Terdaftar')</script>";
        echo "<script>window.location='admin.php?page=tamkaryawan'</script>";

        return false;
    }


    mysqli_query($db, "INSERT INTO karyawan(id_karyawan,nm_karyawan,jk,email,jabatan,no_hp,alamat) VALUES ('$id_karyawan','$nama_karyawan','$jk','$email','$jabatan','$nope','$alamat')");

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users(id_users,emails,passwords,levels) VALUES ('$id_karyawan','$email','$pass','$jabatan')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=karyawan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=karyawan">Data Karyawan</a></li>
        <li class="breadcrumb-item active">Tambah Karyawan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Karyawan</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="idkaryawan">ID Karyawan</label>
                    <?php

                    $sql1  = "SELECT max(id_karyawan) AS terakhirpas FROM karyawan";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 4, 2);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "KAR-" . sprintf("%02s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="id_karyawan" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <?php
                    echo "<input type='text' name='nama_karyawan' class='form-control' size='120' onkeypress='return event.charCode < 48 || event.charCode  >57'>";
                    ?>
                </div>
                <div class="form-group">
                    <label for="idkaryawan">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Laki-Laki">
                        <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Perempuan">
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" name="jabatan">
                        <option>Admin</option>
                        <option>Owner</option>
                    </select>
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
                <a href="admin.php?page=karyawan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>