<?php
session_start();
include '../DbConnect.php';
$DriverID = $_SESSION['DriverID'];
$vehicleModel = $vehicleNumber = '';
$conn = connectDB();
$isVehicleRegistered = false;

// Check if driver ID exists in the vehicles table
$stmt = $conn->prepare('SELECT * FROM vehicles WHERE DriverID = ?');
$stmt->bind_param('i', $DriverID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    // Driver ID exists, retrieve the existing vehicle data
    $vehicleData = $result->fetch_assoc();
    $vehicleModel = $vehicleData['Model'];
    $vehicleNumber = $vehicleData['VehicleNumber'];
    $isVehicleRegistered = true;
}

$message = ''; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming driverID is stored in a session variable named 'DriverID'

    $conn = connectDB();

    // Retrieve the form submission data
    $model = $_POST['model'];
    $vehicleNumber = $_POST['vehicleNumber'];

    if ($isVehicleRegistered) {
        // Driver ID exists, update the existing record
        $stmt = $conn->prepare('UPDATE vehicles SET Model = ?, VehicleNumber = ? WHERE DriverID = ?');
        $stmt->bind_param('ssi', $model, $vehicleNumber, $DriverID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = 'Vehicle updated successfully.';
        } else {
            $message = 'Failed to update vehicle.';
        }
        $stmt->close();
    } else {
        // Driver ID does not exist, insert a new record
        $stmt = $conn->prepare('INSERT INTO vehicles (DriverID, Model, VehicleNumber) VALUES (?, ?, ?)');
        $stmt->bind_param('iss', $DriverID, $model, $vehicleNumber);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = 'Vehicle added successfully.';
        } else {
            $message = 'Failed to add vehicle.';
        }
        $stmt->close();
    }

    closeDB($conn);

    // Redirect to a different page to avoid form resubmission
    header('Location: success.php');
    exit(); // Make sure to exit after the redirect
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
</head>

<body>
    <h2>Add Vehicle</h2>
    <?php echo $message; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="model">Model:</label><br>
        <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($vehicleModel); ?>" required><br>

        <label for="vehicleNumber">Vehicle Number:</label><br>
        <input type="text" id="vehicleNumber" name="vehicleNumber" value="<?php echo htmlspecialchars($vehicleNumber); ?>" required><br><br>

        <button type="submit">Add Vehicle</button>
    </form>


    <?php
    // Debugging statement moved inside the POST condition block
    foreach ($_SESSION as $key => $value) {
        echo "Session variable: $key, Value: $value <br>";
    }
    ?>

</body>

</html>