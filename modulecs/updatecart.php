<?php

include '../db.php';


$kd_jual = $_SESSION['ss_jual'];
$barang_id = $_POST['barang_id'];
$value = $_POST['value'];

if ($value < 1) {
    echo "<script>window.location='index.php?page=keranjang'</script>";
} else {
    mysqli_query($db, "UPDATE tmp_detpenjualan SET jumlah='$value' WHERE kd_menu='$barang_id'");
}
