<?php

include '../../db.php';

date_default_timezone_set('Asia/Jakarta');

$result["message"] = "";

$kd_detail = $_POST['kd_detail'];
$menu = $_POST['menu'];


if ($kd_detail == "") {
    $result["message"] = "Kode Detail Tidak Boleh Kosong";
} elseif ($menu == "") {
    $result["message"] = "Silahkan Pilih Menu!";
} else {
    $query_result = mysqli_query($db, "UPDATE det_paketcatering SET kd_menu='$menu' WHERE kd_detpaketcat='$kd_detail'");

    if ($query_result) {
        $result["message"] = "Data Berhasil Diubah";
    } else {
        $result["message"] = "Gagal Mengubah Data";
    }
}

echo json_encode($result);
