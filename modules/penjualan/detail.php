<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb mt-4">
                    <li class="breadcrumb-item"><a href="admin.php?page=penjualan">Data Penjualan</a></li>
                    <li class="breadcrumb-item active">Detail Penjualan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                    <div class="card-header">
                        <b>Detail Penjualan</b>
                        <a href="admin.php?page=penjualan" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <?php
                        $kdjual = $_GET['kd_penjualan'];

                        $query = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,pelanggan.nm_plg,penjualan.status,penjualan.tgl_kirim,pembayaran.status_bayar,pembayaran.tipe_bayar,pembayaran.gambar_resi,penjualan.alamat_kirim FROM penjualan JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan WHERE penjualan.kd_penjualan='$kdjual'");
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
                                <td>Status</td>
                                <td>:</td>
                                <td><?php echo $hasil['status']; ?></td>
                            </tr>
                            <?php
                            if ($hasil['status'] == 'Dikirim') {
                            ?>
                                <tr>
                                    <td>Tanggal Kirim</td>
                                    <td>:</td>
                                    <td><?php echo date('d-m-Y H:i', strtotime($hasil['tgl_kirim'])) ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Tipe Bayar</td>
                                <td>:</td>
                                <td><?php echo $hasil['tipe_bayar']; ?></td>
                            </tr>
                            <tr>
                                <td>Status Bayar</td>
                                <td>:</td>
                                <td><?php echo $hasil['status_bayar']; ?></td>
                            </tr>
                            <?php if ($hasil['status_bayar'] == 'Telah Melakukan Transfer') { ?>
                                <tr>
                                    <td>Gambar Resi</td>
                                    <td>:</td>
                                    <td><button id="aksigambardet" data-toggle="modal" data-target="#detgambar" data-gambardet="<?php echo $hasil['gambar_resi']; ?>"> <img src="img/resi_pembayaran/<?php echo $hasil['gambar_resi']; ?>" style="width:70px;"> </button></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Alamat Pengiriman</td>
                                <td>:</td>
                                <td><?php echo $hasil['alamat_kirim']; ?></td>
                            </tr>
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
</section>
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