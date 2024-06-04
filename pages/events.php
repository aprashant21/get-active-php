<?php include "../includes/header.php" ?>

<style>
    .event-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        position: relative;
    }

    .event-card h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 1.5em;
        font-weight: bold;
        color: #1f1e1e;
    }

    .event-card p {
        margin: 0;
        color: #1f1e1e;

    }

    .event-card img {
        width: 100%;
        height:300px;
        max-height: 400px
        border-radius: 8px;
        margin-bottom: 10px;
        object-fit: cover;
    }

    .event-details {
        margin-top: 20px;
    }

    .view-event-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .view-event-btn:hover {
        background-color: #45a049;
    }
</style>

<div class="w3-content container" style="margin-top:100px;">
    <h2 class="w3-center">Upcoming Events</h2>

    <!-- Filter Section -->
    <div class="w3-section">
        <!-- Implement filter options here -->
        <!-- Example: Date range, location, etc. -->
    </div>

    <!-- Event Listing Section -->
    <div class="w3-section">
        <?php
        // Query to retrieve upcoming events
        $sql = "SELECT * FROM client_events WHERE event_date > NOW() ORDER BY event_date ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each event
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event-card'>";
                echo "<h3>" . $row['event_name'] . "</h3>";
                echo "<img src='data:image/jpeg;base64," . $row['image'] . "' alt='Event Image'>";
                echo "<div class='event-details'>";
                echo "<p>Date: " . $row['event_date'] . "</p>";
                echo "<p>Description: " . $row['event_description'] . "</p>";
                echo "</div>";
                echo "<a href='view-event.php?id=" . $row['id'] . "' class='view-event-btn'>View Event</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No upcoming events found.</p>";
        }
        ?>
    </div>
</div>

<?php include "../includes/footer.php" ?>
