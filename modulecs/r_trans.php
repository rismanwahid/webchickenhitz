<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tipe Pemesanan</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Status Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no     = 1;
                            $idplg = $_SESSION['id_plg'];
                            $query  = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,pelanggan.nm_plg,SUM(det_penjualan.jumlah*det_penjualan.harga)AS total,pembayaran.tipe_bayar,pembayaran.status_bayar,penjualan.status,penjualan.tipe_jual FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan JOIN pelanggan  ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan WHERE penjualan.id_pelanggan='$idplg' GROUP BY det_penjualan.kd_penjualan ORDER BY penjualan.tgl_jual DESC");
                            $hitung = mysqli_num_rows($query);
                            if ($hitung > 0) {
                                while ($pecah = mysqli_fetch_assoc($query)) {
                            ?>
                                    <tr>
                                        <td style="width: 10px;"><?= $no++; ?></td>
                                        <td style="width: 150px;"><?= date('d-m-Y H:i', strtotime($pecah['tgl_jual'])); ?></td>
                                        <td style="width: 150px;"><?= $pecah['tipe_jual']; ?></td>
                                        <td style="width:150px"><?= rupiah($pecah['total']); ?></td>
                                        <td style="width:250px"><?= $pecah['status_bayar']; ?></td>
                                        <td style="width:200px"><?= $pecah['status']; ?></td>
                                        <td style="width:150px">
                                            <a href="index.php?page=det_trans&kd_penjualan=<?php echo $pecah['kd_penjualan']; ?>" class="btn" style="color: aliceblue;">Detail</a>
                                            <?php if ($pecah['status_bayar'] != 'Telah Melakukan Transfer' & $pecah['tipe_jual'] == 'Biasa' & $pecah['tipe_bayar'] == 'Transfer') {
                                                echo "<a class='btn' href='index.php?page=upload_resi&kd_jual=$pecah[kd_penjualan]'><span style='color: aliceblue;'>Upload Resi</span></a>";
                                            } elseif ($pecah['status_bayar'] != 'Lunas' & $pecah['tipe_jual'] == 'Catering') {
                                                echo "<a class='btn' href='index.php?page=upload_resi&kd_jual=$pecah[kd_penjualan]'><span style='color: aliceblue;'>Upload Resi</span></a>";
                                            } ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->

<!-- Modal -->
<div class="modal fade" id="upload_resi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Upload Bukti Resi Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <form class="form-horizontal loginFrm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <input type="file" class="form-control" name="gmbr_resi" required>
                        </div>

                        <div class="control-group">
                            <input id="id_sewa" type="hidden" class="form-control" name="id_sewa" required>
                        </div>
                        <br>
                        <button type="submit" name="upload_resi" class="btn btn-success">Upload Resi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->