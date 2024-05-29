<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Example function to get all sports centers
function get_all_sports_centers() {
    global $conn;
    $sql = "SELECT * FROM sports_centers";
    return $conn->query($sql);
}

// Other sports center-related functions...
