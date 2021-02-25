<?php

include '../db.php';

$kabupaten = $_POST['selectongkir'];
echo "<option value='' disabled selected>--Pilih Kabupaten--</option>";
$query = "SELECT kd_kecamatan,nm_kecamatan FROM kecamatan WHERE kd_tarif='$kabupaten' ORDER BY nm_kecamatan ASC";

$dewan1 = $db->prepare($query);
// $dewan1->bind_param("i", $suplier);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "<option value='" . $row['kd_kecamatan'] . "'>" . $row['nm_kecamatan'] . "</option>";
}
