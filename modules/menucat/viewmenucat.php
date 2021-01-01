<?php
include "../../db.php";

$kd_paketcat = $_POST['kd_paketcat'];

$query = mysqli_query($db, "SELECT tmpdet_paketcatering.kd_menu,tmpdet_paketcatering.kd_detpaketcat,menu.nama_menu FROM tmpdet_paketcatering JOIN menu ON tmpdet_paketcatering.kd_menu=menu.kd_menu WHERE kd_paketcatering='$kd_paketcat'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $resultt[] = $fethdata;
}

echo json_encode($resultt);
