<?php
if (isset($_POST['simpan'])) {
    $kd_pengambilan  = $_POST['kd_pengambilan'];
    $jam = date('H:i:s');
    $tgl_pengambilan   = $_POST['tgl_pengambilan'] . " " . $jam;
    $karyawan = $_POST['karyawan'];

    mysqli_query($db, "INSERT INTO pengambilan(kd_pengambilan,tgl_pengambilan,id_karyawan) VALUES ('$kd_pengambilan','$tgl_pengambilan','$karyawan')");

    mysqli_query($db, "INSERT INTO det_pengambilan(kd_pengambilan,kd_bk,jumlah) SELECT kd_pengambilan,kd_bk,jumlah FROM tmp_detpengambilan WHERE kd_pengambilan='$kd_pengambilan'");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=pengambilan'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=pengambilan">Data Pengambilan Bahan Baku</a></li>
        <li class="breadcrumb-item active">Pengambilan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Pengambilan Bahan Baku</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Pengambilan</label>
                    <?php

                    $sql1  = "SELECT max(kd_pengambilan) AS terakhirpas FROM pengambilan";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 6, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "AMBIL-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_pengambilan" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <!-- <label>Nama karyawan</label> -->
                    <input type="hidden" class="form-control" name="karyawan" value="<?= $_SESSION['id_karyawan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal Pengambilan</label>
                    <input type="date" class="form-control" name="tgl_pengambilan" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label>Bahan Baku</label>
                    <select name="bk" class="form-control">
                        <option value="">Pilih Bahan Baku</option>
                        <?php
                        $qr = mysqli_query($db, "SELECT bahan_baku.kd_bk,bahan_baku.nm_bk FROM bahan_baku");
                        $hitung = mysqli_num_rows($qr);
                        if ($hitung > 0) {
                            while ($ouput = mysqli_fetch_assoc($qr)) {
                        ?>
                                <option value="<?php echo $ouput['kd_bk']; ?>"><?php echo $ouput['nm_bk']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" min="0" class="form-control">
                </div>
                <input type="button" class="btn btn-primary" value="Ambil" onclick="insertdata()"><br><br>
                <p id="coment"></p>

                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody id="data"></tbody>

                </table>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=pengambilan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>