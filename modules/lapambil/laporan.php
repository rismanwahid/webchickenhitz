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

$query  = mysqli_query($db, "SELECT pengambilan.*,det_pengambilan.kd_bk,bahan_baku.nm_bk,det_pengambilan.jumlah,karyawan.nm_karyawan FROM pengambilan JOIN det_pengambilan ON det_pengambilan.kd_pengambilan=pengambilan.kd_pengambilan JOIN bahan_baku ON det_pengambilan.kd_bk=bahan_baku.kd_bk JOIN karyawan ON pengambilan.id_karyawan=karyawan.id_karyawan WHERE DATE(tgl_pengambilan) BETWEEN '$tglmin' AND '$tglmax' ORDER BY pengambilan.kd_pengambilan ASC");

$query1 = mysqli_query($db, "SELECT pengambilan.kd_pengambilan,pengambilan.tgl_pengambilan,SUM(det_pengambilan.jumlah) AS total FROM pengambilan JOIN det_pengambilan ON det_pengambilan.kd_pengambilan=pengambilan.kd_pengambilan WHERE DATE(tgl_pengambilan) BETWEEN '$tglmin' AND '$tglmax'");


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Pengambilan Bahan Baku', '0', '1', 'C', false);

$pdf->Cell(0, 5,  'Periode ' . date('d-m-Y', strtotime($tglmin)) . " S/d " . date('d-m-Y', strtotime($tglmax)), '0', '1', 'C', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 30, 40, 40,  20));

$pdf->SetLineHeight(6);
$pdf->Cell(25, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Pengambilan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Karyawan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(20, 6, 'Jumlah', 1, 1, 'C');


$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(25, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        date('d-m-Y H:i', strtotime($item['tgl_pengambilan'])),
        $item['nm_karyawan'],
        $item['nm_bk'],
        $item['jumlah'],
    ));
    $no++;
    $pdf->Cell(25, 6, '', 0, 0, 'C');
}

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(118, 6, 'Total Pengambilan Bahan', 1, 0, 'C');
$hasil = mysqli_fetch_assoc($query1);
$pdf->Cell(20, 6, $hasil['total'], 1, 1, 'L');


$pdf->Output("Laporan Pengambilan Bahan Baku.pdf", "I");
