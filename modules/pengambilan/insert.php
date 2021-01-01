<?php

include '../../db.php';

date_default_timezone_set('Asia/Jakarta');

$result["message"] = "";

$kd_pengambilan = $_POST['kd_pengambilan'];
$bk = $_POST['bk'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$keterangan = $_POST['keterangan'];

$cekstok = mysqli_query($db, "SELECT bahan_baku.stok FROM bahan_baku WHERE kd_bk='$bk'");
$cek = mysqli_fetch_assoc($cekstok);

if ($kd_pengambilan == "") {
    $result["message"] = "Kode Pengambilan Tidak Boleh Kosong";
} elseif ($bk == "") {
    $result["message"] = "Silahkan Pilih Bahan Baku!";
} elseif ($jumlah == "") {
    $result["message"] = "Jumlah yang Dibutuhkan Tidak Boleh Kososng!";
} elseif ($jumlah <= 0) {
    $result["message"] = "Jumlah yang Dibutuhkan Tidak Boleh Kurang Dari 1";
} elseif ($jumlah > $cek['stok']) {
    $result["message"] = "Jumlah Yang Dibutuhkan Melebihi Ketersediaan Bahan Baku!";
} else {
    $query_result = mysqli_query($db, "INSERT INTO tmp_detpengambilan(kd_pengambilan,kd_bk,satuan,jumlah,keterangan) VALUES ('$kd_pengambilan','$bk','$satuan','$jumlah','$keterangan')");
    $query_result1 = mysqli_query($db, "UPDATE bahan_baku SET stok=stok-'$jumlah' WHERE kd_bk='$bk'");

    if ($query_result) {
        $result["message"] = "Data Berhasil Ditambakan";
    } elseif ($query_result1) {
        $result["message"] = "Data Berhasil Ditambakan";
    } else {
        $result["message"] = "Gagal Menyimpan Data";
    }
}

echo json_encode($result);
