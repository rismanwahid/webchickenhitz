<!-- order bisa -->
<?php
if (isset($_POST['order'])) {
    $kd_jual  = $_SESSION['ss_jual'];
    $tgl_jual = date('Y-m-d H:i:s');
    $id_plg = $_SESSION['id_plg'];
    $alamat = $_POST['alamat'];
    $t_bayar = $_POST['t_bayar'];
    $_SESSION['ss_total'] = $_POST['total'];
    $ongkir = $_POST['ongkir'];
    $tarifkirim = $_POST['tarifkirim'];
    $kdkecamatan = $_POST['kecamatan'];
    $kdkelurahan = $_POST['kelurahan'];

    if ($tarifkirim == "") {
        echo "<script>alert('Silahkan Pilih Kabupaten Pengantaran!')</script>";
        echo "<script>window.location='index.php?page=checkout'</script>";
        return false;
    }

    if ($t_bayar == 'Transfer') {
        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,id_pelanggan,tipe_jual,tipe_ambil,kd_tarif,kd_kecamatan,kd_kelurahan,tarif,alamat_kirim,status) VALUES 
    ('$kd_jual','$tgl_jual','$id_plg','Biasa','Dikirim','$ongkir','$kdkecamatan','$kdkelurahan','$tarifkirim','$alamat','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar) VALUES ('$kd_jual','$t_bayar','Belum Melakukan Transfer')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Silahkan Melakukan Transfer')</script>";
        echo "<script>window.location='index.php?page=bayar'</script>";
    } else {

        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,id_pelanggan,tipe_jual,tipe_ambil,kd_tarif,kd_kecamatan,kd_kelurahan,tarif,alamat_kirim,status) VALUES 
        ('$kd_jual','$tgl_jual','$id_plg','Biasa','Dikirim','$ongkir','$kdkecamatan','$kdkelurahan','$tarifkirim','$alamat','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar,gambar_resi) VALUES ('$kd_jual','$t_bayar','Bayar Ditempat','-')");

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

// Order caterring
if (isset($_POST['order_catering'])) {
    $kd_jual  = $_SESSION['ss_jual'];
    $tgl_jual = date('Y-m-d H:i:s');
    $tgl_kirim = $_POST['tgl_kirim'] . ":00";
    $id_plg = $_SESSION['id_plg'];
    $alamat = $_POST['alamat'];
    $pengambilan = $_POST['pengambilan'];
    $ongkir = $_POST['ongkir'];
    $tarifkirim = $_POST['tarifkirim'];
    $kdkecamatan = $_POST['kecamatan'];
    $kdkelurahan = $_POST['kelurahan'];
    $_SESSION['ss_total'] = $_POST['total'];
    $_SESSION['ss_totalnon'] = $_POST['totalnon'];


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
        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,tgl_kirim,id_pelanggan,tipe_jual,tipe_ambil,kd_tarif,kd_kecamatan,kd_kelurahan,tarif,alamat_kirim,status) VALUES 
    ('$kd_jual','$tgl_jual','$tgl_kirim','$id_plg','Catering','$pengambilan','-','-','','','-','Sedang Dikonfirmasi')");

        mysqli_query($db, "INSERT INTO pembayaran(kd_penjualan,tipe_bayar,status_bayar) VALUES ('$kd_jual','Transfer','Belum Melakukan Transfer')");

        mysqli_query($db, "INSERT INTO det_penjualan(kd_penjualan,kd_menu,jumlah,harga) SELECT kd_penjualan,kd_menu,jumlah,harga FROM tmp_detpenjualan WHERE kd_penjualan='$kd_jual'");

        echo "<script>alert('Berhasil Melakukan Order, Mohon Tunggu Konfirmasi Dari Admin')</script>";
        echo "<script>window.location='index.php?page=bayar_catering'</script>";
    } else {

        if ($tarifkirim == "") {
            echo "<script>alert('Silahkan Pilih Kabupaten Pengantaran!')</script>";
            echo "<script>window.location='index.php?page=checkout'</script>";
            return false;
        }

        mysqli_query($db, "INSERT INTO penjualan(kd_penjualan,tgl_jual,tgl_kirim,id_pelanggan,tipe_jual,tipe_ambil,kd_tarif,kd_kecamatan,kd_kelurahan,tarif,alamat_kirim,status) VALUES 
        ('$kd_jual','$tgl_jual','$tgl_kirim','$id_plg','Catering','$pengambilan','$ongkir','$kdkecamatan','$kdkelurahan','$tarifkirim','$alamat','Sedang Dikonfirmasi')");

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
                            <div class="form-group">
                                <label>Tanggal Pengataran</label>
                                <input type="datetime-local" name="tgl_kirim" min="<?= date('Y-m-d'); ?>T00:00" class="form-control" required>
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
                                        document.getElementById("kabupatenkirim").style.display = "block";

                                    } else {
                                        document.getElementById("alamat_kirim").style.display = "none";
                                        document.getElementById("kabupatenkirim").style.display = "none";
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
                            <div class="form-group" id="kabupatenkirim" style="display: none;">
                                <label>Kabupaten</label><br>
                                <select name="ongkir" id="selectongkir" class="form-control">
                                    <option value="" disabled selected>--Pilih Kabupaten--</option>
                                    <?php
                                    $qr2 = mysqli_query($db, "SELECT * FROM kabupaten");
                                    $hitung2 = mysqli_num_rows($qr2);
                                    if ($hitung2 > 0) {
                                        while ($pecah2 = mysqli_fetch_assoc($qr2)) {
                                    ?>
                                            <option value="<?php echo $pecah2['kd_tarif']; ?>"><?php echo $pecah2['nm_kabupaten']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group" id="formkecamatan" style="display: none;">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group" id="formkelurahan" style="display: none;">
                                <label>Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group" id="alamat_kirim" style="display: none;">
                                <label>Alamat Pengiriman</label>
                                <textarea name="alamat" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <!-- <label>Tarif</label> -->
                                <input type="hidden" name="tarifkirim" id="tarifong" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>Total</label> -->
                                <input type="hidden" name="total" id="totalbayar1" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>Total tanpa kirim</label> -->
                                <input type="hidden" name="totalnon" value="<?= $pecah1['total']; ?>" readonly>
                            </div>
                            <div class="button">
                                <button type="submit" name="order_catering" class="btn">ORDER</button>
                            </div>
                        <?php } else { ?>
                            <!-- orderbiasa -->
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
                                    <option>Bayar Ditempat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kabupaten</label><br>
                                <select name="ongkir" id="selectongkir" class="form-control">
                                    <option value="" disabled selected>--Pilih Kabupaten--</option>
                                    <?php
                                    $qr2 = mysqli_query($db, "SELECT * FROM kabupaten");
                                    $hitung2 = mysqli_num_rows($qr2);
                                    if ($hitung2 > 0) {
                                        while ($pecah2 = mysqli_fetch_assoc($qr2)) {
                                    ?>
                                            <option value="<?php echo $pecah2['kd_tarif']; ?>"><?php echo $pecah2['nm_kabupaten']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group" id="formkecamatan" style="display: none;">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group" id="formkelurahan" style="display: none;">
                                <label>Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class=" form-group">
                                <label>Alamat Lengkap Pengiriman</label>
                                <textarea name="alamat" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <!-- <label>Tarif</label> -->
                                <input type="hidden" name="tarifkirim" id="tarifong" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>Total</label> -->
                                <input type="hidden" name="total" id="totalbayar1" readonly>
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
                        <div class="content">
                            <ul>
                                <li>Sub Total<span><strong><?= $pecah1['total']; ?></strong></span></li>
                                <li>Ongkir<span>
                                        <strong id='tarifon1'> </strong> </span> </li>
                                <li class=" last">Total Bayar<span><strong id="ongkirrr">
                                        </strong></span></li>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#selectongkir").change(function() {
            var selectongkir = $("#selectongkir").val();
            $.ajax({
                type: 'POST',
                url: 'http://localhost/chickenhitz/modulecs/vongkir.php',
                data: {
                    selectongkir: selectongkir
                },
                cache: false,
                success: function(hasil) {
                    var resultobj2 = JSON.parse(hasil);
                    var tariff = resultobj2.result['tarif'];
                    var ongkir = resultobj2.result2['totalbayar'];
                    $('#tarifong').val(tariff);
                    $('#totalbayar1').val(ongkir);
                    $('#tarifon1').html(tariff);
                    $('#ongkirrr').html(ongkir);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#selectongkir").change(function() {
            var kabupaten = $("#selectongkir").val();
            $.ajax({
                type: 'POST',
                url: "http://localhost/chickenhitz/modulecs/v_kecamatan.php",
                data: {
                    selectongkir: kabupaten
                },
                cache: false,
                success: function(msg) {
                    $("#formkecamatan").show();
                    $("#kecamatan").html(msg);
                }
            });
        });
        $("#kecamatan").change(function() {
            var kecamatan = $("#kecamatan").val();
            $.ajax({
                type: 'POST',
                url: "http://localhost/chickenhitz/modulecs/v_kelurahan.php",
                data: {
                    kecamatan: kecamatan
                },
                cache: false,
                success: function(msg) {
                    $("#formkelurahan").show();
                    $("#kelurahan").html(msg);
                }
            });
        });
    });
</script>