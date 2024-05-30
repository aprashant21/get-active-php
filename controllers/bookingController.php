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
    } else {
        // User is a member, proceed with booking the facility
        // Check if the facility has more than 0 participants
        $sql_check_participants = "SELECT participants FROM facility WHERE id = ?";
        $stmt_check_participants = $conn->prepare($sql_check_participants);
        $stmt_check_participants->bind_param("i", $facility_id);
        $stmt_check_participants->execute();
        $result_check_participants = $stmt_check_participants->get_result();
        $facility = $result_check_participants->fetch_assoc();

        if ($facility['participants'] <= 0) {
            $_SESSION['error_message'] = "This facility cannot be booked as it has 0 participants.";
            header("Location: ../pages/facility-details.php?id=$facility_id");
            exit();
        }

        // Construct the INSERT statement to insert the booking into the bookings table
        $sql_insert_booking = "INSERT INTO bookings (user_id, facility_id) VALUES (?, ?)";
        $stmt_insert_booking = $conn->prepare($sql_insert_booking);
        $stmt_insert_booking->bind_param("ii", $user_id, $facility_id);

        // Execute the INSERT statement
        if ($stmt_insert_booking->execute()) {
            // Update participants count in the facility table
            $sql_update_participants = "UPDATE facility SET participants = participants - 1 WHERE id = ?";
            $stmt_update_participants = $conn->prepare($sql_update_participants);
            $stmt_update_participants->bind_param("i", $facility_id);
            $stmt_update_participants->execute();

            // Booking and participants update successful
            $_SESSION['success_message'] = "Facility booked successfully.";
            header("Location: ../pages/facility-details.php?id=$facility_id");
            exit();
        } else {
            // Error occurred while inserting the booking
            $_SESSION['error_message'] = "Error booking facility: " . $stmt_insert_booking->error;
            header("Location: ../pages/facility-details.php?id=$facility_id");
            exit();
        }
    }

} else {
    header("Location: facilities.php");
    exit();
}
?>
