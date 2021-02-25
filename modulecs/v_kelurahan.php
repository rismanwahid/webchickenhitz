<?php

include '../db.php';

$kecamatan = $_POST['kecamatan'];
echo "<option value='' disabled selected>--Pilih kelurahan--</option>";
$query = "SELECT kd_kelurahan,nm_kelurahan FROM kelurahan WHERE kd_kecamatan='$kecamatan' ORDER BY nm_kelurahan ASC";

$dewan1 = $db->prepare($query);
// $dewan1->bind_param("i", $suplier);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "<option value='" . $row['kd_kelurahan'] . "'>" . $row['nm_kelurahan'] . "</option>";
}
