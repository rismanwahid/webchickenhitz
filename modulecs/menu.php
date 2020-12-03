<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tamcartmn') {
        $id_penjualan = $_SESSION['ss_jual'];
        $kd_menu = $_GET['kd_menu'];
        $harga  = $_GET['harga'];

        $result = mysqli_query($db, "SELECT kd_menu FROM tmp_detpenjualan WHERE kd_menu='$kd_menu' AND kd_penjualan='$id_penjualan'");
        if (mysqli_fetch_assoc($result)) {
            mysqli_query($db, "UPDATE tmp_detpenjualan SET jumlah=jumlah+1 WHERE kd_menu='$kd_menu' AND kd_penjualan='$id_penjualan'");
            echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
            echo "<script>window.location='index.php?page=menu&kd_ktgr=$_GET[kd_ktgr]</script>";
        } else {
            mysqli_query($db, "INSERT INTO tmp_detpenjualan(kd_penjualan,kd_menu,harga) VALUES ('$id_penjualan','$kd_menu','$harga')");

            echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
            echo "<script>window.location='index.php?page=menu&kd_ktgr=$_GET[kd_ktgr]'</script>";
        }
    }
}

$kd = $_GET['kd_ktgr'];

$nama = mysqli_query($db, "SELECT kategori.nm_ktgr FROM kategori WHERE kd_ktgr='$kd'");
$hasilnama = mysqli_fetch_array($nama);
?>
<section class="shop-home-list section mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2><?= $hasilnama['nm_ktgr']; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $query  = mysqli_query($db, "SELECT menu.*,kategori.* FROM menu JOIN kategori ON menu.kd_ktgr=kategori.kd_ktgr WHERE kategori.kd_ktgr='$kd'");
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
                                            echo "<a href='index.php?page=menu&aksi=tamcartmn&kd_menu=$pecah[kd_menu]&harga=$pecah[harga]&kd_ktgr=$pecah[kd_ktgr]' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                        } else {
                                            echo "<a href='index.php?page=login' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#"><?= $pecah['nama_menu']; ?></a></h4>
                                        <p class="price with-discount"><?= $pecah['harga']; ?></p>
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