<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=pengambilan">Data Resep</a></li>
        <li class="breadcrumb-item active">Resep</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Resep</b>
            <a href="admin.php?page=resep" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordred">
                    <tbody>
                        <?php

                        $id = $_GET['kd_resep'];
                        $query = mysqli_query($db, "SELECT resep.*,det_resep.*, bahan_baku.nm_bk,menu.nama_menu FROM resep JOIN det_resep ON det_resep.kd_resep=resep.kd_resep JOIN menu ON resep.kd_menu=menu.kd_menu JOIN bahan_baku ON det_resep.kd_bk=bahan_baku.kd_bk WHERE resep.kd_resep='$id'");
                        $pecah = mysqli_fetch_assoc($query);
                        ?>
                        <tr>
                            <td>KD Resep</td>
                            <td>-></td>
                            <td><?= $pecah['kd_resep']; ?></td>
                        </tr>
                        <tr>
                            <td>Resep</td>
                            <td>-></td>
                            <td><?= $pecah['nama_menu']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>satuan</th>
                    </thead>
                    <?php
                    $no1     = 1;
                    $query1  = mysqli_query($db, "SELECT resep.*,det_resep.*, bahan_baku.nm_bk,menu.nama_menu FROM resep JOIN det_resep ON det_resep.kd_resep=resep.kd_resep JOIN menu ON resep.kd_menu=menu.kd_menu JOIN bahan_baku ON det_resep.kd_bk=bahan_baku.kd_bk WHERE resep.kd_resep='$id'");
                    $hitung1 = mysqli_num_rows($query1);
                    if ($hitung1 > 0) {
                        while ($pecah1 = mysqli_fetch_assoc($query1)) {
                    ?>
                            <tbody>
                                <td><?= $no1++; ?></td>
                                <td><?= $pecah1['nm_bk']; ?></td>
                                <td><?= $pecah1['takaran']; ?></td>
                                <td><?= $pecah1['satuan']; ?></td>
                            </tbody>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>