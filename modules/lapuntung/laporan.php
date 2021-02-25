<?php

include '../../db.php';
include '../../fpdf/pdf_mc_table.php';

function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}

$pdf = new PDF_MC_TABLE('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image('../../img/logoch.jpg', 70);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'Jl. Perumnas No.01, Condongsari, Condongcatur, Depok, Sleman, Daerah Istimewa Yogyakarta', '0', '1', 'C', false);
$pdf->Cell(190, 0.6, '', '0', '1', 'C', true);
$pdf->Ln(3);

$pdf->SetFont('Arial', '', 9);

$pdf->Ln(5);

$tglmin = $_SESSION['mintgl'];
$tglmax = $_SESSION['maxtgl'];

$queryjual  = mysqli_query($db, "SELECT penjualan.tgl_jual,pelanggan.nm_plg,SUM(det_penjualan.jumlah*menu.harga)+penjualan.tarif AS totalbiasa 
FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan 
JOIN menu ON det_penjualan.kd_menu=menu.kd_menu 
JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan AND penjualan.tipe_jual='Biasa' AND penjualan.status='Dikirim'
WHERE DATE(penjualan.tgl_jual) BETWEEN '$tglmin' AND '$tglmax'  GROUP BY penjualan.kd_penjualan");

$qrcatering  = mysqli_query($db, "SELECT penjualan.tgl_jual,pelanggan.nm_plg,SUM(det_penjualan.jumlah*menu.harga)+penjualan.tarif AS totalcat 
FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan 
JOIN menu ON det_penjualan.kd_menu=menu.kd_menu 
JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN pembayaran ON pembayaran.kd_penjualan=penjualan.kd_penjualan AND penjualan.tipe_jual='Catering' AND pembayaran.status_bayar='Lunas'
WHERE DATE(penjualan.tgl_jual) BETWEEN '$tglmin' AND '$tglmax' GROUP BY penjualan.kd_penjualan");

$qrpengadaan  = mysqli_query($db, "SELECT pengadaan.*,suplier.nm_suply,bahan_baku.nm_bk,SUM(pengadaan.jumlah*pengadaan.harga) AS sub FROM pengadaan JOIN suplier ON pengadaan.kd_suply=suplier.kd_suply JOIN bahan_baku ON pengadaan.kd_bk=bahan_baku.kd_bk WHERE tgl_pengadaan BETWEEN '$tglmin' AND '$tglmax' GROUP BY pengadaan.kd_pengadaan ORDER BY pengadaan.kd_pengadaan ASC");

// $query1 = mysqli_query($db, "SELECT pengambilan.kd_pengambilan,pengambilan.tgl_pengambilan,SUM(det_pengambilan.jumlah) AS total FROM pengambilan JOIN det_pengambilan ON det_pengambilan.kd_pengambilan=pengambilan.kd_pengambilan WHERE DATE(tgl_pengambilan) BETWEEN '$tglmin' AND '$tglmax'");


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Keuntungan', '0', '1', 'C', false);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(108, 6, 'penjualan', 1, 1, 'L');

$pdf->SetWidths(array(8, 30, 30, 40));

$pdf->SetLineHeight(6);
$pdf->Cell(40, 6, '', 0, 0, 'C');
// $pdf->Cell(8, 6, 'penjualan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Transaksi', 1, 0, 'C');
$pdf->Cell(30, 6, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Total Beli', 1, 1, 'C');


$total = 0;
$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(40, 6, '', 0, 0, 'C');
foreach ($queryjual as $item) {

    $pdf->Row(array(
        $no,
        date('d-m-Y', strtotime($item['tgl_jual'])),
        $item['nm_plg'],
        rupiah($item['totalbiasa']),
    ));
    $total += $item['totalbiasa'];
    $no++;
    $pdf->Cell(40, 6, '', 0, 0, 'C');
}

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(68, 6, 'Total Pendapatan Penjualan', 1, 0, 'C');
$pdf->Cell(40, 6, rupiah($total), 1, 1, 'R');

//catering
$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(108, 6, 'Catering', 1, 1, 'L');
$pdf->SetWidths(array(8, 30, 30, 40));

$pdf->SetLineHeight(6);
$pdf->Cell(40, 6, '', 0, 0, 'C');
// $pdf->Cell(8, 6, 'penjualan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Transaksi', 1, 0, 'C');
$pdf->Cell(30, 6, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Total Beli', 1, 1, 'C');

$total1 = 0;
$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(40, 6, '', 0, 0, 'C');
foreach ($qrcatering as $itemcat) {

    $pdf->Row(array(
        $no,
        date('d-m-Y', strtotime($itemcat['tgl_jual'])),
        $itemcat['nm_plg'],
        rupiah($itemcat['totalcat']),
    ));
    $total1 += $itemcat['totalcat'];
    $no++;
    $pdf->Cell(40, 6, '', 0, 0, 'C');
}

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(68, 6, 'Total Pendapatan Catering', 1, 0, 'C');
$pdf->Cell(40, 6, rupiah($total1), 1, 1, 'R');

//pengadaan
$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(108, 6, 'Pengadaan Bahan Baku', 1, 1, 'L');
$pdf->SetWidths(array(8, 30, 30, 40));

$pdf->SetLineHeight(6);
$pdf->Cell(40, 6, '', 0, 0, 'C');
// $pdf->Cell(8, 6, 'penjualan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Pengadaan', 1, 0, 'C');
$pdf->Cell(30, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(40, 6, 'Total Beli', 1, 1, 'C');

$total2 = 0;
$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(40, 6, '', 0, 0, 'C');
foreach ($qrpengadaan as $itemcat) {

    $pdf->Row(array(
        $no,
        date('d-m-Y', strtotime($itemcat['tgl_pengadaan'])),
        $itemcat['nm_bk'],
        rupiah($itemcat['sub']),
    ));
    $total2 += $itemcat['sub'];
    $no++;
    $pdf->Cell(40, 6, '', 0, 0, 'C');
}

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(68, 6, 'Total Biaya Pengadaaan', 1, 0, 'C');
$pdf->Cell(40, 6, rupiah($total2), 1, 1, 'R');

$totaluntung = 0;
$totaluntung = $total + $total1 - $total2;

// if ($totaluntung < 0) {
//     echo $hasiluntung = "Mengalami Minus";
// } else {
//     echo $hasiluntung = rupiah($totaluntung);
// }

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(68, 6, 'Total Keuntungan', 1, 0, 'C');
$pdf->Cell(40, 6, rupiah($totaluntung), 1, 1, 'R');

$pdf->Ln(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, '', 0, 0, 'C');
$pdf->Cell(0, 5, 'Periode ' . date('d-m-Y', strtotime($tglmin)) . " S/d " . date('d-m-Y', strtotime($tglmax)), '0', '1', 'C', false);
$pdf->Cell(90, 6, '', 0, 0, 'C');
$pdf->Cell(0, 5, "Dicetak Oleh, " . $_SESSION['level'], '0', '1', 'C', false);
$pdf->Ln(15);
$pdf->Cell(90, 6, '', 0, 0, 'C');
$pdf->Cell(0, 5, $_SESSION['nama'], '0', '1', 'C', false);

$pdf->Output("Laporan Keuntungan.pdf", "I");
