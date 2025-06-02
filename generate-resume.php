<?php
require_once 'tcpdf/tcpdf.php';

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'N/A';
    $email = $_POST['email'] ?? 'N/A';
    $phone = $_POST['phone'] ?? 'N/A';
    $education = $_POST['education'] ?? 'N/A';
    $experience = $_POST['experience'] ?? 'N/A';
    $skills = $_POST['skills'] ?? 'N/A';
    $summary = $_POST['summary'] ?? 'N/A';

    // Initialize TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($name);
    $pdf->SetTitle('Resume');
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content to PDF
    $pdf->Write(0, strtoupper($name), '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Write(0, "$email | $phone", '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln(10);

    // Profile Picture (if uploaded)
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo']['tmp_name'];
        $pdf->Image($photo, 160, 15, 30, 30, '', '', '', false, 300, '', false, false, 1);
    }

    // Summary
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Write(0, 'Professional Summary', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(0, 0, $summary, 0, 'L', false, 1, '', '', true);
    $pdf->Ln(5);

    // Education
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Write(0, 'Education', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(0, 0, $education, 0, 'L', false, 1, '', '', true);
    $pdf->Ln(5);

    // Experience
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Write(0, 'Work Experience', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(0, 0, $experience, 0, 'L', false, 1, '', '', true);
    $pdf->Ln(5);

    // Skills
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Write(0, 'Skills', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(0, 0, $skills, 0, 'L', false, 1, '', '', true);

    // Output PDF
    $pdf->Output('resume.pdf', 'D');
} else {
    echo "No data received.";
}
?>