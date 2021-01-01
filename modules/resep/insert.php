<?php

include '../../db.php';

date_default_timezone_set('Asia/Jakarta');

$result["message"] = "";

$kd_resep = $_POST['kd_resep'];
$menu = $_POST['menu'];
$bk = $_POST['bk'];
$takaran = $_POST['takaran'];
$satuan = $_POST['satuan'];

if ($kd_resep == "") {
    $result["message"] = "Kode Resep Tidak Boleh Kosong";
} elseif ($menu == "") {
    $result["message"] = "Silahkan Pilih Bahan Baku!";
} elseif ($bk == "") {
    $result["message"] = "Silahkan Pilih Menu!";
} elseif ($takaran == "") {
    $result["message"] = "Takaran Tidak Boleh Kosong!";
} elseif ($takaran <= 0) {
    $result["message"] = "Takaran Yang Diinputkan Tidak Boleh Kurang Dari 1";
} elseif ($satuan == "") {
    $result["message"] = "Satuan Tidak Boleh Kosong!";
} else {
    $query_result = mysqli_query($db, "INSERT INTO tmpdet_resep(kd_resep,kd_bk,takaran,satuan) VALUES ('$kd_resep','$bk','$takaran','$satuan')");

    if ($query_result) {
        $result["message"] = "Data Berhasil Ditambakan";
    } else {
        $result["message"] = "Gagal Menyimpan Data";
    }
}

echo json_encode($result);
