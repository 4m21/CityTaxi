<?php
session_start();
include '../DbConnect.php';

$username = $_POST['username'];
$status = getStatus($username);
echo $status;

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
