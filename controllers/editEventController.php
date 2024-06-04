<?php
session_start();
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $max_participants = $_POST['max_participants'];
    $facility_id = $_POST['facility_id'];


    // Check if the user is the creator of the event
    $sql_check_creator = "SELECT created_by FROM client_events WHERE id = ?";
    $stmt_check_creator = $conn->prepare($sql_check_creator);
    $stmt_check_creator->bind_param("i", $event_id);
    $stmt_check_creator->execute();
    $result_check_creator = $stmt_check_creator->get_result();

    if ($result_check_creator->num_rows == 0 || $result_check_creator->fetch_assoc()['created_by'] != $_SESSION['user_id']) {
        $_SESSION['error_message'] = "You don't have permission to edit this event.";
        header("Location: ../pages/events_list.php");
        exit();
    }

    // Handle image upload
    if ($_FILES['image']['name']) {
        $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        error_log("New image uploaded: " . substr($image, 0, 30) . "...");
    } else {
        $sql_image = "SELECT image FROM client_events WHERE id = ?";
        $stmt_image = $conn->prepare($sql_image);
        $stmt_image->bind_param("i", $event_id);
        $stmt_image->execute();
        $result_image = $stmt_image->get_result();

        if ($result_image->num_rows == 1) {
            $event = $result_image->fetch_assoc();
            $image = $event['image'];
            error_log("Using existing image: " . substr($image, 0, 30) . "...");
        } else {
            $_SESSION['error_message'] = "Event not found.";
            header("Location: ../pages/events_list.php");
            exit();
        }
    }

    // Update event in the database
    $sql = "UPDATE client_events SET  event_name=?, event_description=?, event_date=?, max_participants=?, facility_id=?, location=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("SQL Prepare Error: " . $conn->error);
        echo "SQL Prepare Error: " . $conn->error;
        exit();
    }

    error_log("Binding parameters...");
    if (!$stmt->bind_param("sssisiis", $event_name, $event_description, $event_date, $max_participants, $facility_id, $location, $image, $event_id)) {
        error_log("SQL Bind Param Error: " . $stmt->error);
        echo "SQL Bind Param Error: " . $stmt->error;
        exit();
    }

    error_log("Executing statement...");
    if ($stmt->execute()) {
        error_log("Event updated successfully.");
        $_SESSION['success_message'] = "Event updated successfully.";
        header("Location: ../pages/events_list.php");
        exit();
    } else {
        error_log("SQL Execute Error: " . $stmt->error);
        echo "SQL Execute Error: " . $stmt->error;
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../pages/events_list.php");
    exit();
}
?>
