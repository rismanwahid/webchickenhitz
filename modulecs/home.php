<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tamcart') {
        $id_penjualan = $_SESSION['ss_jual'];
        $kd_menu = $_GET['kd_menu'];
        $harga  = $_GET['harga'];

        $result = mysqli_query($db, "SELECT kd_menu FROM tmp_detpenjualan WHERE kd_menu='$kd_menu' AND kd_penjualan='$id_penjualan'");
        if (mysqli_fetch_assoc($result)) {
            mysqli_query($db, "UPDATE tmp_detpenjualan SET jumlah=jumlah+1 WHERE kd_menu='$kd_menu' AND kd_penjualan='$id_penjualan'");
            echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
            echo "<script>window.location='index.php?page=beranda'</script>";
        } else {
            mysqli_query($db, "INSERT INTO tmp_detpenjualan(kd_penjualan,kd_menu,harga) VALUES ('$id_penjualan','$kd_menu','$harga')");

            echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
            echo "<script>window.location='index.php?page=beranda'</script>";
        }
    }
}
?>

<!-- Start Small Banner  -->

<!-- End Small Banner -->

<!-- Start Product Area -->
<!-- End Product Area -->

<!-- Start Midium Banner  -->

<!-- End Midium Banner -->

<div class="shop-home-list section mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Menu Terlaris</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    <!-- Start Single Product -->
                    <?php
                    $query1 = mysqli_query($db, "SELECT menu.*,det_penjualan.kd_menu,det_penjualan.kd_menu FROM det_penjualan JOIN menu ON det_penjualan.kd_menu=menu.kd_menu WHERE det_penjualan.jumlah>=20 GROUP BY det_penjualan.kd_menu");
                    $hitung1 = mysqli_num_rows($query);
                    if ($hitung1 > 0) {
                        while ($pecah1 = mysqli_fetch_assoc($query1)) {

                    ?>
                            <div class="single-list mr-3">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="list-image overlay">
                                            <img src="img/menu/<?= $pecah1['gambar']; ?>" alt="#">
                                            <?php
                                            if (isset($_SESSION['id_user_member'])) {
                                                echo "<a href='index.php?aksi=tamcart&kd_menu=$pecah1[kd_menu]&harga=$pecah1[harga]' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                            } else {
                                                echo "<a href='index.php?page=login' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 no-padding">
                                        <div class="content">
                                            <h4 class="title"><a href="#"><?= $pecah1['nama_menu']; ?></a></h4>
                                            <p class="price with-discount"><?= $pecah1['harga']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                    <!-- End Single Product -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Menu</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $query  = mysqli_query($db, "SELECT menu.*,kategori.nm_ktgr FROM menu JOIN kategori ON menu.kd_ktgr=kategori.kd_ktgr");
            $hitung = mysqli_num_rows($query);
            if ($hitung > 0) {
                while ($pecah = mysqli_fetch_assoc($query)) {
            ?>
                    <div class="col-md-4">
                        <div class="single-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        <img src="img/menu/<?= $pecah['gambar']; ?>" alt="#">
                                        <?php
                                        if (isset($_SESSION['id_user_member'])) {
                                            echo "<a href='index.php?aksi=tamcart&kd_menu=$pecah[kd_menu]&harga=$pecah[harga]' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                        } else {
                                            echo "<a href='index.php?page=login' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#"><?= $pecah['nama_menu']; ?></a></h4>
                                        <p class="price with-discount"><?= rupiah($pecah['harga']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>