<?php
if (isset($_POST['simpan'])) {
    $kd_kecamatan  = $_POST['kd_kecamatan'];
    $kabupaten  = $_POST['kabupaten'];
    $nm_kecamatan   = $_POST['nm_kecamatan'];

    mysqli_query($db, "UPDATE kecamatan SET
    kd_tarif = '$kabupaten',nm_kecamatan = '$nm_kecamatan' WHERE kd_kecamatan='$kd_kecamatan'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=kecamatan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kecamatan">Data Kecamatan Pengiriman</a></li>
        <li class="breadcrumb-item active">Edit Kecamatan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Kecamatan Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <?php
                $kd_kecamatan = $_GET['kd_kecamatan'];
                $no     = 1;
                $query  = mysqli_query($db, "SELECT * FROM kecamatan WHERE kd_kecamatan='$kd_kecamatan'");
                $hitung = mysqli_num_rows($query);
                if ($hitung > 0) {
                    while ($pecah = mysqli_fetch_assoc($query)) {
                ?>
                        <div class="form-group">
                            <input type="hidden" name="kd_kecamatan" value="<?= $pecah['kd_kecamatan']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <select name="kabupaten" class="form-control">
                                <option value="">--Pilih Kabupaten--</option>
                                <?php
                                $query1 = mysqli_query($db, "SELECT * FROM kabupaten");

                                while ($row = mysqli_fetch_array($query1)) {
                                    if ($pecah['kd_tarif'] == $row['kd_tarif']) {
                                        echo "<option value=$row[kd_tarif] selected>$row[nm_kabupaten]</option>";
                                    } else {
                                        echo "<option value=$row[kd_tarif]>$row[nm_kabupaten]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Kecamatan</label>
                            <?php
                            echo "<input type='text' name='nm_kecamatan' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control' value='$pecah[nm_kecamatan]'>";
                            ?>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kecamatan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>