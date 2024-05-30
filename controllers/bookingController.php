<?php
session_start();
include "../includes/db.php";

if (isset($_GET['id'])) {
    $facility_id = $_GET['id'];

    // Check if the user is a member
    $user_id = $_SESSION['user_id'];
    $sql_check_membership = "SELECT is_member FROM users WHERE id = ?";
    $stmt_check_membership = $conn->prepare($sql_check_membership);
    $stmt_check_membership->bind_param("i", $user_id);
    $stmt_check_membership->execute();
    $result_check_membership = $stmt_check_membership->get_result();
    $user = $result_check_membership->fetch_assoc();

    // If the user is not a member, display error message
    if (!$user['is_member']) {
        $_SESSION['error_message'] = "You must become a member to book a facility. Go to your profile and become a member.";
        header("Location: ../pages/profile.php");
        exit();
    }

    // Check if the user has already booked the facility
    $sql_check_booking = "SELECT * FROM bookings WHERE user_id = ? AND facility_id = ?";
    $stmt_check_booking = $conn->prepare($sql_check_booking);
    $stmt_check_booking->bind_param("ii", $user_id, $facility_id);
    $stmt_check_booking->execute();
    $result_check_booking = $stmt_check_booking->get_result();

    // If the user has already booked the facility, display "Booked" text
    if ($result_check_booking->num_rows > 0) {
        echo "<p>Booked</p>";
        exit(); // Exit to prevent further execution
    }

    // If the user is a member and has not booked the facility, display the book button
    echo '<form action="../controllers/bookingController.php" method="post">';
    echo '<input type="hidden" name="facility_id" value="' . $facility_id . '">';
    echo '<button type="submit" class="book-btn">Book Facility</button>';
    echo '</form>';
} else {
    header("Location: facilities.php");
    exit();
}
?>
