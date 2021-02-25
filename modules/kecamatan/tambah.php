<?php
if (isset($_POST['simpan'])) {

    $kabupaten   = $_POST['kabupaten'];
    $nm_kecamatan   = $_POST['nm_kecamatan'];

    mysqli_query($db, "INSERT INTO kecamatan(kd_tarif,nm_kecamatan) VALUES ('$kabupaten','$nm_kecamatan')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=kecamatan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kecamatan">Data Kecamatan Pengiriman</a></li>
        <li class="breadcrumb-item active">Tambah Kecamatan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Kecamatan Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kabupaten" class="form-control" required>
                        <option value="">--Pilih Kabupaten--</option>
                        <?php
                        $qr = mysqli_query($db, "SELECT * FROM kabupaten");
                        $hitung = mysqli_num_rows($qr);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($qr)) {
                        ?>
                                <option value="<?php echo $pecah['kd_tarif']; ?>"><?php echo $pecah['nm_kabupaten']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <?php
                    echo "<input type='text' name='nm_kecamatan' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control'>";
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kecamatan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>