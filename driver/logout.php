//logout session
<?php
session_start();
include '../DbConnect.php';
$conn = connectDB();
$username = $_SESSION['username'];
//set driver status to offline
$sql = "UPDATE drivers SET Availability = 'OFFLINE' WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->close();
closeDB($conn);


// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header("Location: ../index.html");
exit();
?>