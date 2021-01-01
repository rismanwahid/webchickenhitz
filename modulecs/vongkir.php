<?php
include '../db.php';
$selectongkir = $_POST['selectongkir'];
$id_jual = $_SESSION['ss_jual'];

$query = mysqli_query($db, "SELECT kabupaten.tarif FROM kabupaten WHERE kd_tarif='$selectongkir'");
$result = mysqli_fetch_assoc($query);

$query1 = mysqli_query($db, "SELECT SUM(tmp_detpenjualan.jumlah*tmp_detpenjualan.harga)+" . $result['tarif'] . " AS totalbayar FROM tmp_detpenjualan WHERE kd_penjualan='$id_jual'");
$result2 = mysqli_fetch_assoc($query1);


echo json_encode(array(
    'result' => $result,
    'result2' => $result2
));
