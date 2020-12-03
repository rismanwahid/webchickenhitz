<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_suplier = $_GET['kd_suplier'];
        mysqli_query($db, "DELETE FROM suplier WHERE kd_suply = '$kd_suplier'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=suplier'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Suplier</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Suplier</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamsuplier">Tambah Suplier</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Suplier</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM suplier");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['nm_suply']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['email']; ?></td>
                                    <td style="width:200px"><?= $pecah['no_hp']; ?></td>
                                    <td style="width:420px"><?= $pecah['alamat']; ?></td>
                                    <td style="width:150px">
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editsuplier&kd_suply=<?php echo $pecah['kd_suply']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=suplier&aksi=hapus&kd_suplier=<?php echo $pecah['kd_suply']; ?>">Hapus</a>
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