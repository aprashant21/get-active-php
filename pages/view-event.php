<?php include "../includes/header.php" ?>

<style>
    .event-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .event-card h2 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 2em;
        font-weight: bold;
        color: #1f1e1e;
    }

    .event-card p {
        margin: 0;
        color: #1f1e1e;
    }

    .event-card img {
        width: 100%;
        height: 400px;
        max-height: 400px;
        border-radius: 8px;
        margin-bottom: 10px;
        object-fit: cover;
    }

    .event-details {
        margin-top: 20px;
    }

    .book-event-btn {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .book-event-btn:hover {
        background-color: #45a049;
    }
</style>

<div class="w3-content container" style="margin-top:100px;">
    <?php
    // Check if the event ID is provided in the URL
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];

        // Query to retrieve the event details
        $sql = "SELECT * FROM client_events WHERE id = $eventId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <div class="event-card">
                <h2><?php echo $row['event_name']; ?></h2>
                <img src="data:image/jpeg;base64,<?php echo $row['image']; ?>" alt="Event Image">
                <div class="event-details">
                    <p>Date: <?php echo $row['event_date']; ?></p>
                    <p>Description: <?php echo $row['event_description']; ?></p>
                    <p>Location: <?php echo $row['location']; ?></p>
                    <p>Time: <?php echo $row['event_date']; ?></p>
                </div>
                <a href="#" class="book-event-btn">Book Event</a>
            </div>
            <?php
        } else {
            echo "<p>Event not found.</p>";
        }
    } else {
        echo "<p>No event ID provided.</p>";
    }
    ?>
</div>

<?php include "../includes/footer.php" ?>
