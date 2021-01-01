<?php
if (isset($_POST['simpan'])) {
    $kd_pengadaan  = $_POST['kd_pengadaan'];
    $tgl_pengadaan   = $_POST['tgl_pengadaan'];
    $suplier   = $_POST['suplier'];
    $bahanbk = $_POST['bahanbk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $karyawan = $_POST['karyawan'];
    $kd_bk = $_POST['kd_bk'];
    $nw_bhnbk = $_POST['nw_bhnbk'];
    $satuan = $_POST['satuan'];

    if ($bahanbk == 'Tambah Bahan Baku') {
        mysqli_query($db, "INSERT INTO pengadaan(kd_pengadaan,tgl_pengadaan,kd_suply,id_karyawan,kd_bk,satuan,jumlah,harga) VALUES ('$kd_pengadaan','$tgl_pengadaan','$suplier','$karyawan','$kd_bk','$satuan','$jumlah','$harga')");

        mysqli_query($db, "INSERT INTO bahan_baku(kd_bk,nm_bk,satuan,stok,kd_suply) VALUES ('$kd_bk','$nw_bhnbk','$satuan','$jumlah','$suplier')");

        echo "<script>alert('Data Berhasil Tersimpan')</script>";
        echo "<script>window.location='admin.php?page=pengadaan'</script>";
    } else {
        mysqli_query($db, "INSERT INTO pengadaan(kd_pengadaan,tgl_pengadaan,kd_suply,id_karyawan,kd_bk,satuan,jumlah,harga) VALUES ('$kd_pengadaan','$tgl_pengadaan','$suplier','$karyawan','$bahanbk','$satuan','$jumlah','$harga')");

        mysqli_query($db, "UPDATE bahan_baku SET stok=stok+$jumlah WHERE kd_bk='$bahanbk'");

        echo "<script>alert('Data Berhasil Tersimpan')</script>";
        echo "<script>window.location='admin.php?page=pengadaan'</script>";
    }
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=pengadaan">Data Pengadaan Bahan Baku</a></li>
        <li class="breadcrumb-item active">Pengadaan Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Pengadaan Bahan Baku</b>
        </div>
        <form role="form" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>KD Pengadaan</label>
                    <?php

                    $sql1  = "SELECT max(kd_pengadaan) AS terakhirpas FROM pengadaan";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 10, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "PENGADAAN-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_pengadaan" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <!-- <label>Nama karyawan</label> -->
                    <input type="hidden" class="form-control" name="karyawan" value="<?= $_SESSION['id_karyawan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal Pengadaan</label>
                    <input type="date" class="form-control" name="tgl_pengadaan" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Suplier</label>
                    <select id="suplier" name="suplier" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label>KD Bahan Baku</label> -->
                    <?php

                    $sql1  = "SELECT max(kd_bk) AS terakhirpas FROM bahan_baku";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 3, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "BK-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="hidden" class="form-control" name="kd_bk" value="<?= $nextid1; ?>" readonly>
                </div>
                <script type="text/javascript">
                    function yesnoCheck(that) {
                        if (that.value == "Tambah Bahan Baku") {
                            document.getElementById("nw_bhnbk").style.display = "block";
                            document.getElementById("satuanbk").value = "";

                        } else {
                            document.getElementById("nw_bhnbk").style.display = "none";
                        }
                    }
                </script>
                <div class="form-group" id="selectbk" style="display: block;">
                    <label>Bahan Baku</label>
                    <select id="bahanbk" name="bahanbk" class="form-control" onchange="yesnoCheck(this);">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group" id="nw_bhnbk" style="display: none">
                    <label>Nama Bahan Baku</label>
                    <input type="text" name="nw_bhnbk" class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" id="satuanbk" name="satuan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nope">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" min="1">
                </div>
                <div class=" form-group">
                    <label for="nope">Harga / Satuan</label>
                    <input type="number" class="form-control" name="harga">
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=pengadaan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>