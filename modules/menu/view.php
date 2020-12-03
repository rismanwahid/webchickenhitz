<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd = $_GET['kd_menu'];
        $pilih = mysqli_query($db, "SELECT * FROM menu WHERE kd_menu='$kd'");
        $data = mysqli_fetch_array($pilih);
        $foto = $data['gambar'];
        unlink('img/menu/' . $foto);
        mysqli_query($db, "DELETE FROM menu WHERE kd_menu = '$kd'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='admin.php?page=menu'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Menu</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tammenu">Tambah Menu</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT menu.*,kategori.nm_ktgr FROM menu JOIN kategori ON menu.kd_ktgr=kategori.kd_ktgr");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 200px;"><?= $pecah['nm_ktgr']; ?></td>
                                    <td style="width: 200px;"><?= $pecah['nama_menu']; ?></td>
                                    <td style="width: 150px;"><?= rupiah($pecah['harga']); ?></td>
                                    <td style="width: 200px;"><?= $pecah['status']; ?></td>
                                    <td style="width:200px">
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detmenu&kd_menu=<?php echo $pecah['kd_menu']; ?>">Detail</a>
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editmenu&kd_menu=<?php echo $pecah['kd_menu']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=menu&aksi=hapus&kd_menu=<?php echo $pecah['kd_menu']; ?>">Hapus</a>
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