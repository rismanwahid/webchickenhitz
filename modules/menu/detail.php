<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=karyawan">Beranda</a></li>
        <li class="breadcrumb-item active">Detail Data Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Detail Data Menu</b>
            <a href="admin.php?page=menu" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></a>
        </div>
        <div class="card-body">
            <?php
            $id = $_GET['kd_menu'];
            $query = mysqli_query($db, "SELECT menu.*,kategori.nm_ktgr FROM menu JOIN kategori ON menu.kd_ktgr=kategori.kd_ktgr WHERE menu.kd_menu='$id'");
            $pecah = mysqli_fetch_assoc($query);
            ?>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4 mt-5">
                        <img src="img/menu/<?= $pecah['gambar']; ?>" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pecah['nama_menu']; ?></h5>
                            <table class="table table-borderes" class="text-justify">
                                <tr>
                                    <td>
                                        <p class="card-text"><b>Kategori : </b><?= $pecah['nm_ktgr']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="card-text"><b>Dekskripsi : </b><?= $pecah['deskripsi']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="card-text"><b>Harga : </b><?= rupiah($pecah['harga']); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="card-text"><b>Status : </b><?= $pecah['status']; ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>