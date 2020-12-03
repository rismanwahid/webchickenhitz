<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=karyawan">Beranda</a></li>
        <li class="breadcrumb-item active">Detail Data Karyawan</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Detail Data Karyawan</b>
            <a href="admin.php?page=karyawan" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordred">
                    <tbody>
                        <?php
                        $id = $_GET['id_karyawan'];
                        $query = mysqli_query($db, "SELECT * FROM karyawan WHERE id_karyawan='$id'");
                        $pecah = mysqli_fetch_assoc($query);
                        ?>
                        <tr>
                            <td>ID Karyawan</td>
                            <td>-></td>
                            <td><?= $pecah['id_karyawan']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Karyawan</td>
                            <td>-></td>
                            <td><?= $pecah['nm_karyawan']; ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>-></td>
                            <td><?= $pecah['jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>-></td>
                            <td><?= $pecah['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>-></td>
                            <td><?= $pecah['jk']; ?></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>-></td>
                            <td><?= $pecah['no_hp']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>-></td>
                            <td><?= $pecah['alamat']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>