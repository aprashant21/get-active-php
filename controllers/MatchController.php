<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';

// Example function to get all matches
function get_all_matches() {
    global $conn;
    $sql = "SELECT * FROM matches";
    return $conn->query($sql);
}

// Other match-related functions...
