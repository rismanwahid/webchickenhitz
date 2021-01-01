<?php
if (isset($_POST['simpan'])) {
    $kd_pengambilan  = $_POST['kd_pengambilan'];
    $jam = date('H:i:s');
    $tgl_pengambilan   = $_POST['tgl_pengambilan'] . " " . $jam;
    $karyawan = $_POST['karyawan'];

    mysqli_query($db, "INSERT INTO pengambilan(kd_pengambilan,tgl_pengambilan,id_karyawan) VALUES ('$kd_pengambilan','$tgl_pengambilan','$karyawan')");

    mysqli_query($db, "INSERT INTO det_pengambilan(kd_pengambilan,kd_bk,satuan,jumlah,keterangan) SELECT kd_pengambilan,kd_bk,satuan,jumlah,keterangan FROM tmp_detpengambilan WHERE kd_pengambilan='$kd_pengambilan'");

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
                    <!-- <label>KD Pengambilan</label> -->
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
                    <input type="date" class="form-control" name="tgl_pengambilan" value="<?php echo date('Y-m-d') ?>" min="<?= date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label>Bahan Baku</label>
                    <select name="bk" id="bk" class="form-control" onchange="changeValue(this.value)">
                        <option value="">Pilih Bahan Baku</option>
                        <?php
                        $query = mysqli_query($db, "SELECT * FROM bahan_baku WHERE satuan!='Kg' ORDER BY nm_bk ASC");
                        $result = mysqli_query($db, "SELECT * FROM bahan_baku WHERE satuan!='Kg'");
                        $a          = "var satuan = new Array();\n;";
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option name="bk" value="' . $row['kd_bk'] . '">' . $row['nm_bk'] . '</option>';
                            $a .= "satuan['" . $row['kd_bk'] . "'] = {satuan:'" . addslashes($row['satuan']) . "'};\n";
                        }
                        ?>
                    </select>
                </div>
                <script type="text/javascript">
                    <?php
                    echo $a;
                    ?>

                    function changeValue(id) {
                        document.getElementById('satuan').value = satuan[id].satuan;
                    };
                </script>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" id="satuan" name="satuan" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>
                <input type="button" class="btn btn-primary" value="Ambil" onclick="insertambil()"><br><br>
                <p id="comentpengambilan"></p>

                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody id="datapengambilan"></tbody>

                </table>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=pengambilan" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- pengambilan bahan -->

<script type="text/javascript">
    //view data

    function loaddataambil() {
        var datahandler = $("#datapengambilan");
        var kd_pengambilan = $("[name='kd_pengambilan']").val();
        datahandler.html("");
        $.ajax({
            type: "POST",
            data: "kd_pengambilan=" + kd_pengambilan,
            url: "http://localhost/chickenhitz/modules/pengambilan/viewbk.php",
            success: function(result) {
                var resultobj = JSON.parse(result);
                var nomor = 1;


                $.each(resultobj, function(key, val) {
                    var newrow = $("<tr>");
                    newrow.html("<td>" + nomor + "</td><td>" + val.nm_bk + "</td><td>" + val.jumlahsat + "</td><td>" + val.keterangan + "</td><td><input type='button' onclick='hapusdataambil(" + val.kd_detpengambilan + ")' class='btn btn-danger' value='hapus'></td>");

                    datahandler.append(newrow);
                    nomor++;
                });
            }
        });
    }

    // insert data

    loaddataambil();

    function insertambil() {
        var kd_pengambilan = $("[name='kd_pengambilan']").val();
        var bk = $("[name='bk']").val();
        var jumlah = $("[name='jumlah']").val();
        var satuan = $("[name='satuan']").val();
        var keterangan = $("[name='keterangan']").val();

        $.ajax({
            type: "POST",
            data: "kd_pengambilan=" + kd_pengambilan + "&bk=" + bk + "&jumlah=" + jumlah + "&satuan=" + satuan + "&keterangan=" + keterangan,
            url: "http://localhost/chickenhitz/modules/pengambilan/insert.php",
            success: function(resultt) {
                var resultobj1 = JSON.parse(resultt);
                $("#comentpengambilan").html(resultobj1.message);
                $("[name='bk']").val("");
                $("[name='satuan']").val("");
                $("[name='jumlah']").val("");
                $("[name='keterangan']").val("");
                loaddataambil();
            }
        });
    }

    //Hapus
    function hapusdataambil(kd_detpengambilan) {
        var tanya = confirm("Apakah Anda Yakin Akan Mengghapus Bahan Baku Ini?");
        if (tanya) {
            $.ajax({
                type: "POST",
                data: "kd_detpengambilan=" + kd_detpengambilan,
                url: "http://localhost/chickenhitz/modules/pengambilan/hapus.php",
                success: function(resultt) {
                    loaddataambil();
                }
            });
        }
    }
</script>