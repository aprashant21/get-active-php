<?php
session_start();
include "../includes/db.php";

if ($_SESSION['user_type'] != 'admin') {
    $_SESSION['error_message'] = "Access denied. You must be an admin to view this page.";
    header("Location: ../pages/dashboard.php");
    exit();
}

if(isset($_POST['selected_year'])) {
    $selectedYear = $_POST['selected_year'];

    $sql = "SELECT * FROM facility WHERE YEAR(date_time) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $selectedYear);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize PHPExcel
    require_once '../libraries/PHPExcel/Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();

    // Set properties
    $objPHPExcel->getProperties()->setCreator("Your Name")
        ->setLastModifiedBy("Your Name")
        ->setTitle("Facility Report")
        ->setSubject("Facility Report")
        ->setDescription("Facility report for the year ".$selectedYear)
        ->setKeywords("facility report")
        ->setCategory("Report");

    // Add data to the Excel sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Date & Time');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Address');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Participants');

    $rowNumber = 2; // Start from row 2 to avoid overwriting headers
    while ($row = $result->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, $row['date_time']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowNumber, $row['title']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowNumber, $row['address']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowNumber, $row['participants']);
        $rowNumber++;
    }

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="facility_report_'.$selectedYear.'.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit();
} else {
    $_SESSION['error_message'] = "Year parameter is not provided.";
    header("Location: ../pages/matches.php");
    exit();
}
?>
