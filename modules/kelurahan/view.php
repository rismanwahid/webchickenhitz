<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_kelurahan = $_GET['kd_kelurahan'];
        mysqli_query($db, "DELETE FROM kelurahan WHERE kd_kelurahan = '$kd_kelurahan'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=kelurahan'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Kelurahan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Kelurahan Pengiriman</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamkelurahan">Tambah Kelurahan Pengiriman</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT kelurahan.*,kecamatan.nm_kecamatan FROM kelurahan JOIN kecamatan ON kecamatan.kd_kecamatan=kelurahan.kd_kecamatan");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 50px;"><?= $no++ ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_kelurahan']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_kecamatan']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editkelurahan&kd_kelurahan=<?php echo $pecah['kd_kelurahan']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=kelurahan&aksi=hapus&kd_kelurahan=<?php echo $pecah['kd_kelurahan']; ?>">Hapus</a>
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