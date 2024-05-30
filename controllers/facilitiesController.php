<?php
session_start(); // Start the session
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_time = $_POST['date_time'];
    $participants = $_POST['participants'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $distance = $_POST['distance'];

    // Convert the image to a Base64 string
    $image_base64 = '';
    if ($_FILES['image']['error'] === 0) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_data = file_get_contents($image_tmp);
        $image_base64 = base64_encode($image_data);
    } else {
        $_SESSION['error_message'] = "Image upload failed.";
        header("Location: ../pages/add-facilities.php");
        exit();
    }

    // Get the user ID from the session
    $created_by = $_SESSION['user_id'];

    // Insert the facility into the database
    $sql = "INSERT INTO facility (title, description, date_time, participants, address, created_by, image, category, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissssi", $title, $description, $date_time, $participants, $address, $created_by, $image_base64, $category, $distance);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Facility added successfully!";
        header("Location: ../pages/add-facilities.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
        header("Location: ../pages/add-facilities.php");
        exit();
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the add facility page if accessed directly without a POST request
    header("Location: ../pages/add-facilities.php");
    exit();
}
?>