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

$query  = mysqli_query($db, "SELECT bahan_baku.*,suplier.nm_suply FROM bahan_baku JOIN suplier ON bahan_baku.kd_suply=suplier.kd_suply");


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Ketersediaan Bahan Baku', '0', '1', 'C', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 25, 40, 40,  20));

$pdf->SetLineHeight(6);
$pdf->Cell(25, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(25, 6, 'KD Bahan Baku', 1, 0, 'C');
$pdf->Cell(40, 6, 'Suplier', 1, 0, 'C');
$pdf->Cell(40, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(20, 6, 'Stok', 1, 1, 'C');


$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(25, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['kd_bk'],
        $item['nm_suply'],
        $item['nm_bk'],
        $item['stok'],
    ));
    $no++;
    $pdf->Cell(25, 6, '', 0, 0, 'C');
}

$pdf->Output("Laporan Bahan Baku.pdf", "I");
