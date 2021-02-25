<?php
if (isset($_POST['simpan'])) {
    $kd_kelurahan  = $_POST['kd_kelurahan'];
    $kecamatan  = $_POST['kecamatan'];
    $nm_kelurahan   = $_POST['nm_kelurahan'];

    mysqli_query($db, "UPDATE kelurahan SET
    kd_kecamatan = '$kecamatan',nm_kelurahan = '$nm_kelurahan' WHERE kd_kelurahan='$kd_kelurahan'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=kelurahan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kelurahan">Data Kelurahan Pengiriman</a></li>
        <li class="breadcrumb-item active">Edit Kelurahan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Kelurahan Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <?php
                $kd_kelurahan = $_GET['kd_kelurahan'];
                $no     = 1;
                $query  = mysqli_query($db, "SELECT * FROM kelurahan WHERE kd_kelurahan='$kd_kelurahan'");
                $hitung = mysqli_num_rows($query);
                if ($hitung > 0) {
                    while ($pecah = mysqli_fetch_assoc($query)) {
                ?>
                        <div class="form-group">
                            <input type="hidden" name="kd_kelurahan" value="<?= $pecah['kd_kelurahan']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select name="kecamatan" class="form-control">
                                <option value="">--Pilih Kecamatan--</option>
                                <?php
                                $query1 = mysqli_query($db, "SELECT kecamatan.*,kabupaten.nm_kabupaten FROM kecamatan JOIN kabupaten ON kecamatan.kd_tarif=kabupaten.kd_tarif ORDER BY kabupaten.nm_kabupaten ASC");

                                while ($row = mysqli_fetch_array($query1)) {
                                    if ($pecah['kd_kecamatan'] == $row['kd_kecamatan']) {
                                        echo "<option value=$row[kd_kecamatan] selected>$row[nm_kecamatan] |  $row[nm_kabupaten]</option>";
                                    } else {
                                        echo "<option value=$row[kd_kecamatan]>$row[nm_kecamatan] |  $row[nm_kabupaten]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <?php
                            echo "<input type='text' name='nm_kelurahan' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control' value='$pecah[nm_kelurahan]'>";
                            ?>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kelurahan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>