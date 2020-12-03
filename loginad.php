<?php

include 'db.php';

if (isset($_SESSION['no_user'])) {
    header("location:admin.php");
    exit;
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    $result = mysqli_query($db, "SELECT users.*,karyawan.nm_karyawan,karyawan.id_karyawan FROM users JOIN karyawan ON users.id_users=karyawan.id_karyawan WHERE users.emails='$email' ");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        if (password_verify($pass, $row['passwords'])) {
            $_SESSION['no_user'] = $row['no'];
            $_SESSION['nama'] = $row['nm_karyawan'];
            $_SESSION['email'] = $row['emails'];
            $_SESSION['password'] = $row['passwords'];
            $_SESSION['level'] = $row['levels'];
            $_SESSION['id_karyawan'] = $row['id_karyawan'];

            echo "<script>window.location='admin.php'</script>";
        } else {
            echo "<script>window.location='loginad.php?alert=1'</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login | Chicken Hitz Penjualan</title>
    <!-- Favicon -->
    <link rel="icon" type="asetcs/eshop/image/png" href="img/logoch.jpg">
    <link href="aset/dist/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-secondary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                    <?php
                                    // fungsi untuk menampilkan pesan
                                    // jika alert = "" (kosong)
                                    // tampilkan pesan "" (kosong)
                                    if (empty($_GET['alert'])) {
                                        echo "";
                                    }
                                    // jika alert = 1
                                    // tampilkan pesan Gagal "Username atau Password salah, cek kembali Username dan Password Anda"
                                    elseif ($_GET['alert'] == 1) {
                                        echo "<div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-times-circle'></i> Login Anda Gagal!</h4>
                Email atau Password yang anda masukan salah, cek kembali Email dan Password anda!
              </div>";
                                    }
                                    // jika alert = 2
                                    // tampilkan pesan Sukses "Anda telah berhasil logout"
                                    elseif ($_GET['alert'] == 2) {
                                        echo "<div class='alert alert-primary' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Anda telah berhasil melakukan logout.
              </div>";
                                    } elseif ($_GET['alert'] == 3) {
                                        echo "<div class='alert alert-warning' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fas fa-info'></i>
                Silahkan Melakukan Login Terlebih Dahulu!
              </div>";
                                    }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <form method="POST" role="form">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Masukan email" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" placeholder="Masukan password" name="pass" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?php echo "Copyright © " . (int)date('Y') . " Chicken Hitz"; ?></div>
                    </div>
                </div>
        </div>
    </div>
    </footer>
    </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="aset/dist/js/scripts.js"></script>
</body>

</html>