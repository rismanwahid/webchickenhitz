<?php
include "../../db.php";

$id_detcat = $_POST['id_detcat'];

$result = array();

$query = mysqli_query($db, "SELECT * FROM det_paketcatering WHERE kd_detpaketcat = '$id_detcat'");

$fetchdata = mysqli_fetch_assoc($query);

$result = $fetchdata;

echo json_encode($result);
