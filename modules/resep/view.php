<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id = $_GET['kd_resep'];
        mysqli_query($db, "DELETE FROM resep WHERE kd_resep = '$id'");
        mysqli_query($db, "DELETE FROM det_resep WHERE kd_resep = '$id'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=resep'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Resep</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Resep</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamresep">Tambah Resep</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>KD Resep</th>
                            <th>Resep Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT resep.*, menu.nama_menu FROM resep JOIN menu ON resep.kd_menu=menu.kd_menu");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_resep']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nama_menu']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detresep&kd_resep=<?php echo $pecah['kd_resep']; ?>">Lihat Resep</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=resep&aksi=hapus&kd_resep=<?php echo $pecah['kd_resep']; ?>">Hapus</a>
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