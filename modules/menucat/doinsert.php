<?php

include '../../db.php';

date_default_timezone_set('Asia/Jakarta');

$result["message"] = "";

$kd_paketcat = $_POST['kd_paketcat'];
$menu = $_POST['menu'];

$qrvalid = mysqli_query($db, "SELECT det_paketcatering.kd_menu FROM det_paketcatering WHERE kd_paketcatering='$kd_paketcat'");
$hasilvalid = mysqli_fetch_assoc($qrvalid);


if ($kd_paketcat == "") {
    $result["message"] = "Kode Paket Catering Tidak Boleh Kosong";
} elseif ($menu == "") {
    $result["message"] = "Silahkan Pilih Menu!";
} elseif ($menu == $hasilvalid['kd_menu']) {
    $result["message"] = "Menu Yang Ditambahkan Sudah Ada";
} else {
    $query_result = mysqli_query($db, "INSERT INTO det_paketcatering(kd_paketcatering,kd_menu) VALUES ('$kd_paketcat','$menu')");

    if ($query_result) {
        $result["message"] = "Data Berhasil Ditambakan";
    } else {
        $result["message"] = "Gagal Menyimpan Data";
    }
}

echo json_encode($result);
