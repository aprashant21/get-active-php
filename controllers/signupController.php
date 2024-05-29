<?php
session_start(); // Start the session
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, address, email, type, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $address, $email, $type, $password);

    if ($stmt->execute()) {

        // Set success message in session
        $_SESSION['success_message'] = "Registration successful! Please log in.";

        // Redirect to login page
        header("Location: ../pages/login.php");
        exit(); // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
