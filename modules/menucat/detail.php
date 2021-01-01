<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=paketcat">Data Paket Catering</a></li>
        <li class="breadcrumb-item active">Detail Paket Catering</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Detail Paket Catering</b>
            <a href="admin.php?page=paketcat" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordred">
                    <tbody>
                        <?php

                        $id = $_GET['kd_paketcatering'];
                        $query = mysqli_query($db, "SELECT paket_catering.* FROM paket_catering WHERE kd_paketcatering='$id'");
                        $pecah = mysqli_fetch_assoc($query);
                        ?>
                        <tr>
                            <td>Paket Catering</td>
                            <td>-></td>
                            <td><?= $pecah['nm_paketcatering']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Gambar</th>
                    </thead>
                    <?php
                    $no1     = 1;
                    $query1  = mysqli_query($db, "SELECT det_paketcatering.kd_paketcatering,menu.nama_menu,menu.gambar FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE det_paketcatering.kd_paketcatering='$id'");
                    $hitung1 = mysqli_num_rows($query1);
                    if ($hitung1 > 0) {
                        while ($pecah1 = mysqli_fetch_assoc($query1)) {
                    ?>
                            <tbody>
                                <td><?= $no1++; ?></td>
                                <td><?= $pecah1['nama_menu']; ?></td>
                                <td><img src="img/menu/<?= $pecah1['gambar']; ?>" style="width: 100px;"> </td>
                            </tbody> <?php }
                                } ?>
                </table>
            </div>
        </div>
    </div>
</div>