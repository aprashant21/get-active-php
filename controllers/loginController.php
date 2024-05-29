<?php
session_start(); // Start the session
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user from database based on username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables and redirect to dashboard or home page
            $_SESSION['username'] = $username;
            // Redirect to dashboard or home page
            header("Location: dashboard.php");
            exit(); // Stop further execution
        } else {
            // Password is incorrect
            $_SESSION['error_message'] = "Incorrect password. Please try again.";
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "User not found. Please try again.";
        header("Location: ../pages/login.php");
        exit();
    }
} else {
    // Redirect to login page if accessed directly
    header("Location: ../pages/login.php");
    exit();
}
?>
