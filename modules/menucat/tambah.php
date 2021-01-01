<?php
if (isset($_POST['simpan'])) {
    $kd_paketcat  = $_POST['kd_paketcat'];
    $nm_paketcat   = $_POST['nm_paketcat'];
    $status = $_POST['status'];
    // $harga = $_POST['harga'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_new    = date('dmYHis') . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], "img/paketcat/" . $gambar_new);

    mysqli_query($db, "INSERT INTO paket_catering(kd_paketcatering,nm_paketcatering,gambar,status) VALUES ('$kd_paketcat','$nm_paketcat','$gambar_new','$status')");

    mysqli_query($db, "INSERT INTO det_paketcatering(kd_paketcatering,kd_menu) SELECT kd_paketcatering,kd_menu FROM tmpdet_paketcatering WHERE kd_paketcatering='$kd_paketcat'");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=paketcat'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=paketcat">Data Paket Catering</a></li>
        <li class="breadcrumb-item active">Tambah Paket Catering</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Tambah Paket Catering</b>
        </div>
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <!-- <label>KD Pengambilan</label> -->
                    <?php

                    $sql1  = "SELECT max(kd_paketcatering) AS terakhirpas FROM paket_catering";
                    $hasil1  = mysqli_query($db, $sql1);
                    $data1   = mysqli_fetch_array($hasil1);
                    $lastid1 = $data1['terakhirpas'];
                    $lastnourut1 = (int)substr($lastid1, 7, 4);
                    $nexturut1   = $lastnourut1 + 1;
                    $nextid1     = "PAKCAT-" . sprintf("%04s", $nexturut1);

                    ?>
                    <input type="text" class="form-control" name="kd_paketcat" value="<?= $nextid1; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Paket Catering</label>
                    <input type="text" class="form-control" name="nm_paketcat" required>
                </div>
                <div class="form-group">
                    <label>Nama Menu</label>
                    <select name="menu" class="form-control">
                        <option value="">Pilih Menu</option>
                        <?php
                        $result = mysqli_query($db, "SELECT * FROM menu");
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['kd_menu'] . '">' . $row['nama_menu'] . '</option>';
                        }
                        ?>
                    </select><br>
                    <input type="button" class="btn btn-primary" value="Tambah" onclick="insertpaketcat()"><br><br>
                    <p id="comentpaketcat"></p>

                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody id="datamenucat"></tbody>

                    </table>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div> -->
                <div class="form-group">
                    <label for="idkaryawan">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tersedia">
                        <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="Tidak Tersedia">
                        <label class="form-check-label" for="inlineRadio2">Tidak Tersedia</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="admin.php?page=paketcat" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- pengambilan bahan -->

<script type="text/javascript">
    //view data

    function loadpaketcat() {
        var datahandler = $("#datamenucat");
        var kd_paketcat = $("[name='kd_paketcat']").val();
        datahandler.html("");
        $.ajax({
            type: "POST",
            data: "kd_paketcat=" + kd_paketcat,
            url: "http://localhost/chickenhitz/modules/menucat/viewmenucat.php",
            success: function(result) {
                var resultobj = JSON.parse(result);
                var nomor = 1;


                $.each(resultobj, function(key, val) {
                    var newrow = $("<tr>");
                    newrow.html("<td>" + nomor + "</td><td>" + val.nama_menu + "</td><td><input type='button' onclick='hapusdataambil(" + val.kd_detpaketcat + ")' class='btn btn-danger' value='hapus'></td>");

                    datahandler.append(newrow);
                    nomor++;
                });
            }
        });
    }

    // insert data

    loadpaketcat();

    function insertpaketcat() {
        var kd_paketcat = $("[name='kd_paketcat']").val();
        var menu = $("[name='menu']").val();

        $.ajax({
            type: "POST",
            data: "kd_paketcat=" + kd_paketcat + "&menu=" + menu,
            url: "http://localhost/chickenhitz/modules/menucat/insert.php",
            success: function(result) {
                var resultobj1 = JSON.parse(result);
                $("#comentpaketcat").html(resultobj1.message);
                $("[name='menu']").val("");
                loadpaketcat();
            }
        });
    }

    //Hapus
    function hapusdataambil(kd_detpaketcat) {
        var tanya = confirm("Apakah Anda Yakin Akan Menghapus Menu Baku Ini?");
        if (tanya) {
            $.ajax({
                type: "POST",
                data: "kd_detpaketcat=" + kd_detpaketcat,
                url: "http://localhost/chickenhitz/modules/menucat/hapus.php",
                success: function(result) {
                    loadpaketcat();
                }
            });
        }
    }
</script>