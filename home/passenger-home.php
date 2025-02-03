<?php
session_start();
include 'DbConnect.php';
$username = $_SESSION['username'];
$conn = connectDB();
$user_info_sql = "SELECT * FROM passengers WHERE username = '$username'";
$result = $conn->query($user_info_sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $LastName = $row['LastName'];
    
} else {
    $LastName = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cab Booking System</title>
    <link rel="stylesheet" href="style.css">

    <!-- Boostrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font-Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="container nav_container">
            <div class="nav_left">
                <!-- <a href="index.html"> -->
                <img src="imgs/City.png" alt="Book a Taxi">

                </a>

                <div class="nav-manu">
                    <!-- <a href="passenger-home.html">Ride</a> -->
                    <!-- <a href="driver/home.php">Drive</a> -->
                    <h2>Welcome, <span><?php echo $LastName; ?> </span></h2>
                    <div class="animation start-home">
                    </div>
                </div>
            </div>

            <ul class="nav_profile">
                <li class="profile-img">
                    <img src="imgs/profile_img.png" alt="My Profile">
                    <i class="fa-solid fa-angle-down"></i>
                </li>
                <li><a href="logout.php"><button>Logout</button></a></li>
            </ul>

        </div>
    </nav>

    <div class="divi location">
        <div class="divi location-form active">
            <form onsubmit="event.preventDefault(); calcRoute();">
                <h4>Find Your Trip</h4>
                <div class="mb-3 input1">
                    <input type="text" class="form-control" id="from" placeholder="Pick-up Location">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="to" placeholder="Drop-off Location">
                </div>
                <button type="submit" class="btn btn-primary" onclick="toggleActive('choose-car')">Search</button>
            </form>
        </div>


        <div class="divi choose-car">
            <div>
                <h1>Choose a Ride</h1>
                <div class="choose-car-header">

                </div>
            </div>
            <div class="choose-car-body">
                <h3>Recommended</h3>
                <div class="listOfCar div1 active-choose" onclick="toggleSelection('div1')">
                    <div class="car-img">
                        <img src="imgs/hatchback.png" alt="Hatchback">
                    </div>
                    <div class="car-details">
                        <h4>Hatchback</h4>
                        <p>Affordable, compact rides</p>
                    </div>
                    <div class="car-details-price">
                        <h4>LKR 5,895.29</h4>
                    </div>
                </div>
                <div class="listOfCar div2" onclick="toggleSelection('div2')">
                    <div class="car-img">
                        <img src="imgs/seden.png" alt="">
                    </div>
                    <div class="car-details">
                        <h4>Seden</h4>
                        <p>Comfortable sedans </p>
                    </div>
                    <div class="car-details-price">
                        <h4>LKR 5,895.29</h4>
                    </div>
                </div>
                <div class="listOfCar div3" onclick="toggleSelection('div3')">
                    <div class="car-img">
                        <img src="imgs/suv.png" alt="">
                    </div>
                    <div class="car-details">
                        <h4>SUV</h4>
                        <p>6+ Seater Mini Van Rides</p>
                    </div>
                    <div class="car-details-price">
                        <h4>LKR 5,895.29</h4>
                    </div>
                </div>
            </div>


            <div class="payment-option">
                <button type="submit" class="btn btn-outline-secondary btn2">Pay Now</button>
            </div>

        </div>



        <div>
            <div class="container-fluid">
                <div id="googleMap">

                </div>

            </div>
        </div>

    </div>






    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo2ATVL4w-PeF4HKW8gnQG2XMMOUjr5-0&libraries=places&callback=initMap"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="main.js"></script>

   

</body>

</html>