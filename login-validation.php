<?php
session_start();
require 'DbConnect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['UsernameOrEmail'];
    $password = $_POST['Password'];
    $hashedPassword = md5($password);
    $conn = connectDB();

    // Check against 'Drivers' table
    $driverStmt = $conn->prepare("SELECT * FROM Drivers WHERE (Username = ? OR Email = ?) AND Password = ? AND AccountStatus = 'ACTIVE'");
    $driverStmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $hashedPassword);
    $driverStmt->execute();
    $driverResult = $driverStmt->get_result();

    if ($driverResult->num_rows === 1) {
        $row = $driverResult->fetch_assoc();
        $_SESSION['username'] = $row["Username"];
        // Valid login for driver, redirect to driver page
        header('Location: /driver/home.php');
    } elseif ($driverResult->num_rows === 0) {
        // Check against 'Passengers' table
        $passengerStmt = $conn->prepare("SELECT * FROM Passengers WHERE (Username = ? OR Email = ?) AND Password = ? AND AccountStatus = 'ACTIVE'");
        $passengerStmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $hashedPassword);
        $passengerStmt->execute();

        $passengerResult = $passengerStmt->get_result();
        if ($passengerResult->num_rows === 1) {
            $row = $passengerResult->fetch_assoc();
            $_SESSION['username'] = $row["Username"];
            // Valid login for passenger, redirect to passenger page
            header('Location: passenger-home.php');
        }
    } else {
        // Invalid login, redirect to login page with error message
        header ('Location: login.html?error=Invalid credentials');
        // echo '<script>alert("Invalid credentials");</script>';
    }


    // // Check against 'Passengers' table
    // $passengerStmt = $conn->prepare("SELECT * FROM Passengers WHERE (Username = ? OR Email = ?) AND Password = ? AND AccountStatus = 'ACTIVE'");
    // $passengerStmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $hashedPassword);
    // $passengerStmt->execute();

    // $passengerResult = $passengerStmt->get_result();

    // if ($driverResult->num_rows === 1) {
    //     // Valid login for driver, redirect to driver page
    //     header('Location: driver.html');
    // } elseif ($passengerResult->num_rows === 1) {
    //     // Valid login for passenger, redirect to passenger page
    //     header('Location: passenger.html');
    // } else {
    //     // Invalid login, redirect to login page with error message
    //     header('Location: login.html?error=Invalid credentials');
    //     // echo '<script>alert("Invalid credentials");</script>';

    // }

    $driverStmt->close();
    $passengerStmt->close();
    closeDB($conn);
}
