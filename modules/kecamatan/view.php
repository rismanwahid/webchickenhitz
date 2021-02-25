<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_kecamatan = $_GET['kd_kecamatan'];
        mysqli_query($db, "DELETE FROM kecamatan WHERE kd_kecamatan = '$kd_kecamatan'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=kecamatan'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Kecamatan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Kecamatan Pengiriman</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamkecamatan">Tambah Kecamatan Pengiriman</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT kecamatan.*,kabupaten.nm_kabupaten FROM kecamatan JOIN kabupaten ON kecamatan.kd_tarif=kabupaten.kd_tarif");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 50px;"><?= $no++ ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_kecamatan']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_kabupaten']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editkecamatan&kd_kecamatan=<?php echo $pecah['kd_kecamatan']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=kecamatan&aksi=hapus&kd_kecamatan=<?php echo $pecah['kd_kecamatan']; ?>">Hapus</a>
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