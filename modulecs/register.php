<?php
if (isset($_POST['register'])) {

    $id_plg  = $_POST['id_plg'];
    $nama_plg   = $_POST['nama_plg'];
    $jk   = $_POST['jk'];
    $alamat   = $_POST['alamat'];
    $email   = $_POST['email'];
    $pass   = $_POST['pass'];
    $repass   = $_POST['repass'];
    $nope   = $_POST['nope'];

    $result = mysqli_query($db, "SELECT emails FROM users WHERE emails='$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email Sudah Terdaftar')</script>";
        echo "<script>window.location='index.php?page=register'</script>";
    } elseif ($pass != $repass) {
        echo "<script>alert('Password Tidak Sama')</script>";
        echo "<script>window.location='index.php?page=register'</script>";
    } else {
        mysqli_query($db, "INSERT INTO pelanggan(id_pelanggan,nm_plg,jk,alamat,no_hp) VALUES('$id_plg','$nama_plg','$jk','$alamat','$nope')");

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        mysqli_query($db, "INSERT INTO users(id_users,emails,passwords,levels) VALUES('$id_plg','$email','$pass','Pelanggan')");
        echo "<script>alert('Akun Berhasil Dibuat')</script>";
        echo "<script>window.location='index.php?page=login'</script>";
    }
}
?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index.php?page=beranda">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">

            </div>
            <div class="col-lg-6 col-12">
                <h2>Register</h2>
                <p>Silahkan Buat Akun Anda</p>
                <!-- Form -->
                <form class="form" method="post">
                    <div class="form-group">
                        <!-- <label>ID Pelangan</label> -->
                        <?php

                        $sql1  = "SELECT max(id_pelanggan) AS terakhirpas FROM pelanggan";
                        $hasil1  = mysqli_query($db, $sql1);
                        $data1   = mysqli_fetch_array($hasil1);
                        $lastid1 = $data1['terakhirpas'];
                        $lastnourut1 = (int)substr($lastid1, 4, 5);
                        $nexturut1   = $lastnourut1 + 1;
                        $nextid1     = "PLG-" . sprintf("%05s", $nexturut1);

                        ?>
                        <input type="hidden" name="id_plg" class="form-control" value="<?= $nextid1; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_plg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <select name="jk" class="form-control">
                            <option>Laki-Laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="number" name="nope" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Re Password</label>
                        <input type="password" name="repass" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="register" class="btn">Register</button>
                    </div>
                </form>
                <!--/ End Form -->
            </div>
        </div>
    </div>
    </div>
</section>
<!--/ End Checkout -->