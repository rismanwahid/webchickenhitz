<?php
if (isset($_POST['order'])) {
    $kd_jual  = $_SESSION['ss_jual'];
    $tgl_jual = date('Y-m-d H:i:s');
    $id_plg = $_SESSION['id_plg'];
    $alamat = $_POST['alamat'];
    $t_bayar = $_POST['t_bayar'];
    $_SESSION['ss_total'] = $_POST['total'];

    if ($t_bayar == 'Transfer') {
        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,id_pelanggan,tipe_jual,tipe_ambil,alamat_kirim,status) VALUES 
    ('$kd_jual','$tgl_jual','$id_plg','Biasa','Dikirim','$alamat','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar) VALUES ('$kd_jual','$t_bayar','Belum Melakukan Transfer')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Silahkan Melakukan Transfer')</script>";
        echo "<script>window.location='index.php?page=bayar'</script>";
    } else {

        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,id_pelanggan,tipe_jual,tipe_ambil,alamat_kirim,status) VALUES 
        ('$kd_jual','$tgl_jual','$id_plg','Biasa','Dikirim','$alamat','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar,gambar_resi) VALUES ('$kd_jual','$t_bayar','Cash','-')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Berhasil Melakukan Order, Mohon Tunggu Konfirmasi Dari Admin')</script>";
        echo "<script>window.location='index.php?page=riwayat_trans'</script>";
    }


    $sql  = "SELECT max(kd_penjualan) AS terakhir FROM penjualan";
    $hasil  = mysqli_query($db, $sql);
    $data   = mysqli_fetch_array($hasil);
    $lastid = $data['terakhir'];
    $lastnourut = (int)substr($lastid, 3, 5);
    $nexturut   = $lastnourut + 1;
    $nextid     = "JL-" . sprintf("%05s", $nexturut);

    $_SESSION['ss_jual'] =  $nextid . date('dmYHis');
}

if (isset($_POST['order_catering'])) {
    $kd_jual  = $_SESSION['ss_jual'];
    $tgl_jual = date('Y-m-d H:i:s');
    $tgl_kirim = $_POST['tgl_kirim'] . ":00";
    $id_plg = $_SESSION['id_plg'];
    $alamat = $_POST['alamat'];
    $pengambilan = $_POST['pengambilan'];
    $_SESSION['ss_total'] = $_POST['total'];

    $awal   = date_create($tgl_jual);
    $akhir   = date_create($tgl_kirim);
    $interval = date_diff($awal, $akhir);
    $cek = $interval->format('%d');

    if ($cek < 2) {
        echo "<script>alert('Tanggal Pemesanan Minimal H-3 Dari Tanggal Sekarang')</script>";
        echo "<script>window.location='index.php?page=checkout'</script>";
        return false;
    }

    if ($pengambilan == 'Di Toko') {
        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,tgl_kirim,id_pelanggan,tipe_jual,tipe_ambil,alamat_kirim,status) VALUES 
    ('$kd_jual','$tgl_jual','$tgl_kirim','$id_plg','Catering','$pengambilan','-','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar) VALUES ('$kd_jual','Transfer','Belum Melakukan Transfer')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Berhasil Melakukan Order, Mohon Tunggu Konfirmasi Dari Admin')</script>";
        echo "<script>window.location='index.php?page=bayar_catering'</script>";
    } else {

        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,tgl_kirim,id_pelanggan,tipe_jual,tipe_ambil,alamat_kirim,status) VALUES 
        ('$kd_jual','$tgl_jual','$tgl_kirim','$id_plg','Catering','$pengambilan','$alamat','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar) VALUES ('$kd_jual','Transfer','Belum Melakukan Transfer')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Berhasil Melakukan Order, Mohon Tunggu Konfirmasi Dari Admin')</script>";
        echo "<script>window.location='index.php?page=bayar_catering'</script>";
    }


    $sql  = "SELECT max(kd_penjualan) AS terakhir FROM penjualan";
    $hasil  = mysqli_query($db, $sql);
    $data   = mysqli_fetch_array($hasil);
    $lastid = $data['terakhir'];
    $lastnourut = (int)substr($lastid, 3, 5);
    $nexturut   = $lastnourut + 1;
    $nextid     = "JL-" . sprintf("%05s", $nexturut);

    $_SESSION['ss_jual'] =  $nextid . date('dmYHis');
}


?>
<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2>Form Order</h2>
                    <p>Silahkan menginputkan data pada form dibawah</p>
                    <!-- Form -->
                    <?php
                    $id_pelanggan = $_SESSION['id_plg'];
                    $kd_penjualan = $_SESSION['ss_jual'];

                    $query = mysqli_query($db, "SELECT pelanggan.nm_plg,pelanggan.no_hp FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

                    $pecah = mysqli_fetch_assoc($query);

                    $query1 = mysqli_query($db, "SELECT SUM(tmp_detpenjualan.jumlah*tmp_detpenjualan.harga) AS total, SUM(tmp_detpenjualan.jumlah) AS totaljum FROM tmp_detpenjualan WHERE kd_penjualan='$kd_penjualan'");

                    $pecah1 = mysqli_fetch_assoc($query1);


                    ?>
                    <form class="form" method="post">
                        <?php
                        if ($pecah1['totaljum'] >= 40) {
                        ?>
                            <!-- <div class="form-group">
                                <label>Tanggal Pemesanan</label>
                                <input type="datetime-local" name="tgl_pesan" min="<?= date('Y-m-d'); ?>T00:00" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <label>Tanggal Pemesanan</label>
                                <input type="datetime-local" name="tgl_kirim" min="<?= date('Y-m-d'); ?>T00:00" class="form-control">
                            </div>
                            <div class=" form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_plg" class="form-control" value="<?= $pecah['nm_plg']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="no_hp" class="form-control" value="<?= $pecah['no_hp']; ?>" readonly>
                            </div>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script type="text/javascript">
                                function yesnoCheck(that) {
                                    if (that.value == "Dikirim") {
                                        document.getElementById("alamat_kirim").style.display = "block";

                                    } else {
                                        document.getElementById("alamat_kirim").style.display = "none";
                                    }
                                }
                            </script>
                            <div class="form-group" id="selectbk" style="display: block;">
                                <label>Pengambilan</label><br>
                                <select name="pengambilan" class="form-control" onchange="yesnoCheck(this);">
                                    <option value="Di Toko">Di Toko</option>
                                    <option value="Dikirim">Dikirim</option>
                                </select>
                            </div>
                            <div class="form-group" id="alamat_kirim" style="display: none;">
                                <label>Alamat Pengiriman</label>
                                <textarea name="alamat" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <!-- <label>Total</label> -->
                                <input type="hidden" name="total" value="<?= $pecah1['total']; ?>" readonly>
                            </div>
                            <div class="button">
                                <button type="submit" name="order_catering" class="btn">ORDER</button>
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_plg" class="form-control" value="<?= $pecah['nm_plg']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="no_hp" class="form-control" value="<?= $pecah['no_hp']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tipe Pembayaran</label><br>
                                <select name="t_bayar" class="form-control">
                                    <option>Transfer</option>
                                    <option>Cash</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat Pengiriman</label>
                                <textarea name="alamat" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <!-- <label>Total</label> -->
                                <input type="hidden" name="total" value="<?= $pecah1['total']; ?>" readonly>
                            </div>
                            <div class="button">
                                <button type="submit" name="order" class="btn">ORDER</button>
                            </div>
                        <?php } ?>

                        <!--/ End Form -->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>CART TOTALS</h2>
                        <div class="content">
                            <ul>
                                <li>Total<span><strong><?= rupiah($pecah1['total']); ?></strong></span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>Pembayaran Via Transfer</h2>
                        <div class="content">
                            <div class="checkbox">
                                <table>
                                    <tr>
                                        <td>Mandiri</td>
                                        <td>:</td>
                                        <td>121889098809889</td>
                                    </tr>
                                    <tr>
                                        <td>BNI</td>
                                        <td>:</td>
                                        <td>121889098809889</td>
                                    </tr>
                                    <tr>
                                        <td>Gopay</td>
                                        <td>:</td>
                                        <td>1245323113</td>
                                    </tr>
                                    <tr>
                                        <td>Ovo</td>
                                        <td>:</td>
                                        <td>1121212121</td>
                                    </tr>
                                </table>
                                <strong>Atas Nama Chicken Hitz</strong>
                            </div>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Payment Method Widget -->
                    <!--/ End Payment Method Widget -->
                    <!-- Button Widget -->
                    <div class="single-widget get-button">
                        <div class="content">
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!--/ End Checkout -->