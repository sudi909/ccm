<?php
require('fpdf/fpdf.php');
require('../../admin/php/koneksi.php');

$idTransaksi = $_POST['idTransaksi'];

$image1 = "../images/pdf/KopSurat.jpg";

$sql = "SELECT * FROM tblTransaksi INNER JOIN tblCustomer ON tblTransaksi.custId = tblCustomer.idCust  WHERE idTransaksi = $idTransaksi";
$query = mysqli_query($con, $sql);
if ($row = mysqli_fetch_array($query)) {
    $kodeTransaksi  = $row['kodeTransaksi'];
    $tglTransaksi   = $row['tglTransaksi'];
    $namaCust       = $row['namaCust'];
    $namaPenerima   = $row['namaPenerima'];
    $alamatPenerima = $row['alamatPenerima'];
    $telPenerima    = $row['telPenerima'];
    $grandTotal     = $row['grandTotal'];
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Image($image1, 5, 0, 200, 30);
$pdf->Ln(30);
$pdf->Cell(42, 5, '', 0, 0);
$pdf->Cell(42, 5, '', 0, 0);
$pdf->Cell(40, 5, 'INVOICE', 0, 1);
$pdf->Ln(10);
$pdf->Cell(55, 5, 'Kode Transaksi', 0, 0);
$pdf->Cell(58, 5, ': ' . $kodeTransaksi, 0, 0);
$pdf->Cell(25, 5, 'Tanggal', 0, 0);
$pdf->Cell(52, 5, ': ' . date("d-m-Y"), 0, 1);
$pdf->Cell(55, 5, 'Nama Customer', 0, 0);
$pdf->Cell(58, 5, ': ' . $namaCust, 0, 0);
$pdf->Line(10, 65, 200, 65);
$pdf->Ln(10);
$pdf->Cell(55, 5, 'Nama Penerima', 0, 0);
$pdf->Cell(58, 5, ': ' . $namaPenerima, 0, 1);
$pdf->Cell(55, 5, 'Tel. Penerima', 0, 0);
$pdf->Cell(58, 5, ': ' . $telPenerima, 0, 1);
$pdf->Cell(55, 5, 'Alamat Penerima', 0, 0);
$pdf->Cell(58, 5, ': ' . $alamatPenerima, 0, 1);
$pdf->Line(10, 95, 200, 95);
$pdf->Ln(10);//Line break
$sql = "SELECT * FROM tblDetailTransaksi INNER JOIN tblBarang ON tblDetailTransaksi.idBrng = tblBarang.idBrng WHERE idTransaksi = $idTransaksi";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
    $pdf->Cell(50, 5, 'Kode Barang', 0, 0);
    $pdf->Cell(50, 5, 'Nama Barang', 0, 0);
    $pdf->Cell(50, 5, 'Kuantitas', 0, 0);
    $pdf->Cell(50, 5, 'Harga Barang', 0, 1);
    $pdf->Cell(50, 5, $row['kodeBrng'], 0, 0);
    $pdf->Cell(50, 5, $row['namaBrng'], 0, 0);
    $pdf->Cell(50, 5, number_format($row['qtyBrng'], 0), 0, 0);
    $pdf->Cell(50, 5, 'Rp. ' . number_format($row['hrgBrng'], 2), 0, 0);
}
$pdf->Ln(30);//Line break
$pdf->Cell(150, 5, 'Total Keseluruhan', 0, 0);
$pdf->Cell(58, 5, 'Rp. ' . number_format($grandTotal, 2), 0, 1);
$pdf->Line(155, 170, 195, 170);
$pdf->Ln(5);//Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Output();
?>