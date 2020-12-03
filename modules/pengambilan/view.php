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
        <li class="breadcrumb-item active">Data Pengambilan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Pengambilan Bahan Baku</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tampengambilan">Pengambilan Bahan Baku</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>KD Pengambilan</th>
                            <th>Tanggal Pengambilan</th>
                            <th>Karyawan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT pengambilan.*,karyawan.nm_karyawan FROM pengambilan JOIN karyawan ON pengambilan.id_karyawan=karyawan.id_karyawan");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_pengambilan']; ?></td>
                                    <td style="width: 200px;"><?= date('d-m-Y', strtotime($pecah['tgl_pengambilan'])); ?></td>
                                    <td style="width:200px"><?= $pecah['nm_karyawan']; ?></td>
                                    <td style="width:200px">
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detpengambilan&kd_pengambilan=<?php echo $pecah['kd_pengambilan']; ?>">Detail</a>
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