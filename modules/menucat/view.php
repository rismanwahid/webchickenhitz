<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd = $_GET['kd_paketcatering'];
        mysqli_query($db, "DELETE FROM paket_catering WHERE kd_paketcatering = '$kd'");
        mysqli_query($db, "DELETE FROM det_paketcatering WHERE kd_paketcatering = '$kd'");
        mysqli_query($db, "DELETE FROM tmpdet_paketcatering WHERE kd_paketcatering = '$kd'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=paketcat'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Paket Catering</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Paket Catering</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tampaketcat">Tambah Paket Catering</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>KD Paket</th>
                            <th>Nama Paket</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM paket_catering");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_paketcatering']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_paketcatering']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['status']; ?></td>
                                    <td style="width:200px">
                                        <a class="btn btn-primary btn-sm " href="admin.php?page=editpaketcat&kd_paketcatering=<?php echo $pecah['kd_paketcatering']; ?>">Edit</a>
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detpaketcat&kd_paketcatering=<?php echo $pecah['kd_paketcatering']; ?>">Detail</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=paketcat&aksi=hapus&kd_paketcatering=<?php echo $pecah['kd_paketcatering']; ?>">Hapus</a>
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