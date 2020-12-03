<?php

include '../db.php';


$kd_jual = $_SESSION['ss_jual'];
$barang_id = $_POST['barang_id'];
$value = $_POST['value'];

mysqli_query($db, "UPDATE tmp_detpenjualan SET jumlah='$value' WHERE kd_menu='$barang_id'");
