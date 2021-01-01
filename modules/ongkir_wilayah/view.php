<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_tarif = $_GET['kd_tarif'];
        mysqli_query($db, "DELETE FROM kabupaten WHERE kd_tarif = '$kd_tarif'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=datongkir'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Tarif Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Tarif Pengiriman</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamongkir">Tambah Tarif Pengiriman</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>KD Tarif</th>
                            <th>Nama Wilayah</th>
                            <th>Tarif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM kabupaten");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_tarif']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_kabupaten']; ?></td>
                                    <td style="width: 200px;"><?= rupiah($pecah['tarif']); ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editongkir&kd_tarif=<?php echo $pecah['kd_tarif']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=datongkir&aksi=hapus&kd_tarif=<?php echo $pecah['kd_tarif']; ?>">Hapus</a>
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