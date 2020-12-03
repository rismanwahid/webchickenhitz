<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_plg = $_GET['id_pelanggan'];
        mysqli_query($db, "DELETE FROM pelanggan WHERE id_pelanggan = '$id_plg'");
        mysqli_query($db, "DELETE FROM users WHERE id_users = '$id_plg'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=datplg'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Pelanggan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Pelanggan</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM pelanggan");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 300px;"><?= $pecah['nm_plg']; ?></td>
                                    <td style="width: 250px;"><?= $pecah['jk']; ?></td>
                                    <td style="width:300px"><?= $pecah['alamat']; ?></td>
                                    <td style="width: 250px;"><?= $pecah['no_hp']; ?></td>
                                    <td style="width:200px">
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=datplg&aksi=hapus&id_pelanggan=<?php echo $pecah['id_pelanggan']; ?>">Hapus</a>
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