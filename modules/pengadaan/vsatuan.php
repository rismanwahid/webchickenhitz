<?php
include '../../db.php';
$bahanbk = $_POST['bahanbk'];

$query = mysqli_query($db, "SELECT bahan_baku.satuan FROM bahan_baku WHERE kd_bk='$bahanbk'");
$result1 = mysqli_fetch_array($query);


echo json_encode($result1);
