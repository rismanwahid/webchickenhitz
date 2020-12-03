<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=pengambilan">Data Pengambilan Bahan Baku</a></li>
        <li class="breadcrumb-item active">Detail Pengambilan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Detail Pengambilan Bahan Baku</b>
            <a href="admin.php?page=pengambilan" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordred">
                    <tbody>
                        <?php

                        $id = $_GET['kd_pengambilan'];
                        $query = mysqli_query($db, "SELECT pengambilan.*,karyawan.nm_karyawan FROM pengambilan JOIN karyawan ON pengambilan.id_karyawan=karyawan.id_karyawan WHERE pengambilan.kd_pengambilan='$id'");
                        $pecah = mysqli_fetch_assoc($query);
                        ?>
                        <tr>
                            <td>KD Pengambilan</td>
                            <td>-></td>
                            <td><?= $pecah['kd_pengambilan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengambilan</td>
                            <td>-></td>
                            <td><?= date('d-m-Y', strtotime($pecah['tgl_pengambilan'])); ?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>-></td>
                            <td><?= date('H:i', strtotime($pecah['tgl_pengambilan'])); ?></td>
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
                        <th>No</th>
                        <th>Nama Bahan Baku</th>
                        <th>Jumlah</th>
                    </thead>
                    <?php
                    $no1     = 1;
                    $query1  = mysqli_query($db, "SELECT pengambilan.kd_pengambilan,bahan_baku.nm_bk,det_pengambilan.jumlah FROM pengambilan JOIN det_pengambilan ON det_pengambilan.kd_pengambilan=pengambilan.kd_pengambilan JOIN bahan_baku ON det_pengambilan.kd_bk=bahan_baku.kd_bk WHERE pengambilan.kd_pengambilan='$id'");
                    $hitung1 = mysqli_num_rows($query1);
                    if ($hitung1 > 0) {
                        while ($pecah1 = mysqli_fetch_assoc($query1)) {
                    ?>
                            <tbody>
                                <td><?= $no1++; ?></td>
                                <td><?= $pecah1['nm_bk']; ?></td>
                                <td><?= $pecah1['jumlah']; ?></td>
                            </tbody>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>