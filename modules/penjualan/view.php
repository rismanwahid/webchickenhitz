<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'batal') {
        $kd = $_GET['kd_penjualan'];
        mysqli_query($db, "UPDATE penjualan SET status='Dibatalkan' WHERE kd_penjualan = '$kd'");

        echo "<script>alert('Transaksi Berhasil Dibatalkan')</script>";
        echo "<script>window.location='admin.php?page=penjualan'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Penjualan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Penjualan</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Status Penjualan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,pelanggan.nm_plg,SUM(det_penjualan.jumlah*det_penjualan.harga)AS total,pembayaran.tipe_bayar,pembayaran.status_bayar,penjualan.status,pembayaran.gambar_resi FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan JOIN pelanggan  ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan WHERE penjualan.tipe_jual='Biasa' GROUP BY det_penjualan.kd_penjualan ORDER BY penjualan.tgl_jual DESC");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td style="width: 150px;"><?= date('d-m-Y H:i', strtotime($pecah['tgl_jual'])); ?></td>
                                    <td style="width:200px"><?= $pecah['nm_plg']; ?></td>
                                    <td style="width:100px"><?= rupiah($pecah['total']); ?></td>
                                    <td style="width:200px"><?= $pecah['status_bayar']; ?><br>
                                        <?php if ($pecah['status_bayar'] == 'Telah Melakukan Transfer') {
                                            echo "<button data-toggle='modal' id='aksigambar' data-target='#gambarresi' data-gambar='$pecah[gambar_resi]' class='btn btn-primary btn-sm' ><i class='fa fa-eye'></i></button>";
                                        } else {
                                            echo "";
                                        } ?>
                                    </td>
                                    <td style="width:200px"><?= $pecah['status']; ?><br>
                                        <?php if ($pecah['status'] != 'Dibatalkan') { ?>
                                            <button data-toggle="modal" id="ubahsjual" data-target="#statusjual" data-idstatus="<?= $pecah['kd_penjualan']; ?>" data-statusjual="<?= $pecah['status']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button><?php } ?>
                                    </td>


                                    <td style="width:150px">
                                        <?php if ($pecah['status'] == 'Dibatalkan') {
                                        ?>
                                            <span class="label label-danger"><?= $pecah['status']; ?></span><?php } else { ?>
                                            <a class="btn btn-success btn-sm " href="admin.php?page=det_jual&kd_penjualan=<?php echo $pecah['kd_penjualan']; ?>">Detail</a>
                                            <a onclick="return confirm('Anda yakin ingin membatalkan transaksi ini?')" class="btn btn-danger btn-sm" href="admin.php?page=penjualan&aksi=batal&kd_penjualan=<?php echo $pecah['kd_penjualan']; ?>">Batalkan</a><?php } ?>
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

<div class="modal fade" id="statusjual">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Status Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">

                            <!-- <label>KD Penjualan</label> -->
                            <input type="hidden" class="form-control" name="id_statusjual" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="keterangan" required>
                                <option name="keterangan" value="Sedang Dikonfirmasi">Sedang Dikonfirmasi</option>
                                <option name="keterangan" value="Pembuatan Menu">Pembuatan Menu</option>
                                <option name="keterangan" value="Dikirim">Dikirim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="gambarresi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Gambar Resi Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div id="vresi" style="width: 50%; margin-left: 26%;">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

function ambilData($query)
{
    global $db;
    $data = [];
    $d = mysqli_query($db, $query);
    while ($temp = mysqli_fetch_assoc($d)) {
        $data[] = $temp;
    }

    return $data;
}


if (isset($_POST['simpan'])) {
    $id_statusjual  = $_POST['id_statusjual'];
    $keterangan  = $_POST['keterangan'];
    $tgl_kirim = date('Y-m-d H:i:s');



    if ($keterangan == 'Dikirim') {
        mysqli_query($db, "UPDATE penjualan SET tgl_kirim='$tgl_kirim', status='$keterangan'  WHERE kd_penjualan='$id_statusjual'");
    } elseif ($keterangan == 'Pembuatan Menu') {

        $dataPesanan = ambilData("SELECT resep.kd_resep,det_penjualan.jumlah FROM det_penjualan INNER JOIN resep USING(kd_menu) WHERE det_penjualan.kd_penjualan = '{$id_statusjual}'");
        $temp = [];

        foreach ($dataPesanan as $d) {
            $query = "SELECT kd_bk, takaran * {$d['jumlah']} AS jumlahtakaran,menu.nama_menu,det_resep.satuan FROM det_resep INNER JOIN resep USING(kd_resep) INNER JOIN menu USING(kd_menu) WHERE det_resep.kd_resep = '{$d['kd_resep']}'";

            $bahan = ambilData($query);
            $temp[] = $bahan;
        }

        $totalBahan = [];
        foreach ($temp as $s) {
            foreach ($s as $key => $val) {

                if (array_key_exists($val['kd_bk'], $totalBahan)) {
                    if ($val['satuan'] == "Potong") {
                        echo "potong";
                        $totalBahan[$val['nama_menu']][$val['kd_bk']] = $val['jumlahtakaran'] + $totalBahan[$val['nama_menu']][$val['kd_bk']];
                    } else {
                        $totalBahan[$val['nama_menu']][$val['kd_bk']] = ($val['jumlahtakaran'] / 1000) + $totalBahan[$val['nama_menu']][$val['kd_bk']];
                    }
                } else {
                    if ($val['satuan'] == "Potong") {
                        $totalBahan[$val['nama_menu']][$val['kd_bk']] = (int) $val['jumlahtakaran'];
                    } else {
                        $totalBahan[$val['nama_menu']][$val['kd_bk']] = $val['jumlahtakaran'] / 1000;
                    }
                }
            }
        }



        $daftarBahanKurang = [];
        foreach ($totalBahan as $key => $val) {

            foreach ($val as $kd_bk => $jumlah) {
                // cek kedatabase jika barang kurang maka tampilkan alert
                $stokBahanBaku = ambilData("SELECT stok,nm_bk FROM bahan_baku WHERE kd_bk = '{$kd_bk}'")[0];
                if ($stokBahanBaku['stok'] < $jumlah) {
                    // var_dump($jumlah);
                    // $kurang = $stokBahanBaku['stok'] - $jumlah;

                    $daftarBahanKurang[$key][] = $stokBahanBaku['nm_bk'];
                }
            }
        }




        if (count($daftarBahanKurang)) {
            $alert = "Bahan Baku Untuk Pembuatan Menu Tidak Cukup 
daftar : ";


            // daftar :
            // Ayam Goreng
            // - Tepung
            // - Ayam
            // Boba
            // -Tepung
            foreach ($daftarBahanKurang as $key => $val) {
                $alert .= "
{$key}";
                foreach ($val as $d) {
                    $alert .= "
- {$d}";
                }
            }

            echo '<script>
            alert(`' . $alert . '`);
            documen.location.href = "admin.php?page=catering"
            </script>';
        } else {

            foreach ($temp as $t) {
                foreach ($t as $k) {
                    // merubah gram menjadi kilogram
                    if ($k['satuan'] == "Potong") {
                        $kg = $k['jumlahtakaran'];
                    } else {

                        $kg = $k['jumlahtakaran'] / 1000;
                    }
                    $query = "UPDATE bahan_baku SET stok = stok - {$kg} WHERE kd_bk = '{$k['kd_bk']}'";
                    mysqli_query($db, $query);
                    mysqli_query($db, "UPDATE penjualan SET status='$keterangan' WHERE kd_penjualan='$id_statusjual'");
                }
            }
        }
    } else {
        mysqli_query($db, "UPDATE penjualan SET status='$keterangan' WHERE kd_penjualan='$id_statusjual'");
    }



    echo "<script>alert('Status:" . $keterangan . " ')</script>";
    echo "<script>window.location='admin.php?page=penjualan'</script>";
}
?>