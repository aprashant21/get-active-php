<?php include "../includes/header.php" ?>

<style>
    /* General Styles */

    .facilities-page{
        margin-top: 100px;
    }

    .facilities-page header h1, h2 {
        color: white;
    }
    .facilities-page header p {
        color: white;
    }

    .facilities-page h1, h2 {
        color: #483e3e;
    }
    .facilities-page p {
        color: #483e3e;
    }

    /* Header Styles */
    .facilities-page header {
        text-align: center;
        margin-bottom: 20px;
    }

    .facilities-page header img {
        height: 61px;
        width: 100px;
        object-fit: cover;
    }

    /* Search and Filter Styles */
    .facilities-page .search-filter {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .facilities-page .search-filter input[type="text"] {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    .search-filter .filters select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    /* Facilities List Styles */
    .facilities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .facility {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        width: calc(33.333% - 20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .facility img {
        width: 100%;
        height: 200px;
        max-height: 200px;
        object-fit: cover;
    }

    .facility-info {
        padding: 15px;
    }

    .facility-info h2 {
        font-size: 20px;
        margin: 0 0 10px;
    }

    .facility-info p {
        margin: 5px 0;
    }

    .facility-info .view-details {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        text-decoration: none;
    }

    .facility-info .view-details:hover {
        background-color: #0056b3;
    }

    /* Interactive Map Styles */
    .interactive-map {
        margin: 40px 0;
        height: 400px;
        background-color: #e0e0e0;
    }

    /* Call to Action Styles */
    .call-to-action {
        text-align: center;
        margin: 40px 0;
    }

    .call-to-action p {
        font-size: 18px;
    }

    .call-to-action a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .call-to-action a:hover {
        color: #0056b3;
    }

    /* FAQ Styles */
    .faqs {
        margin: 40px 0;
    }

    .faqs h2 {
        margin-bottom: 20px;
    }

    .faqs p {
        margin-bottom: 10px;
    }

    /* Contact and Support Styles */
    .contact-support {
        margin: 40px 0;
        text-align: center;
    }

    .contact-support h2 {
        margin-bottom: 20px;
    }

    .contact-support p {
        margin-bottom: 20px;
    }

    .contact-support form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .contact-support form input,
    .contact-support form textarea {
        width: 100%;
        max-width: 500px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .contact-support form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .contact-support form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .facilities-list {
            flex-direction: column;
        }

        .facility {
            width: 100%;
        }

        .search-filter {
            flex-direction: column;
        }

        .search-filter input[type="text"] {
            margin-bottom: 10px;
        }

        .search-filter .filters {
            display: flex;
            flex-direction: column;
        }

        .search-filter .filters select {
            margin-bottom: 10px;
        }
    }

</style>

<?php

$currentDateTime = date('Y-m-d H:i:s');

$sql = "SELECT * FROM facility WHERE date_time >= ? AND participants > 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentDateTime);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="facilities-page w3-content">
    <header>
        <h1>Explore Our Sports Facilities</h1>
        <p>Find the perfect place to play your favorite sports, meet new people, and get active!</p>
    </header>

    <div class="search-filter">
        <input type="text" placeholder="Search by facility name or location...">
        <div class="filters">
            <select>
                <option value="">All Sports</option>
                <option value="tennis">Tennis</option>
                <option value="basketball">Basketball</option>
                <option value="swimming">Swimming</option>
            </select>
            <select>
                <option value="">Any Distance</option>
                <option value="5">Within 5 miles</option>
                <option value="10">Within 10 miles</option>
            </select>
        </div>
    </div>

    <div class="facilities-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="facility">
                    <img src="data:image/jpeg;base64,<?php echo $row['image'] ?>" alt="Facility Image">
                    <div class="facility-info">
                        <h2><?php echo $row['title']; ?></h2>
                        <p><?php echo $row['description']; ?></p>
                        <p>Location: <?php echo $row['address']; ?></p>
                        <p>Date & Time: <?php echo $row['date_time']; ?></p>
                        <a href="facility-details.php?id=<?php echo $row['id']; ?>" class="view-details">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No facilities found.</p>
        <?php endif; ?>
    </div>

    <div class="interactive-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19868.55094108211!2d-0.1083375393692135!3d51.50277869595815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876035a26b7f145%3A0xd1c47a2b70881ec2!2sSouthwark%2C%20London%20SE1%203SS%2C%20UK!5e0!3m2!1sen!2snp!4v1717035101291!5m2!1sen!2snp" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div style="margin-top: 50px;">
        <?php if (!is_logged_in()): ?>
            <div class="call-to-action">
                <p>Ready to join a match? <a href="signup.html">Sign up now!</a></p>
            </div>
        <?php endif;?>

        <div class="faqs">
            <h2>Frequently Asked Questions</h2>
        </div>
    </div>


</div>


<?php include "../includes/footer.php" ?>
