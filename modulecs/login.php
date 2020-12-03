<?php
if (isset($_POST['login'])) {
    $email  = $_POST['email'];
    $pass  = $_POST['pass'];

    $cobalogin = mysqli_query($db, "SELECT users.*,pelanggan.nm_plg,pelanggan.id_pelanggan FROM users JOIN pelanggan ON users.id_users=pelanggan.id_pelanggan WHERE users.emails='$email' ");

    $sql  = "SELECT max(kd_penjualan) AS terakhir FROM penjualan";
    $hasil  = mysqli_query($db, $sql);
    $data   = mysqli_fetch_array($hasil);
    $lastid = $data['terakhir'];
    $lastnourut = (int)substr($lastid, 3, 5);
    $nexturut   = $lastnourut + 1;
    $nextid     = "JL-" . sprintf("%05s", $nexturut);

    if (mysqli_num_rows($cobalogin) == 1) {
        $row = mysqli_fetch_array($cobalogin);
        if (password_verify($pass, $row['passwords'])) {

            $_SESSION['id_user_member'] = $row['no'];
            $_SESSION['id_plg'] = $row['id_users'];
            $_SESSION['username_member'] = $row['emails'];
            $_SESSION['password_member'] = $row['passwords'];
            $_SESSION['level_member'] = $row['levels'];
            $_SESSION['nm_plg'] = $row['nm_plg'];
            $_SESSION['ss_jual'] =  $nextid . date('dmYHis');

            echo "<script>window.location='index.php?page=beranda'</script>";
        } else {
            echo "<script>alert('Login Anda Gagal!')</script>";
            echo "<script>window.location='index.php?page=login'</script>";
        }
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
                        <li class="active"><a href="#">Login</a></li>
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
                <h2>Login</h2>
                <p>Silahkan Login Ke Akun Anda</p>
                <!-- Form -->
                <form class="form" method="post" action="#">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Masukan Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn">Login</button>
                        <p class="mt-3">Belum Punya Akun?</p>
                        <a href="index.php?page=register">
                            <p style="color: blue; text-decoration: underline;">Buat Akun Sekarang</p>
                        </a>
                    </div>
                </form>
                <!--/ End Form -->
            </div>
        </div>
    </div>
    </div>
</section>
<!--/ End Checkout -->