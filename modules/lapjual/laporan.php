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

$query  = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,penjualan.tgl_kirim,pelanggan.nm_plg,det_penjualan.kd_menu,det_penjualan.jumlah,det_penjualan.harga,menu.nama_menu,SUM(det_penjualan.jumlah*det_penjualan.harga) AS sub FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan JOIN menu ON det_penjualan.kd_menu=menu.kd_menu JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan WHERE DATE(penjualan.tgl_jual) BETWEEN '$tglmin' AND '$tglmax' AND penjualan.tipe_jual='Biasa' AND penjualan.status='Dikirim' GROUP BY det_penjualan.kd_menu ORDER BY penjualan.kd_penjualan ASC ");


$query1 = mysqli_query($db, "SELECT penjualan.kd_penjualan,penjualan.tgl_jual,SUM(det_penjualan.jumlah*det_penjualan.harga) AS total FROM penjualan JOIN det_penjualan ON det_penjualan.kd_penjualan=penjualan.kd_penjualan WHERE DATE(penjualan.tgl_jual) BETWEEN '$tglmin' AND '$tglmax' AND penjualan.tipe_jual='Biasa' AND penjualan.status='Dikirim'");

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Penjualan', '0', '1', 'C', false);

$pdf->Cell(0, 5,  'Periode ' . date('d-m-Y', strtotime($tglmin)) . " S/d " . date('d-m-Y', strtotime($tglmax)), '0', '1', 'C', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 30, 30, 30, 30,  20, 10, 15, 15));

$pdf->SetLineHeight(6);
// $pdf->Cell(5, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'ID Penjualan', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Pemesanan', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Kirim', 1, 0, 'C');
$pdf->Cell(30, 6, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(20, 6, 'Menu', 1, 0, 'C');
$pdf->Cell(10, 6, 'Jumlah', 1, 0, 'C');
$pdf->Cell(15, 6, 'Harga', 1, 0, 'C');
$pdf->Cell(15, 6, 'Subtotal', 1, 1, 'C');


$pdf->SetFont('Arial', '', 7);
$no = 1;
// $pdf->Cell(25, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['kd_penjualan'],
        date('d-m-Y H:i', strtotime($item['tgl_jual'])),
        date('d-m-Y H:i', strtotime($item['tgl_kirim'])),
        $item['nm_plg'],
        $item['nama_menu'],
        $item['jumlah'],
        rupiah($item['harga']),
        rupiah($item['sub']),
    ));
    $no++;
    // $pdf->Cell(25, 6, '', 0, 0, 'C');
}
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(158, 6, 'Total', 1, 0, 'C');
$hasil = mysqli_fetch_assoc($query1);
$pdf->Cell(30, 6, rupiah($hasil['total']), 1, 0, 'C');

$pdf->Output("Laporan Penjualan.pdf", "I");
