<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_karyawan = $_GET['id_karyawan'];
        mysqli_query($db, "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=karyawan'</script>";
    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=home">Beranda</a></li>
        <li class="breadcrumb-item active">Data Karyawan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <b>Data Karyawan</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary btn-md " href="admin.php?page=tamkaryawan">Tambah Karyawan</a><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no     = 1;
                        $query  = mysqli_query($db, "SELECT * FROM karyawan");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td style="width: 300px;"><?= $pecah['nm_karyawan']; ?></td>
                                    <td style="width: 250px;"><?= $pecah['jabatan']; ?></td>
                                    <td style="width:200px"><?= $pecah['no_hp']; ?></td>
                                    <td style="width:200px">
                                        <a class="btn btn-success btn-sm " href="admin.php?page=detkar&id_karyawan=<?php echo $pecah['id_karyawan']; ?>">Detail</a>
                                        <a class="btn btn-info btn-sm " href="admin.php?page=editkar&id_karyawan=<?php echo $pecah['id_karyawan']; ?>">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="admin.php?page=karyawan&aksi=hapus&id_karyawan=<?php echo $pecah['id_karyawan']; ?>">Hapus</a>
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