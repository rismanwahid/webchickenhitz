<?php
if (isset($_POST['simpan'])) {

    $kecamatan   = $_POST['kecamatan'];
    $nm_kelurahan   = $_POST['nm_kelurahan'];

    mysqli_query($db, "INSERT INTO kelurahan(kd_kecamatan,nm_kelurahan) VALUES ('$kecamatan','$nm_kelurahan')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=kelurahan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=kelurahan">Data Kelurahan Pengiriman</a></li>
        <li class="breadcrumb-item active">Tambah Kelurahan Pengiriman</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Kelurahan Pengiriman</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="kecamatan" class="form-control" required>
                        <option value="">--Pilih Kecamatan--</option>
                        <?php
                        $qr = mysqli_query($db, "SELECT kecamatan.*,kabupaten.nm_kabupaten FROM kecamatan JOIN kabupaten ON kecamatan.kd_tarif=kabupaten.kd_tarif ORDER BY kabupaten.nm_kabupaten ASC");
                        $hitung = mysqli_num_rows($qr);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($qr)) {
                        ?>
                                <option value="<?php echo $pecah['kd_kecamatan']; ?>"><?php echo $pecah['nm_kecamatan'] . " | " . $pecah['nm_kabupaten']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelurahan</label>
                    <?php
                    echo "<input type='text' name='nm_kelurahan' size='149' onkeypress='return event.charCode < 48 || event.charCode  >57' class='form-control'>";
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=kelurahan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>