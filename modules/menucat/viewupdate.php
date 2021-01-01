<?php
include "../../db.php";

$kd_paketcat = $_POST['kd_paketcat'];

$query = mysqli_query($db, "SELECT det_paketcatering.kd_menu,det_paketcatering.kd_detpaketcat,menu.nama_menu FROM det_paketcatering JOIN menu ON det_paketcatering.kd_menu=menu.kd_menu WHERE kd_paketcatering='$kd_paketcat'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $resultt[] = $fethdata;
}

echo json_encode($resultt);
