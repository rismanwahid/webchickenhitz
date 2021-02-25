<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'batal') {
        $kd = $_GET['kd_penjualan'];
        mysqli_query($db, "UPDATE penjualan SET status='Dibatalkan' WHERE kd_penjualan = '$kd'");

        echo "<script>alert('Transaksi Berhasil Dibatalkan')</script>";
        echo "<script>window.location='admin.php?page=catering'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Catering</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Catering</b>
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
                            <th>Status Catering</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,pelanggan.nm_plg,SUM(det_penjualan.jumlah*det_penjualan.harga)AS total,pembayaran.tipe_bayar,pembayaran.status_bayar,penjualan.status,pembayaran.gambar_resi FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan WHERE penjualan.tipe_jual='Catering' GROUP BY det_penjualan.kd_penjualan  ORDER BY penjualan.tgl_jual DESC");
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
                                        <?php if ($pecah['status_bayar'] != 'Belum Melakukan Transfer' & $pecah['status_bayar'] != 'Lunas') {
                                            echo "<button data-toggle='modal' id='aksigambar' data-target='#gambarresi' data-gambar='$pecah[gambar_resi]' class='btn btn-primary btn-sm' ><i class='fa fa-eye'></i></button>&ensp;";
                                            echo "<button data-toggle='modal' id='statusbayarcat' data-target='#bayarcat' data-idcat='$pecah[kd_penjualan]' data-statuscat='$pecah[status_bayar]' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>";
                                        } else {
                                            echo "";
                                        } ?>
                                    </td>
                                    <td style="width:200px"><?= $pecah['status']; ?><br>
                                        <?php if ($pecah['status'] != 'Dibatalkan' & $pecah['status_bayar'] != 'Belum Melakukan Transfer' & $pecah['status'] != 'Telah Dikirim' & $pecah['status'] != 'Telah Diambil') { ?>
                                            <button data-toggle="modal" id="ubahscat" data-target="#statuscatering" data-idscatering="<?= $pecah['kd_penjualan']; ?>" data-statuscatt="<?= $pecah['status']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button><?php } ?>
                                    </td>


                                    <td style="width:150px">
                                        <?php if ($pecah['status'] == 'Dibatalkan') {
                                        ?>
                                            <span class="label label-danger"><?= $pecah['status']; ?></span><?php } else { ?>
                                            <a class="btn btn-success btn-sm " href="admin.php?page=det_catering&kd_penjualan=<?php echo $pecah['kd_penjualan']; ?>">Detail</a>
                                            <a onclick="return confirm('Anda yakin ingin membatalkan transaksi ini?')" class="btn btn-danger btn-sm" href="admin.php?page=catering&aksi=batal&kd_penjualan=<?php echo $pecah['kd_penjualan']; ?>">Batalkan</a><?php } ?>
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

<div class="modal fade" id="statuscatering">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Status Catering</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">

                            <!-- <label>KD Penjualan</label> -->
                            <input type="hidden" class="form-control" name="id_scattt" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="keterangancat" required>
                                <option name="keterangancat" value="Sedang Dikonfirmasi">Sedang Dikonfirmasi</option>
                                <option name="keterangancat" value="Pembuatan Menu">Pembuatan Menu</option>
                                <option name="keterangancat" value="Telah Dikirim">Telah Dikirim</option>
                                <option name="keterangancat" value="Telah Diambil">Telah Diambil</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpanstatus" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="bayarcat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Status Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">

                            <!-- <label>KD Penjualan</label> -->
                            <input type="hidden" class="form-control" name="id_catering" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="statusbayar" required>
                                <option name="statusbayar" value="Belum Melakukan Transfer">Belum Melakukan Transfer</option>
                                <option name="statusbayar" value="Telah Melakukan Transfer">Telah Melakukan Transfer</option>
                                <option name="statusbayar" value="DP">DP</option>
                                <option name="statusbayar" value="Lunas">Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpanbayarcat" class="btn btn-primary">Simpan</button>
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
if (isset($_POST['simpanbayarcat'])) {
    $id_catering  = $_POST['id_catering'];
    $statusbayar  = $_POST['statusbayar'];

    mysqli_query($db, "UPDATE pembayaran SET status_bayar='$statusbayar' WHERE pembayaran.kd_penjualan='$id_catering'");

    echo "<script>alert('Status Bayar:" . $statusbayar . " ')</script>";
    echo "<script>window.location='admin.php?page=catering'</script>";
}

if (isset($_POST['simpanstatus'])) {
    $id_scattt  = $_POST['id_scattt'];
    $keterangancat  = $_POST['keterangancat'];

    if ($keterangancat == 'Pembuatan Menu') {

        $dataPesanan = ambilData("SELECT resep.kd_resep,det_penjualan.jumlah FROM det_penjualan INNER JOIN resep USING(kd_menu) WHERE det_penjualan.kd_penjualan = '{$id_scattt}'");
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
                    mysqli_query($db, "UPDATE penjualan SET status='$keterangancat' WHERE kd_penjualan='$id_scattt'");
                }
            }
        }
    } else {
        mysqli_query($db, "UPDATE penjualan SET status='$keterangancat' WHERE kd_penjualan='$id_scattt'");
        echo "<script>alert('Status Pemesanan:" . $keterangancat . " ')</script>";
        echo "<script>window.location='admin.php?page=catering'</script>";
    }
}
?>