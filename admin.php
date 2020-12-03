<?php

include 'db.php';

date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['no_user'])) {
    header('location:loginad.php?alert=3');
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'logout') {

        session_destroy();

        header('location:loginad.php?alert=2');
    }
}


function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Chicken Hitz - Penjualan</title>
    <!-- Favicon -->
    <link rel="icon" type="asetcs/eshop/image/png" href="img/logoch.jpg">
    <link href="aset/dist/css/styles.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info">
        <a class="navbar-brand" href="admin.php?page=home">Chicken Hitz</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-10">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="admin.php?aksi=logout">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php include 'sidebar/template.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <?php
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == 'karyawan') {
                        include 'modules/karyawan/view.php';
                    } elseif ($_GET['page'] == 'tamkaryawan') {
                        include 'modules/karyawan/tambah.php';
                    } elseif ($_GET['page'] == 'editkar') {
                        include 'modules/karyawan/edit.php';
                    } elseif ($_GET['page'] == 'detkar') {
                        include 'modules/karyawan/detail.php';
                    } elseif ($_GET['page'] == 'suplier') {
                        include 'modules/suplier/view.php';
                    } elseif ($_GET['page'] == 'tamsuplier') {
                        include 'modules/suplier/tambah.php';
                    } elseif ($_GET['page'] == 'editsuplier') {
                        include 'modules/suplier/edit.php';
                    } elseif ($_GET['page'] == 'bahanbku') {
                        include 'modules/bahanbk/view.php';
                    } elseif ($_GET['page'] == 'tamb_baku') {
                        include 'modules/bahanbk/tambah.php';
                    } elseif ($_GET['page'] == 'edit_baku') {
                        include 'modules/bahanbk/edit.php';
                    } elseif ($_GET['page'] == 'kategori') {
                        include 'modules/kategori/view.php';
                    } elseif ($_GET['page'] == 'tamktgr') {
                        include 'modules/kategori/tambah.php';
                    } elseif ($_GET['page'] == 'editktgr') {
                        include 'modules/kategori/edit.php';
                    } elseif ($_GET['page'] == 'menu') {
                        include 'modules/menu/view.php';
                    } elseif ($_GET['page'] == 'tammenu') {
                        include 'modules/menu/tambah.php';
                    } elseif ($_GET['page'] == 'detmenu') {
                        include 'modules/menu/detail.php';
                    } elseif ($_GET['page'] == 'editmenu') {
                        include 'modules/menu/edit.php';
                    } elseif ($_GET['page'] == 'pengadaan') {
                        include 'modules/pengadaan/view.php';
                    } elseif ($_GET['page'] == 'tampengadaan') {
                        include 'modules/pengadaan/tambah.php';
                    } elseif ($_GET['page'] == 'detpengadaan') {
                        include 'modules/pengadaan/detail.php';
                    } elseif ($_GET['page'] == 'pengambilan') {
                        include 'modules/pengambilan/view.php';
                    } elseif ($_GET['page'] == 'tampengambilan') {
                        include 'modules/pengambilan/tambah.php';
                    } elseif ($_GET['page'] == 'detpengambilan') {
                        include 'modules/pengambilan/detail.php';
                    } elseif ($_GET['page'] == 'home') {
                        include 'modules/home/view.php';
                    } elseif ($_GET['page'] == 'penjualan') {
                        include 'modules/penjualan/view.php';
                    } elseif ($_GET['page'] == 'det_jual') {
                        include 'modules/penjualan/detail.php';
                    } elseif ($_GET['page'] == 'catering') {
                        include 'modules/catering/view.php';
                    } elseif ($_GET['page'] == 'det_catering') {
                        include 'modules/catering/detail.php';
                    } elseif ($_GET['page'] == 'ceklapbeli') {
                        include 'modules/lappengadaan/ceklap.php';
                    } elseif ($_GET['page'] == 'ceklapambil') {
                        include 'modules/lapambil/ceklap.php';
                    } elseif ($_GET['page'] == 'ceklapjual') {
                        include 'modules/lapjual/ceklap.php';
                    } elseif ($_GET['page'] == 'ceklapcat') {
                        include 'modules/lapcatering/ceklap.php';
                    } elseif ($_GET['page'] == 'datplg') {
                        include 'modules/pelanggan/view.php';
                    }
                } else {
                    include 'modules/home/view.php';
                }
                ?>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?php echo "Copyright © " . (int)date('Y') . " Chicken Hitz"; ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="aset/dist/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="aset/dist/assets/demo/datatables-demo.js"></script>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/chickenhitz/modules/pengadaan/vsuplier.php",
            cache: false,
            success: function(msg) {
                $("#suplier").html(msg);
            }
        });

        $("#suplier").change(function() {
            var suplier = $("#suplier").val();
            $.ajax({
                type: 'POST',
                url: "http://localhost/chickenhitz/modules/pengadaan/vbahan.php",
                data: {
                    suplier: suplier
                },
                cache: false,
                success: function(msg) {
                    $("#bahanbk").html(msg);
                }
            });
        });
    });
</script>

<!-- pengambilan bahan -->

<script type="text/javascript">
    //view data

    function loaddata() {
        var datahandler = $("#data");
        var kd_pengambilan = $("[name='kd_pengambilan']").val();
        datahandler.html("");
        $.ajax({
            type: "POST",
            data: "kd_pengambilan=" + kd_pengambilan,
            url: 'http://localhost/chickenhitz/modules/pengambilan/viewbk.php',
            success: function(result) {
                var resultobj = JSON.parse(result);
                var nomor = 1;


                $.each(resultobj, function(key, val) {
                    var newrow = $("<tr>");
                    newrow.html("<td>" + nomor + "</td><td>" + val.nm_bk + "</td><td>" + val.jumlah + "</td><td><input type='button' onclick='hapusdata(" + val.kd_detpengambilan + ")' class='btn btn-danger' value='hapus'></td>");

                    datahandler.append(newrow);
                    nomor++;
                });
            }
        });
    }

    // insert data
    // loaddata();

    function insertdata() {
        var kd_pengambilan = $("[name='kd_pengambilan']").val();
        var bk = $("[name='bk']").val();
        var jumlah = $("[name='jumlah']").val();

        $.ajax({
            type: "POST",
            data: "kd_pengambilan=" + kd_pengambilan + "&bk=" + bk + "&jumlah=" + jumlah,
            url: 'http://localhost/chickenhitz/modules/pengambilan/insert.php',
            success: function(result) {
                var resultobj = JSON.parse(result);
                $("#coment").html(resultobj.message);
                $("[name='bk']").val("");
                $("[name='jumlah']").val("");
                loaddata();
            }
        });
    }

    //Hapus
    function hapusdata(kd_detpengambilan) {
        var tanya = confirm("Apakah Anda Yakin Akan Mengghapus Bahan Baku Ini?");
        if (tanya) {
            $.ajax({
                type: "POST",
                data: "kd_detpengambilan=" + kd_detpengambilan,
                url: "http://localhost/chickenhitz/modules/pengambilan/hapus.php",
                success: function(result) {
                    loaddata();
                }
            });
        }
    }
</script>

<!-- lihat resi -->
<script type="text/javascript">
    $(document).on("click", "#aksigambar", function() {
        var resi = $(this).data('gambar');
        $("#vresi").html('<img src="img/resi_pembayaran/' + resi + '" style="width:100%;">');
    });
</script>

<!-- ubahstatuspenjualan -->
<script type="text/javascript">
    $(document).on("click", "#ubahsjual", function() {
        var id_status = $(this).data('idstatus');
        var statusjual = $(this).data('statusjual');

        // $("#updatesewa #id_sewa").val(idpen);
        $("#statusjual").find("input[name=id_statusjual]").val(id_status);
        $("#statusjual").find("select[name=keterangan]").val(statusjual);
    });
</script>

<!-- gamba resi detail jual -->

<script type="text/javascript">
    $(document).on("click", "#aksigambardet", function() {
        var residet = $(this).data('gambardet');
        $("#residet").html('<img src="img/resi_pembayaran/' + residet + '" style="width:100%;">');
    });
</script>

<!-- ubahstatusbayarcatering -->
<script type="text/javascript">
    $(document).on("click", "#statusbayarcat", function() {
        var idcat = $(this).data('idcat');
        var statuscat = $(this).data('statuscat');

        // $("#updatesewa #id_sewa").val(idpen);
        $("#bayarcat").find("input[name=id_catering]").val(idcat);
        $("#bayarcat").find("select[name=statusbayar]").val(statuscat);
    });
</script>

<!-- ubahstatuscatering -->
<script type="text/javascript">
    $(document).on("click", "#ubahscat", function() {
        var idscatering = $(this).data('idscatering');
        var statuscatt = $(this).data('statuscatt');

        // $("#updatesewa #id_sewa").val(idpen);
        $("#statuscatering").find("input[name=id_scattt]").val(idscatering);
        $("#statuscatering").find("select[name=keterangancat]").val(statuscatt);
    });
</script>