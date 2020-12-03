<?php

$awal = date_create('2020-11-27 16:10:24');
$akhir = date_create('2020-11-30 16:10:24');
$interval = date_diff($awal, $akhir);
$cek = $interval->format('%d');

if ($cek < 3) {
    echo "<script>alert('Tanggal Pemesanan Minimal H-3 Dari Tanggal Sekarang')</script>";
    return false;
} else {
    echo "<script>alert('berhasil')</script>";
}
