<?php
if (isset($_POST['simpan'])) {
    $kd_tarif  = $_POST['kd_tarif'];
    $nm_wilayah   = $_POST['nm_wilayah'];
    $tarif   = $_POST['tarif'];

    mysqli_query($db, "UPDATE kabupaten SET
    nm_kabupaten = '$nm_wilayah',tarif = '$tarif' WHERE kd_tarif='$kd_tarif'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=datongkir'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=datongkir">Data Tarif Pengiriman</a></li>
        <li class="breadcrumb-item active">Edit Tarif Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Tarif Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <?php
                $kd_tarif = $_GET['kd_tarif'];
                $no     = 1;
                $query  = mysqli_query($db, "SELECT * FROM kabupaten WHERE kd_tarif='$kd_tarif'");
                $hitung = mysqli_num_rows($query);
                if ($hitung > 0) {
                    while ($pecah = mysqli_fetch_assoc($query)) {
                ?>
                        <div class="form-group">
                            <label>KD Tarif Pengiriman</label>
                            <input type="text" class="form-control" name="kd_tarif" value="<?= $pecah['kd_tarif']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Wilayah</label>
                            <?php
                            echo "<input type='text' name='nm_wilayah' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control' value='$pecah[nm_kabupaten]'>";
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Tarif</label>
                            <input type="number" class="form-control" min="0" name="tarif" value="<?= $pecah['tarif']; ?>" required>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=datongkir" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>