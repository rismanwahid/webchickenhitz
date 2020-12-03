<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_ktgr = $_GET['kd_ktgr'];
        mysqli_query($db, "DELETE FROM kategori WHERE kd_ktgr = '$kd_ktgr'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=kategori'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Kategori</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Kategori</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamktgr">Tambah Kategori</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>KD Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM kategori");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['kd_ktgr']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nm_ktgr']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editktgr&kd_ktgr=<?php echo $pecah['kd_ktgr']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=kategori&aksi=hapus&kd_ktgr=<?php echo $pecah['kd_ktgr']; ?>">Hapus</a>
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