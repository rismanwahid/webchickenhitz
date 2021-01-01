<?php

include '../../db.php';

date_default_timezone_set('Asia/Jakarta');

$result["message"] = "";

$kd_paketcat = $_POST['kd_paketcat'];
$menu = $_POST['menu'];


if ($kd_paketcat == "") {
    $result["message"] = "Kode Paket Catering Tidak Boleh Kosong";
} elseif ($menu == "") {
    $result["message"] = "Silahkan Pilih Menu!";
} else {
    $query_result = mysqli_query($db, "INSERT INTO tmpdet_paketcatering(kd_paketcatering,kd_menu) VALUES ('$kd_paketcat','$menu')");

    if ($query_result) {
        $result["message"] = "Data Berhasil Ditambakan";
    } elseif ($query_result1) {
        $result["message"] = "Data Berhasil Ditambakan";
    } else {
        $result["message"] = "Gagal Menyimpan Data";
    }
}

echo json_encode($result);
