<?php
require('db_connect.php');
require_once __DIR__ . '/fpdf/fpdf.php';


if (!isset($_POST['bookingID']) || !isset($_POST['phone_report'])) {
    die("Invalid request.");
}

$bookingID = $conn->real_escape_string($_POST['bookingID']);
$phone = $conn->real_escape_string($_POST['phone_report']);

$query = $conn->query("SELECT * FROM lab_bookings WHERE id='$bookingID' AND phone='$phone' LIMIT 1");

if ($query->num_rows == 0) {
    die("❌ No record found with this Booking ID and phone number.");
}

$data = $query->fetch_assoc();

// -------- Generate PDF --------
$pdf = new FPDF();
$pdf->AddPage();

// Header
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'PharmaNest - Lab Test Report', 0, 1, 'C');
$pdf->Ln(10);

// Booking Details
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Booking ID:', 0, 0);
$pdf->Cell(0, 10, $data['id'], 0, 1);

$pdf->Cell(50, 10, 'Patient Name:', 0, 0);
$pdf->Cell(0, 10, $data['full_name'], 0, 1);

$pdf->Cell(50, 10, 'Test Name:', 0, 0);
$pdf->Cell(0, 10, $data['test_name'], 0, 1);

$pdf->Cell(50, 10, 'Phone:', 0, 0);
$pdf->Cell(0, 10, $data['phone'], 0, 1);

$pdf->Cell(50, 10, 'Address:', 0, 0);
$pdf->MultiCell(0, 10, $data['address']);

$pdf->Cell(50, 10, 'Test Date:', 0, 0);
$pdf->Cell(0, 10, $data['test_date'], 0, 1);

$pdf->Cell(50, 10, 'Booking Time:', 0, 0);
$pdf->Cell(0, 10, $data['booking_time'], 0, 1);

$pdf->Ln(15);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(0, 10, 'Your test report will be available soon.', 0, 1, 'C');

$pdf->Output('I', 'Lab_Report_'.$data['id'].'.pdf');
?>
