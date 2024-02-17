<?php
include 'DbConnect.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract data from the request
    $driverID = $data['driverID'];

    // Update the driver's account status to 'REJECTED' in the database
    $conn = connectDB();

    $updateQuery = "UPDATE Drivers SET AccountStatus = 'DISABLED' WHERE DriverID = $driverID";
    $conn->query($updateQuery);
    closeDB($conn);
    // Prepare the response
    $response = array('success' => true, 'message' => 'Driver account has been enabled.');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
