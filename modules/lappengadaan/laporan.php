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

$query  = mysqli_query($db, "SELECT pengadaan.*,suplier.nm_suply,bahan_baku.nm_bk,SUM(pengadaan.jumlah*pengadaan.harga) AS sub FROM pengadaan JOIN suplier ON pengadaan.kd_suply=suplier.kd_suply JOIN bahan_baku ON pengadaan.kd_bk=bahan_baku.kd_bk WHERE tgl_pengadaan BETWEEN '$tglmin' AND '$tglmax' GROUP BY pengadaan.kd_pengadaan ORDER BY pengadaan.kd_pengadaan ASC");

$query1  = mysqli_query($db, "SELECT SUM(pengadaan.jumlah*pengadaan.harga) AS total FROM pengadaan WHERE tgl_pengadaan BETWEEN '$tglmin' AND '$tglmax'");

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Pengadaan Bahan Baku', '0', '1', 'C', false);

$pdf->Cell(0, 5, 'Periode ' . date('d-m-Y', strtotime($tglmin)) . " S/d " . date('d-m-Y', strtotime($tglmax)), '0', '1', 'C', false);

$pdf->Ln(5);

$pdf->SetWidths(array(8, 25, 40, 40,  10, 20, 20));

$pdf->SetLineHeight(6);
$pdf->Cell(10, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(25, 6, 'Tanggal Pengadaan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Suplier', 1, 0, 'C');
$pdf->Cell(40, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(10, 6, 'Jumlah', 1, 0, 'C');
$pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
$pdf->Cell(20, 6, 'Sub Total', 1, 1, 'C');


$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(10, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['tgl_pengadaan'],
        $item['nm_suply'],
        $item['nm_bk'],
        $item['jumlah'],
        rupiah($item['harga']),
        rupiah($item['sub']),
    ));
    $no++;
    $pdf->Cell(10, 6, '', 0, 0, 'C');
}

$total = mysqli_fetch_assoc($query1);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(143, 6, 'Total', 1, 0, 'C');
$pdf->Cell(20, 6, rupiah($total['total']), 1, 0, 'L');

$pdf->Output("Laporan Pengadaan Bahan Baku.pdf", "I");
