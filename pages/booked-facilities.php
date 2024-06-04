<?php include "../includes/sidebar.php"; ?>

<style>
    .booked-facilities-page {
        margin-top: 100px;
    }

    .booked-facilities-page h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #181313;
        font-weight: bold;
    }

    .w3-table {
        width: 100%;
        border-collapse: collapse;
    }

    .w3-table th,
    .w3-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .w3-table th {
        background-color: #171515;
        font-weight: bold;
    }

    .w3-table tr:nth-child(even) {
        background-color: #342929;
    }

    .w3-table tr:hover {
        background-color: #5d5050;
    }

    .w3-table-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        background-color: black;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .no-bookings-message {
        text-align: center;
        color: #1f1e1e;
        font-size: 16px;
    }

    .view-participants-btn {
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .view-participants-btn:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .w3-table-container {
            padding: 10px;
        }

        .w3-table th,
        .w3-table td {
            padding: 8px;
        }
    }
</style>

<?php if ($_SESSION['user_type'] == 'client'): ?>
    <div class="w3-content" style="margin-top: 100px;">
        <h2>Your Booked Facilities</h2>
        <?php
        // Get the logged-in user's ID
        $user_id = $_SESSION['user_id'];

        // Query to get booked facilities created by the logged-in user
        $sql = "
        SELECT 
            f.id,
            f.title, 
            f.description, 
            f.address, 
            f.date_time, 
            f.participants,
            b.booking_date
        FROM 
            bookings b
        JOIN 
            facility f ON b.facility_id = f.id
        WHERE 
            f.created_by = ?
        ORDER BY 
            b.booking_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <?php if ($result->num_rows > 0): ?>
            <div class="w3-table-container">
                <table class="w3-table w3-bordered w3-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Date & Time</th>
                        <th>Participants</th>
                        <th>Booking Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo date('F j, Y, g:i a', strtotime($row['date_time'])); ?></td>
                            <td><?php echo htmlspecialchars($row['participants']); ?></td>
                            <td><?php echo date('F j, Y, g:i a', strtotime($row['booking_date'])); ?></td>
                            <td>
                                <form action="participant-details.php" method="get">
                                    <input type="hidden" name="facility_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="view-participants-btn">View Participants</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-bookings-message">You don't have any booked facilities yet.</p>
        <?php endif; ?>

        <?php
        $stmt->close();
        $conn->close();
        ?>
    </div>
<?php endif; ?>

<?php include "../includes/footer.php"; ?>
