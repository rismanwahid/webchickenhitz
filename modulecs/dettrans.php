<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index.php?page=riwayat_trans">Riwayat Transaksi<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">Detail Transaksi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<section class="content mt-3">
    <div class="container">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                    <div class="card-header">
                        <b>Detail Transaksi</b>
                        <a href="index.php?page=riwayat_trans" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <?php
                        $kdjual = $_GET['kd_penjualan'];

                        $query = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,pelanggan.nm_plg,penjualan.status,penjualan.tgl_kirim,pembayaran.status_bayar,pembayaran.tipe_bayar,pembayaran.gambar_resi,penjualan.alamat_kirim,penjualan.tipe_ambil,penjualan.tipe_jual FROM penjualan JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan WHERE penjualan.kd_penjualan='$kdjual'");
                        $hasil = mysqli_fetch_assoc($query);

                        $query1  = mysqli_query($db, "SELECT penjualan.kd_penjualan,menu.nama_menu,det_penjualan.jumlah,det_penjualan.harga,SUM(det_penjualan.jumlah*det_penjualan.harga) AS sub FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan JOIN menu ON det_penjualan.kd_menu=menu.kd_menu WHERE det_penjualan.kd_penjualan='$kdjual' GROUP BY det_penjualan.kd_menu");
                        ?>

                        <table>

                            <tr>
                                <td>Nama Pelanggan</td>
                                <td>:</td>
                                <td><?php echo $hasil['nm_plg']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembelian</td>
                                <td>:</td>
                                <td><?php echo date("d-m-Y H:i", strtotime($hasil['tgl_jual'])); ?></td>
                            </tr>
                            <tr>
                                <td>Pembelian</td>
                                <td>:</td>
                                <td><?php echo $hasil['tipe_jual']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?php echo $hasil['status']; ?></td>
                            </tr>
                            <?php
                            if ($hasil['tipe_ambil'] == 'Dikirim') {
                            ?>
                                <tr>
                                    <td>Tanggal Kirim</td>
                                    <td>:</td>
                                    <td><?php if ($hasil['tgl_kirim'] == "") {
                                            echo "-";
                                        } else {
                                            echo date('d-m-Y H:i', strtotime($hasil['tgl_kirim']));
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Pengiriman</td>
                                    <td>:</td>
                                    <td><?php echo $hasil['alamat_kirim']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Status Bayar</td>
                                <td>:</td>
                                <td><?php echo $hasil['status_bayar']; ?></td>
                            </tr>
                            <?php
                            $cekbayar = mysqli_query($db, "SELECT SUM(menu.harga*det_penjualan.jumlah+penjualan.tarif) AS total_bayar FROM det_penjualan JOIN menu ON det_penjualan.kd_menu=menu.kd_menu JOIN penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan WHERE det_penjualan.kd_penjualan='$kdjual'");
                            $hasilcek = mysqli_fetch_assoc($cekbayar);
                            $hasildp = $hasilcek['total_bayar'] / 2;
                            if ($hasil['status_bayar'] == 'DP') {

                            ?>
                                <tr>
                                    <td>Kekurangan</td>
                                    <td>:</td>
                                    <td><?= rupiah($hasildp); ?></td>
                                </tr><?php } ?>
                            <?php if ($hasil['tipe_ambil'] == 'Di Toko') { ?>
                                <tr>
                                    <td>Status Pengambilan</td>
                                    <td>:</td>
                                    <td><?php echo $hasil['tipe_ambil']; ?></td>
                                </tr>
                            <?php } ?>
                        </table><br>

                        <table class="table table-striped table-bordered" style="text-align:bold">

                            <tr>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                            <?php


                            $hitung1 = mysqli_num_rows($query1);
                            if ($hitung1 > 0) {
                                while ($pecah1 = mysqli_fetch_assoc($query1)) {

                            ?>
                                    <tr>
                                        <td><?php echo $pecah1['nama_menu']; ?></td>
                                        <td><?php echo $pecah1['jumlah']; ?></td>
                                        <td><?php echo rupiah($pecah1['harga']); ?></td>
                                        <td><?php echo rupiah($pecah1['sub']); ?></td>
                                    </tr>
                            <?php }
                            } ?>
                            <?php
                            $qr3 = mysqli_query($db, "SELECT penjualan.kd_tarif,penjualan.tarif FROM penjualan WHERE kd_penjualan='$kdjual'");
                            $hasil3 = mysqli_fetch_assoc($qr3);
                            if (isset($hasil3['tarif'])) {

                            ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;"><b>Ongkir</b></td>
                                    <td><b><?php echo rupiah($hasil3['tarif']); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" style="text-align: center;"><b>Total</b></td>
                                <?php
                                $query2  = mysqli_query($db, "SELECT SUM(det_penjualan.jumlah*det_penjualan.harga)+penjualan.tarif AS total FROM det_penjualan JOIN penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan WHERE det_penjualan.kd_penjualan='$kdjual'");

                                $pecah2 = mysqli_fetch_assoc($query2);
                                ?>
                                <td><b><?php echo rupiah($pecah2['total']); ?></td>
                            </tr>



                        </table>

                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div>
</section> <br>


<!-- /.card -->

<div class="modal fade" id="detgambar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Resi Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div id="residet" style="width: 50%; margin-left: 26%;">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>