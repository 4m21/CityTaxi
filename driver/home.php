<?php
session_start();
include '../DbConnect.php';
$username = $_SESSION['username'];
$conn = connectDB();
$user_info_sql = "SELECT * FROM drivers WHERE username = '$username'";
$result = $conn->query($user_info_sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $LastName = $row['LastName'];
    $_SESSION['DriverID'] = $row['DriverID'];
} else {
    $LastName = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="index.css">
    <!-- Boostrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font-Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo2ATVL4w-PeF4HKW8gnQG2XMMOUjr5-0&libraries=places" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="driver-body">
        <nav>
            <div class="container nav_container">
                <div class="nav_left">
                    <a href="home.html">
                        <img src="../imgs/City.png" alt="Book a Taxi">
                    </a>

                    <div class="nav-manu">
                        <!-- <a href="../passenger-home.php">Ride</a>
                        <a href="home.html">Drive</a> -->
                        <div class="animation start-home">
                        </div>
                    </div>
                </div>

                <ul class="nav_profile">
                    <li class="profile-img">
                        <img src="../imgs/profile_img.png" alt="My Profile">
                        <i class="fa-solid fa-angle-down"></i>
                    </li>
                </ul>

            </div>
        </nav>


        <header>
            <h1>Welcome, <span><?php echo $LastName; ?> </span></h1>
        </header>

        <main>
            <div class="sections">
                <section class="driver-details" id="status-section">
                    <h2>Driver Status</h2>
                    <p>Status: <span id="status"></span></p>
                    <button type="button" id="toggleStatus" class="btn btn-outline-success">Toggle Status</button>
                </section>

                <section class="driver-details" id="working-hours-section">
                    <h2>Update Working Hours</h2>
                    <label for="working_hours">Working Hours:</label>
                    <input type="text" id="working_hours" name="working_hours">
                    <button type="button" class="btn btn-outline-success" onclick="updateWorkingHours()">Update Hours</button>
                </section>

                <section class="driver-details" id="recent-trips-section">
                    <h2>Recent Trips</h2>
                    <ul id="recentTrips">
                        <!-- Dynamic content for recent trips will be added here -->
                    </ul>
                </section>

                <!-- <section id="account-info-section">
                    <h2>Account Information</h2>
                    <ul id="accountInfo">
                        Dynamic content for account information will be added here
                    </ul>
                </section> -->
            </div>
        </main>

        <section id="map">
            <!-- Google Maps or any other mapping solution goes here -->
        </section>
    </div>

    <a href="add_vehicle.php">Add Vehicle</a>
    <script src="driver_dashboard.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch initial status when the page loads
            $.ajax({
                url: 'getStatus.php',
                type: 'POST',
                data: {
                    username: '<?php echo $username; ?>',
                },
                success: function(response) {
                    $('#status').text(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            // Handle click event of the toggle button
            $('#toggleStatus').click(function() {
                $.ajax({
                    url: 'update_Status.php',
                    type: 'POST',
                    data: {
                        username: '<?php echo $username; ?>',
                    },
                    success: function(response) {
                        $('#status').text(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

</body>

</html>