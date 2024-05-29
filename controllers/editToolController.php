<?php
session_start();
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$tool_id = $_POST['tool_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$date_time = $_POST['date_time'];
$participants = $_POST['participants'];
$address = $_POST['address'];

// Check if a new image file is uploaded
if ($_FILES['new_image']['name']) {
// Process the new image file and convert it to base64 format
$image = base64_encode(file_get_contents($_FILES['new_image']['tmp_name']));
} else {
// Retrieve the existing image from the database
$sql_image = "SELECT image FROM tools WHERE id = ?";
    $stmt_image = $conn->prepare($sql_image);
$stmt_image->bind_param("i", $tool_id);
$stmt_image->execute();
$result_image = $stmt_image->get_result();

if ($result_image->num_rows == 1) {
$tool = $result_image->fetch_assoc();
$image = $tool['image'];
} else {
// Redirect if tool with the given ID is not found
$_SESSION['error_message'] = "Tool not found.";
header("Location: ../pages/tools.php");
exit();
}
}

// Update the tool details in the database
$sql = "UPDATE tools SET title=?, description=?, date_time=?, participants=?, address=?, image=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiiss", $title, $description, $date_time, $participants, $address, $image, $tool_id);

if ($stmt->execute()) {
$_SESSION['success_message'] = "Tool updated successfully.";
header("Location: ../pages/tools.php");
exit();
} else {
// Debugging: Print error message and SQL statement for debugging
echo "Error: " . $stmt->error;
echo "SQL: " . $sql;
exit();

// $_SESSION['error_message'] = "Error updating tool: " . $stmt->error;
// header("Location: ../pages/edit_tools.php?id=$tool_id");
// exit();
}

$stmt->close();
} else {
header("Location: ../pages/tools.php");
exit();
}
