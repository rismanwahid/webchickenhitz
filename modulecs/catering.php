<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'cart_catering') {
        $id_penjualan = $_SESSION['ss_jual'];
        $kd_paketcatering = $_GET['kd_paketcatering'];
        // $harga  = $_GET['harga'];

        $qrviewmenu = mysqli_query($db, "SELECT menu.kd_menu,menu.harga FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE det_paketcatering.kd_paketcatering='$kd_paketcatering'");

        while ($temp = mysqli_fetch_assoc($qrviewmenu)) {
            $data[] = $temp;
        }



        $data1 = [];
        foreach ($data as $valcek) {

            $result = mysqli_query($db, "SELECT kd_menu,kd_detjual FROM tmp_detpenjualan WHERE kd_menu='" . $valcek['kd_menu'] . "' AND kd_penjualan='$id_penjualan'");
            while ($temp1 = mysqli_fetch_assoc($result)) {
                $data1[$temp1['kd_menu']] = $temp1['kd_detjual'];
            }
        }

        // var_dump($data1);
        // print_r($data1);
        // die;

        // $keranjang['kodemenu'] = "kd_detjual";

        foreach ($data as $key => $val) {


            if (array_key_exists($val['kd_menu'], $data1)) {
                $kd_detjual = $data1[$val['kd_menu']];
                mysqli_query($db, "UPDATE tmp_detpenjualan SET jumlah=jumlah+1 WHERE kd_detjual = '{$kd_detjual}'");

                echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
                echo "<script>window.location='index.php?page=catering'</script>";
            } else {
                mysqli_query($db, "INSERT INTO tmp_detpenjualan(kd_penjualan,kd_menu,jumlah,harga) VALUES ('$id_penjualan','" . $val['kd_menu'] . "','40','" . $val['harga'] . "')");
                echo "<script>alert('Menu Ditambahkan Dikeranjang')</script>";
                echo "<script>window.location='index.php?page=catering'</script>";
            }
        }
    }
}
?>
<section class="shop-home-list section mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Menu Catering</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $query  = mysqli_query($db, "SELECT * FROM paket_catering");
            $hitung = mysqli_num_rows($query);
            $hitung = mysqli_num_rows($query);
            if ($hitung > 0) {
                while ($pecah = mysqli_fetch_assoc($query)) {
            ?>
                    <div class="col-md-4">
                        <div class="single-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        <img src="img/paketcat/<?= $pecah['gambar']; ?>" alt="#">
                                        <form method="post">
                                            <?php

                                            // $query3 = mysqli_query($db, "SELECT paket_catering.kd_paketcatering FROM paket_catering WHERE kd_paketcatering='" . $pecah['kd_paketcatering'] . "'");

                                            // $hasil = mysqli_fetch_assoc($query3);
                                            // var_dump($data);
                                            // die;
                                            // print_r($data);
                                            // die;


                                            if (isset($_SESSION['id_user_member'])) {
                                                // $pilihcat = mysqli_query($db, "SELECT menu.kd_menu,menu.harga FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE det_paketcatering.kd_paketcatering='{$pecah['kd_paketcatering']}'");
                                                // while ($temp = mysqli_fetch_assoc($pilihcat)) {
                                                //     $data[] = $temp;
                                                // }
                                                // foreach ($data as $val) {
                                                echo "<a href='index.php?page=catering&aksi=cart_catering&kd_paketcatering=" . $pecah['kd_paketcatering'] . "' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                                // }
                                            } else {
                                                echo "<a href='index.php?page=login' class='buy'><i class='fa fa-shopping-bag'></i></a>";
                                            }

                                            ?>
                                        </form>
                                    </div>
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#"><?= $pecah['nm_paketcatering']; ?></a></h4>
                                        <?php
                                        $query1 = mysqli_query($db, "SELECT GROUP_CONCAT(menu.nama_menu SEPARATOR' , ') AS nama_mn FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE det_paketcatering.kd_paketcatering='" . $pecah['kd_paketcatering'] . "'");
                                        $hitung1 = mysqli_num_rows($query1);
                                        if ($hitung1 > 0) {
                                            while ($pecah1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                                <p> <?= $pecah1['nama_mn']; ?></p> <?php
                                                                                    $query2 = mysqli_query($db, "SELECT SUM(menu.harga*40) AS hargamn FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE det_paketcatering.kd_paketcatering='" . $pecah['kd_paketcatering'] . "'");
                                                                                    $hitung2 = mysqli_num_rows($query2);
                                                                                    if ($hitung2 > 0) {
                                                                                        while ($pecah2 = mysqli_fetch_assoc($query2)) {

                                                                                    ?> <p class="price with-discount"><?= rupiah($pecah2['hargamn']); ?></p>
                                                <?php }
                                                                                    } ?>
                                        <?php }
                                        } ?>
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