<?php

include 'db.php';

date_default_timezone_set('Asia/Jakarta');

// if (empty($_SESSION['no_user'])) {
//     header('location:loginad.php?alert=3');
// }

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'logout') {

        session_destroy();


        echo "<script>alert('Anda Telah Logout')</script>";
        echo "<script>window.location='index.php?page=beranda'</script>";
    }
}


function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>Chicken Hitz</title>
    <!-- Favicon -->
    <link rel="icon" type="asetcs/eshop/image/png" href="img/logoch.jpg">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="asetcs/eshop/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="asetcs/eshop/css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asetcs/eshop/css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="asetcs/eshop/css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="asetcs/eshop/css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="asetcs/eshop/css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="asetcs/eshop/css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="asetcs/eshop/css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="asetcs/eshop/css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="asetcs/eshop/css/slicknav.min.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="asetcs/eshop/css/reset.css">
    <link rel="stylesheet" href="asetcs/eshop/style.css">
    <link rel="stylesheet" href="asetcs/eshop/css/responsive.css">



</head>

<body class="js">

    <!-- Header -->
    <header class="header shop">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- Top Left -->
                        <div class="top-left">
                            <ul class="list-main">
                                <li><i class="fa fa-whatsapp"></i> +62 0858-7774-1889</li>
                            </ul>
                        </div>
                        <!--/ End Top Left -->
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <!-- Top Right -->
                        <div class="right-content">
                            <ul class="list-main">
                                <li><i class="ti-alarm-clock"></i> <a href="#">08:00-23:00</a></li>
                                <?php if (empty($_SESSION['id_user_member'])) {
                                    echo '<li><i class="ti-user"></i> <a href="#"></a></li>';
                                } else {
                                    echo "<li><i class='ti-user'></i> $_SESSION[nm_plg]<a href='#'></a></li>";
                                }  ?>

                                <?php if (empty($_SESSION['id_user_member'])) {
                                    echo "<li><i class='ti-power-off'></i><a href='index.php?page=login'>Login</a></li>";
                                } else {
                                    echo " <li><i class='ti-power-off'></i><a href='index.php?aksi=logout'>Logout</a></li>";
                                }  ?>

                            </ul>
                        </div>
                        <!-- End Top Right -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <div class="middle-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php?page=beranda">
                                <h4>Chicken Hitz</h4>
                            </a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                            <!-- Search Form -->
                            <div class="search-top">
                                <form class="search-form">
                                    <input type="text" placeholder="Search here..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <?php if (empty($_SESSION['ss_jual'])) {
                                echo "";
                            } else { ?>
                                <div class="sinlge-bar shopping">
                                    <?php
                                    $id = $_SESSION['ss_jual'];
                                    $qr = mysqli_query($db, "SELECT COUNT(tmp_detpenjualan.kd_menu) AS totalmenu FROM tmp_detpenjualan WHERE kd_penjualan='$id'");
                                    $hasil = mysqli_fetch_assoc($qr);
                                    ?>
                                    <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?= $hasil['totalmenu']; ?> </span></a>

                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span><?= $hasil['totalmenu']; ?> Menu</span>
                                            <?php
                                            if ($hasil['totalmenu'] == 0) {
                                                echo "";
                                            } else {
                                            ?>
                                                <a href="index.php?page=keranjang">Detail</a>
                                            <?php } ?>
                                        </div>
                                        <ul class="shopping-list">
                                            <?php
                                            $query  = mysqli_query($db, "SELECT tmp_detpenjualan.*,tmp_detpenjualan.jumlah*tmp_detpenjualan.harga AS totalharga,menu.nama_menu,menu.gambar FROM tmp_detpenjualan JOIN 
                                              menu ON menu.kd_menu=tmp_detpenjualan.kd_menu WHERE tmp_detpenjualan.kd_penjualan='$id'");
                                            $hitung = mysqli_num_rows($query);
                                            if ($hitung > 0) {
                                                while ($pecah = mysqli_fetch_assoc($query)) {
                                            ?>
                                                    <li>
                                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <h4 class="cart-img"><?= rupiah($pecah['totalharga']); ?></h4>
                                                        <h4><a href="#"><?= $pecah['nama_menu']; ?></a></h4>
                                                        <p class="quantity"><?= $pecah['jumlah']; ?></p>
                                                    </li>
                                            <?php }
                                            } ?>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <?php
                                                $qr1 = mysqli_query($db, "SELECT SUM(tmp_detpenjualan.jumlah*tmp_detpenjualan.harga) AS totals FROM tmp_detpenjualan WHERE kd_penjualan='$id'");
                                                $hasil1 = mysqli_fetch_assoc($qr1);
                                                ?>
                                                <span class="total-amount"><?= rupiah($hasil1['totals']); ?></span>
                                            </div>
                                            <?php
                                            if ($hasil['totalmenu'] == 0) {
                                                echo "";
                                            } else {
                                            ?>
                                                <a href="index.php?page=checkout" class="btn animate">ORDER</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <?php include 'navcs/navbar.php' ?>

        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->

    <!-- Slider Area -->


    <!-- Start Most Popular -->


    <!-- Start Shop Home List  -->

    <?php

    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'beranda') {
            include 'modulecs/home.php';
        } elseif ($_GET['page'] == 'login') {
            include 'modulecs/login.php';
        } elseif ($_GET['page'] == 'register') {
            include 'modulecs/register.php';
        } elseif ($_GET['page'] == 'menu') {
            include 'modulecs/menu.php';
        } elseif ($_GET['page'] == 'keranjang') {
            include 'modulecs/carts.php';
        } elseif ($_GET['page'] == 'checkout') {
            include 'modulecs/checkout.php';
        } elseif ($_GET['page'] == 'bayar') {
            include 'modulecs/bayar.php';
        } elseif ($_GET['page'] == 'riwayat_trans') {
            include 'modulecs/r_trans.php';
        } elseif ($_GET['page'] == 'catering') {
            include 'modulecs/catering.php';
        } elseif ($_GET['page'] == 'bayar_catering') {
            include 'modulecs/bayar_cat.php';
        } elseif ($_GET['page'] == 'upload_resi') {
            include 'modulecs/uploadresi.php';
        } elseif ($_GET['page'] == 'det_trans') {
            include 'modulecs/dettrans.php';
        } elseif ($_GET['page'] == 'profile') {
            include 'modulecs/profil.php';
        }
    } else {
        include 'modulecs/home.php';
    }

    ?>

    <!-- End Shop Home List -->

    <!-- Start Cowndown Area -->

    <!-- /End Cowndown Area -->

    <!-- Start Shop Blog  -->

    <!-- End Shop Blog  -->

    <!-- Start Shop Services Area -->

    <!-- End Shop Services Area -->

    <!-- Start Shop Newsletter  -->

    <!-- End Shop Newsletter -->


    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo">
                                <h4>Chicken Hitz</h4>
                            </div>
                            <p class="text">Chicken Hitz adalah sebuah usaha kuliner yang berbentuk restoran/café yang berdiri pada tanggal 17 Juni 2015.</p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">

                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->

                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Alamat</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>Jl. Perumnas No.01, Condongsari</li>
                                    <li>Condongcatur</li>
                                    <li>Depok</li>
                                    <li>Sleman</li>
                                    <li>Daerah Istimewa Yogyakarta</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="https://www.facebook.com/Chicken-Hitz-1818145744940783/" target="_blank"><i class="ti-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/hitschicken_id/?hl=id" target="_blank"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="copyright">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p><?php echo "Copyright © " . (int)date('Y') . " Chicken Hitz"; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /End Footer Area -->

    <!-- Jquery -->
    <script src="asetcs/eshop/js/jquery.min.js"></script>
    <script src="asetcs/eshop/js/jquery-migrate-3.0.0.js"></script>
    <script src="asetcs/eshop/js/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Popper JS -->
    <script src="asetcs/eshop/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="asetcs/eshop/js/bootstrap.min.js"></script>
    <!-- Slicknav JS -->
    <script src="asetcs/eshop/js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="asetcs/eshop/js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="asetcs/eshop/js/magnific-popup.js"></script>
    <!-- Waypoints JS -->
    <script src="asetcs/eshop/js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="asetcs/eshop/js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="asetcs/eshop/js/nicesellect.js"></script>
    <!-- Flex Slider JS -->
    <script src="asetcs/eshop/js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="asetcs/eshop/js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="asetcs/eshop/js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="asetcs/eshop/js/easing.js"></script>
    <!-- Active JS -->
    <script src="asetcs/eshop/js/active.js"></script>
</body>

</html>