<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd = $_GET['kd_pengadaan'];
        mysqli_query($db, "DELETE FROM pengadaan WHERE kd_pengadaan = '$kd'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=pengadaan'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Pengadaan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Pengadaan Bahan Baku</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tampengadaan">Pengadaan Bahan Baku</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengadaan</th>
                            <th>Tanggal Pengadaan</th>
                            <th>Bahan Baku</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT pengadaan.*,pengadaan.jumlah*pengadaan.harga AS total, suplier.nm_suply,bahan_baku.nm_bk,karyawan.nm_karyawan FROM pengadaan JOIN suplier ON pengadaan.kd_suply=suplier.kd_suply JOIN bahan_baku ON pengadaan.kd_bk=bahan_baku.kd_bk JOIN karyawan ON pengadaan.id_karyawan=karyawan.id_karyawan");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_pengadaan']; ?></td>
                                    <td style="width: 200px;"><?= date('d-m-Y', strtotime($pecah['tgl_pengadaan'])); ?></td>
                                    <td style="width:200px"><?= $pecah['nm_bk']; ?></td>
                                    <td style="width:100px"><?= $pecah['jumlah'] . " " . $pecah['satuan']; ?></td>
                                    <td style="width:150px"><?= rupiah($pecah['total']); ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detpengadaan&kd_pengadaan=<?php echo $pecah['kd_pengadaan']; ?>">Detail</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=pengadaan&aksi=hapus&kd_pengadaan=<?php echo $pecah['kd_pengadaan']; ?>">Hapus</a>
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