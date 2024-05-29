
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

<?php
include "../includes/sidebar.php";

// Check if the tool ID is provided in the URL
if(isset($_GET['id'])) {
    $tool_id = $_GET['id'];

    // Retrieve tool details from the database using the tool ID
    $sql = "SELECT * FROM tools WHERE id = $tool_id";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $tool = $result->fetch_assoc();
    } else {
        // Redirect if tool with the given ID is not found
        header("Location: tools_list.php");
        exit();
    }
} else {
    // Redirect if tool ID is not provided in the URL
    header("Location: tools_list.php");
    exit();
}
?>


<div class="container-tool">
    <div class="form-box">
        <h2>Edit Tool</h2>
        <form action="../controllers/editToolController.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tool_id" value="<?php echo $tool['id']; ?>">
            <div class="input-field">
                <label for="title">Tool Title</label>
                <input type="text" id="title" name="title" value="<?php echo $tool['title']; ?>" required>
            </div>
            <div class="input-field">
                <label for="image">Current Image</label>
                <img src="data:image/jpeg;base64,<?php echo $tool['image']; ?>" alt="Tool Image" style="max-width: 200px; object-fit: cover;">
            </div>
            <div class="input-field">
                <label for="new_image">New Image</label>
                <input type="file" id="new_image" name="new_image" accept="image/*">
            </div>
            <div class="input-field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo $tool['description']; ?></textarea>
            </div>
            <div class="input-field">
                <label for="date_time">Date and Time</label>
                <input type="datetime-local" id="date_time" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($tool['date_time'])); ?>" required>
            </div>
            <div class="input-field">
                <label for="participants">Total Number of Participants Allowed</label>
                <input type="number" id="participants" name="participants" value="<?php echo $tool['participants']; ?>" required>
            </div>
            <div class="input-field">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $tool['address']; ?>" required>
            </div>
            <button type="submit" class="submit-btn">Update Tool</button>
        </form>
    </div>
</div>