
<?php include "../includes/header.php"; ?>

<style>
    .facility-details-page {
        margin-top: 100px;
    }
    .facility-details-page header {
        text-align: center;
        margin-bottom: 20px;
        background-color: rgb(48 96 5 / 80%)
    }
    .facility-details-page header h1 {
        color: #ffffff;
    }
    .facility-details {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .facility-details img {
        width: 100%;
        max-width: 600px;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .facility-details h2, .facility-details p {
        color: #483e3e;
        text-align: left;
        margin-bottom: 10px;
    }
    .book-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        text-decoration: none;
    }
    .book-btn:hover {
        background-color: #0056b3;
    }
</style>

<?php


if(isset($_GET['id'])) {
    $facility_id = $_GET['id'];

    $sql = "SELECT * FROM facility WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $facility_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user has already booked the facility
    $user_id = $_SESSION['user_id'];
    $sql_check_booking = "SELECT * FROM bookings WHERE user_id = ? AND facility_id = ?";
    $stmt_check_booking = $conn->prepare($sql_check_booking);
    $stmt_check_booking->bind_param("ii", $user_id, $facility_id);
    $stmt_check_booking->execute();
    $result_check_booking = $stmt_check_booking->get_result();

    if($result->num_rows > 0) {
        $facility = $result->fetch_assoc();
    } else {
        $_SESSION['error_message'] = "Facility not found.";
        header("Location: facilities_list.php");
        exit();
    }
} else {
    header("Location: facilities_list.php");
    exit();
}
?>

<div class="facility-details-page w3-content">
    <header>
        <h1><?php echo $facility['title']; ?></h1>
    </header>

    <div class="facility-details">
        <img src="data:image/jpeg;base64,<?php echo $facility['image']; ?>" alt="Facility Image">
        <h2>Description</h2>
        <p><?php echo $facility['description']; ?></p>
        <h2>Location</h2>
        <p><?php echo $facility['address']; ?></p>
        <h2>Date & Time</h2>
        <p><?php echo date('F j, Y, g:i a', strtotime($facility['date_time'])); ?></p>
        <h2>Participants</h2>
        <p><?php echo $facility['participants']; ?></p>
        <?php if ($result_check_booking->num_rows > 0): ?>
            <h2 style="color:red; font-weight: bold;">Booked</h2>
        <?php else: ?>
            <a href="../controllers/bookingController.php?id=<?php echo $facility['id']; ?>" class="book-btn">Book Facility</a>
        <?php endif; ?>
    </div>
</div>

<?php include "../includes/footer.php"; ?>