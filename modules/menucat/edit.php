<?php
if (isset($_POST['simpan'])) {
    $kd_paketcat  = $_POST['kd_paketcat'];
    $nm_paketcat   = $_POST['nm_paketcat'];
    $status = $_POST['status'];
    // $harga = $_POST['harga'];

    if ($_FILES["gambar"]["name"] == "") {
        $update_gambar  = "";
    } else {
        $nama_file  = $_FILES["gambar"]["name"];
        $gambar_new    = date('dmYHis') . $nama_file;
        $update_gambar = ",gambar='$gambar_new'";
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/paketcat/" . $gambar_new);
    }

    mysqli_query($db, "UPDATE paket_catering SET
    nm_paketcatering = '$nm_paketcat',
    status = '$status' $update_gambar WHERE kd_paketcatering='$kd_paketcat'");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='admin.php?page=paketcat'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=paketcat">Data Paket Catering</a></li>
        <li class="breadcrumb-item active">Edit Paket Catering</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Paket Catering</b>
        </div>
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <!-- <label>KD Pengambilan</label> -->
                    <?php

                    $id = $_GET['kd_paketcatering'];
                    $qr = mysqli_query($db, "SELECT paket_catering.* FROM paket_catering WHERE kd_paketcatering='$id'");
                    $pecah = mysqli_fetch_assoc($qr);

                    ?>
                    <input type="text" class="form-control" name="kd_paketcat" value="<?= $pecah['kd_paketcatering']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Paket Catering</label>
                    <input type="text" class="form-control" name="nm_paketcat" value="<?= $pecah['nm_paketcatering']; ?>" required>
                </div>
                <div class="form-group">
                    <!-- <label>ID Det Paket cat</label> -->
                    <input type="hidden" class="form-control" name="kd_detail" readonly>
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
                    <input type="button" class="btn btn-primary" value="Tambah" onclick="upinsertpaketcat()">
                    <input type="button" class="btn btn-secondary" value="Edit" onclick="ubahpaketcat()"><br><br>
                    <p id="comentpaketcatupdate"></p>

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
                    <img src="img/paketcat/<?php echo $pecah['gambar']; ?> " width="100px"><br><br>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="idkaryawan">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" <?php if ($pecah['status'] == "Tersedia") {
                                                                                        echo "checked='true'";
                                                                                    }
                                                                                    ?> value="Tersedia">
                        <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" <?php if ($pecah['status'] == "Tidak Tersedia") {
                                                                                        echo "checked='true'";
                                                                                    }
                                                                                    ?> value="Tidak Tersedia">
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

    function loadupdatepaketcat() {
        var datahandler = $("#datamenucat");
        var kd_paketcat = $("[name='kd_paketcat']").val();
        datahandler.html("");
        $.ajax({
            type: "POST",
            data: "kd_paketcat=" + kd_paketcat,
            url: "http://localhost/chickenhitz/modules/menucat/viewupdate.php",
            success: function(result) {
                var resultobj = JSON.parse(result);
                var nomor = 1;


                $.each(resultobj, function(key, val) {
                    var newrow = $("<tr>");
                    newrow.html("<td>" + nomor + "</td><td>" + val.nama_menu + "</td><td><input type='button' class='pilihupdate' id='" + val.kd_detpaketcat + "' class='btn btn-secondary' value='Pilih'>&ensp;<input type='button' onclick='hapusdataupdate(" + val.kd_detpaketcat + ")' class='btn btn-danger' value='Hapus'></td>");

                    datahandler.append(newrow);
                    nomor++;
                });
            }
        });
    }

    // insert data

    loadupdatepaketcat();



    function upinsertpaketcat() {
        var kd_paketcat = $("[name='kd_paketcat']").val();
        var menu = $("[name='menu']").val();

        $.ajax({
            type: "POST",
            data: "kd_paketcat=" + kd_paketcat + "&menu=" + menu,
            url: "http://localhost/chickenhitz/modules/menucat/doinsert.php",
            success: function(resultt) {
                var resultobj1 = JSON.parse(resultt);
                $("#comentpaketcatupdate").html(resultobj1.message);
                loadupdatepaketcat();
            }
        });
    }

    //Hapus
    function hapusdataupdate(kd_detpaketcat) {
        var tanya = confirm("Apakah Anda Yakin Akan Menghapus Menu Baku Ini?");
        if (tanya) {
            $.ajax({
                type: "POST",
                data: "kd_detpaketcat=" + kd_detpaketcat,
                url: "http://localhost/chickenhitz/modules/menucat/dohapus.php",
                success: function(resultt) {
                    loadupdatepaketcat();
                }
            });
        }
    }

    //pilih data    

    $(document).on("click", ".pilihupdate", function() {
        var id_detcat = $(this).attr("id");

        $.ajax({
            type: "POST",
            data: "id_detcat=" + id_detcat,
            url: "http://localhost/chickenhitz/modules/menucat/getmenu.php",
            success: function(result) {
                var resultmenu = JSON.parse(result);

                var kd_detail = $("[name='kd_detail']").val(resultmenu.kd_detpaketcat);
                var menupilih = $("[name='menu']").val(resultmenu.kd_menu);
            }
        })
    });

    //update data

    function ubahpaketcat() {
        var kd_detail = $("[name='kd_detail']").val();
        var menu = $("[name='menu']").val();

        $.ajax({
            type: "POST",
            data: "kd_detail=" + kd_detail + "&menu=" + menu,
            url: "http://localhost/chickenhitz/modules/menucat/doupdate.php",
            success: function(result) {
                var resultobj1 = JSON.parse(result);
                $("#comentpaketcatupdate").html(resultobj1.message);
                loadupdatepaketcat();
            }
        })
    }
</script>