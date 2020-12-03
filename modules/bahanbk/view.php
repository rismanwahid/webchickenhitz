<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_bk = $_GET['kd_bk'];
        mysqli_query($db, "DELETE FROM bahan_baku WHERE kd_bk = '$kd_bk'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=bahanbku'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Bahan Baku</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamb_baku">Tambah Bahan Baku</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Bahan Baku</th>
                            <th>Suplier</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM bahan_baku");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['nm_bk']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['kd_suply']; ?></td>
                                    <td style="width:150px"><?= $pecah['stok']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=edit_baku&kd_bk=<?php echo $pecah['kd_bk']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=bahanbku&aksi=hapus&kd_bk=<?php echo $pecah['kd_bk']; ?>">Hapus</a>
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