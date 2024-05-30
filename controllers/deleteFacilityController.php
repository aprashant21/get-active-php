<?php
session_start();
include "../includes/db.php";

if (isset($_GET['id'])) {
    $facilityId = $_GET['id'];

    $sql = "DELETE FROM facility WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $facilityId);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Facility deleted successfully!";
    } else {
        // Error occurred while deleting the tool
        $_SESSION['error_message'] = "Error occurred while deleting the facility: " . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Facility ID is not provided.";
}

header("Location: ../pages/facilities_list.php");
exit();
?>
