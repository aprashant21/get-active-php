<?php
session_start();
include "../includes/db.php";

if (isset($_GET['id'])) {
    $toolId = $_GET['id'];

    $sql = "DELETE FROM tools WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $toolId);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Tool deleted successfully!";
    } else {
        // Error occurred while deleting the tool
        $_SESSION['error_message'] = "Error occurred while deleting the tool: " . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Tool ID is not provided.";
}

header("Location: ../pages/tools.php");
exit();
?>
