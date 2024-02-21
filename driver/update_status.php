<?php
session_start();
include '../DbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    $conn = connectDB();
    // Assuming the table name is 'drivers' and the status column is 'status'
    // Toggle the status between 'Available' and 'Busy'
    $sql = "UPDATE drivers SET Availability = CASE WHEN Availability = 'AVAILABLE' THEN 'BUSY' ELSE 'AVAILABLE' END WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->close();
    closeDB($conn);

    // Return the updated status
    $status = getStatus($username);
    echo $status;
} else {
    echo 'Invalid request method';
}

function getStatus($username)
{
    $conn = connectDB();
    $sql = "SELECT Availability FROM drivers WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();
    closeDB($conn);

    return $status;
}
