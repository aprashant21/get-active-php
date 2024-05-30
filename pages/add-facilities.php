<?php include "../includes/sidebar.php" ?>

<?php if ($_SESSION['user_type'] == 'client'): ?>
<style>
    .container-tool {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto !important;
        background-color: #f4f4f4;
        color: black;
    }
    .form-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 600px;
        margin-top: 6rem;
    }
    .form-box h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-box .input-field {
        margin-bottom: 15px;
    }
    .form-box .input-field label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-box .input-field input,
    .form-box .input-field textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-box .input-field input[type="file"] {
        padding: 3px;
    }
    .form-box .input-field select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-box .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .form-box .submit-btn:hover {
        background-color: #0056b3;
    }
</style>


<div class="container-tool">
    <div class="form-box">
        <h2>Add Facilities</h2>
        <form action="../controllers/facilitiesController.php" method="post" enctype="multipart/form-data">
            <div class="input-field">
                <label for="title">Facility Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="input-field">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="input-field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="input-field">
                <label for="date_time">Date and Time</label>
                <input type="datetime-local" id="date_time" name="date_time" required>
            </div>
            <div class="input-field">
                <label for="participants">Total Number of Participants Allowed</label>
                <input type="number" id="participants" name="participants" required>
            </div>
            <div class="input-field">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button type="submit" class="submit-btn">Add Tool</button>
        </form>
    </div>
</div>
    <script>
        // Get the current date and time
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1).toString().padStart(2, '0');
        var day = now.getDate().toString().padStart(2, '0');
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');

        // Set the minimum value for the datetime-local input
        var minDatetime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        document.getElementById('date_time').min = minDatetime;
    </script>
<?php endif ?>