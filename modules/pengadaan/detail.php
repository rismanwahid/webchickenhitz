<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=pengadaan">Data Pengadaan Bahan Baku</a></li>
        <li class="breadcrumb-item active">Detail Pengadaan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Detail Pengadaan Bahan Baku</b>
            <a href="admin.php?page=pengadaan" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordred">
                    <tbody>
                        <?php
                        $id = $_GET['kd_pengadaan'];
                        $query = mysqli_query($db, "SELECT pengadaan.*,pengadaan.jumlah*pengadaan.harga AS total, suplier.nm_suply,bahan_baku.nm_bk,karyawan.nm_karyawan FROM pengadaan JOIN suplier ON pengadaan.kd_suply=suplier.kd_suply JOIN bahan_baku ON pengadaan.kd_bk=bahan_baku.kd_bk JOIN karyawan ON pengadaan.id_karyawan=karyawan.id_karyawan WHERE kd_pengadaan='$id'");
                        $pecah = mysqli_fetch_assoc($query);
                        ?>
                        <tr>
                            <td>KD Pengadaan</td>
                            <td>-></td>
                            <td><?= $pecah['kd_pengadaan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengadaan</td>
                            <td>-></td>
                            <td><?= $pecah['tgl_pengadaan']; ?></td>
                        </tr>
                        <tr>
                            <td>Suplier</td>
                            <td>-></td>
                            <td><?= $pecah['nm_suply']; ?></td>
                        </tr>
                        <tr>
                            <td>Karyawan</td>
                            <td>-></td>
                            <td><?= $pecah['nm_karyawan']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table bordered">
                    <thead>
                        <th>Nama Bahan Baku</td>
                        <th>Jumlah</td>
                        <th>Harga</td>
                        <th>Total</td>
                    </thead>
                    <tbody>
                        <td><?= $pecah['nm_bk']; ?></td>
                        <td><?= $pecah['jumlah'] . " " . $pecah['satuan']; ?></td>
                        <td><?= rupiah($pecah['harga'])
                                . " / " . $pecah['satuan'];  ?></td>
                        <td><?= rupiah($pecah['total']); ?></td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>