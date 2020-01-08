<?php
include 'koneksi.php';

// include composer packages
include "vendor/autoload.php";

date_default_timezone_set("Asia/Jakarta");
date_default_timezone_get();
$now = date('Y-m-d H:i:s');
$kd_kegiatan = $_GET["kd_kegiatan"];
$kd_anggota = $_GET["kd_anggota"];

$dtl_dok = query("SELECT * FROM dtl_kegiatan INNER JOIN kegiatan ON kegiatan.kd_kegiatan=dtl_kegiatan.kd_kegiatan INNER JOIN anggota ON anggota.kd_anggota=dtl_kegiatan.kd_anggota WHERE dtl_kegiatan.kd_anggota='$kd_anggota' AND status='y' AND dtl_kegiatan.kd_kegiatan='$kd_kegiatan'")[0];

$kd_anggota = $dtl_dok["kd_anggota"];


// Create new Landscape PDF
$pdf = new \setasign\Fpdi\FPDI('l');

// Reference the PDF you want to use (use relative path)
$pagecount = $pdf->setSourceFile( 'doc/SertifikatKegiatan.pdf' );

// Import the first page from the PDF and add to dynamic PDF
$tpl = $pdf->importPage(1);
$pdf->AddPage();

// Use the imported page as the template
$pdf->useTemplate($tpl);

$pdf->AddFont('FuturaBT-Book','','FuturaBT-Book.php');

// Set the default font to use
$pdf->SetFont('FuturaBT-Book');

// adding a Cell using:
// $pdf->Cell( $width, $height, $text, $border, $fill, $align);

// First box - the user's Name
$pdf->SetFontSize('30'); // set font size
$pdf->SetXY(15, 95); // set the position of the box
$pdf->Cell(0, 10, $dtl_dok["nama"], 0, 0, 'C'); // add the text, align to Center of cell

// add the reason for certificate
// note the reduction in font and different box position
$pdf->SetFontSize('14');
$pdf->SetXY(15, 118);
$pdf->Cell(0, 10, $dtl_dok["kegiatan"], 0, 0, 'C');

// the Event date
$pdf->SetFontSize('14');
$pdf->SetXY(15, 132);
$pdf->Cell(0, 10, date('d F Y', strtotime($dtl_dok["tanggal"])), 0, 0, 'C');

// the date
$pdf->SetFontSize('12');
$pdf->SetXY(15, 154);
$pdf->Cell(0, 10, 'Yogyakarta '.date('d F Y'), 0, 0, 'C');


// render PDF to browser
$pdf->Output('I','sertifikat.pdf');


$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dokumen WHERE kd_anggota='$kd_anggota' AND $kd_kegiatan='$kd_kegiatan'"));
    if ($cek == 0){
    mysqli_query($koneksi, "INSERT INTO dokumen(kd_kegiatan, kd_anggota, tanggal_buat) VALUES ('$kd_kegiatan', '$kd_anggota', '$now') ");
    }
