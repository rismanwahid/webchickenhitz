<?php
if (isset($_POST['simpan'])) {
    $kd_resep  = $_POST['kd_resep'];
    $menu   = $_POST['menu'];

    mysqli_query($db, "INSERT INTO resep(kd_resep,kd_menu) VALUES ('$kd_resep','$menu')");

    mysqli_query($db, "INSERT INTO det_resep(kd_resep,kd_bk,takaran,satuan) SELECT kd_resep,kd_bk,takaran,satuan FROM tmpdet_resep WHERE kd_resep='$kd_resep'");

    echo "<script>alert('Resep Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=resep'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=resep">Data Resep</a></li>
        <li class="breadcrumb-item active">Tambah Resep</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Resep</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Resep</label>
                    <?php

                    $sql1  = "SELECT max(kd_resep) AS terakhirpas FROM resep";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 4, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "RSP-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_resep" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Menu</label>
                    <select name="menu" class="form-control">
                        <option value="">--Pilih Menu--</option>
                        <?php
                        $query  = mysqli_query($db, "SELECT menu.kd_menu,menu.nama_menu FROM menu ORDER BY nama_menu ASC");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                                echo "<option value='$pecah[kd_menu]'>$pecah[nama_menu]</option>";
                            }
                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label>Bahan Baku</label>
                    <select name="bk" class="form-control">
                        <option value="">--Pilih Bahan Baku--</option>
                        <?php
                        $query1  = mysqli_query($db, "SELECT bahan_baku.kd_bk,bahan_baku.nm_bk FROM bahan_baku ORDER BY nm_bk ASC");
                        $hitung1 = mysqli_num_rows($query1);
                        if ($hitung1 > 0) {
                            while ($pecah1 = mysqli_fetch_assoc($query1)) {
                                echo "<option value='$pecah1[kd_bk]'>$pecah1[nm_bk]</option>";
                            }
                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label>Takaran</label>
                    <input type="number" name="takaran" class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control">
                </div>
                <input type="button" class="btn btn-primary" value="Tambah" onclick="insertresep()"><br><br>
                <p id="coment"></p>
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Bahan Baku</th>
                        <th>Takaran</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody id="data"></tbody>

                </table>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=resep" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>