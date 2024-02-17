<?php
session_start();
include 'DbConnect.php';

// Check if the user is logged in as an admin (you may need to implement proper authentication)
// For demonstration purposes, I'm assuming a session variable named 'isAdmin'



if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
	header('Location: index.php'); // Redirect to login page if not logged in as admin
	exit();
}

$conn = connectDB();

// Retrieve all drivers
$query_driver = 'SELECT * FROM Drivers';
$result_driver = $conn->query($query_driver);

$query_passenger = 'SELECT * FROM Passengers';
$result_passenger = $conn->query($query_passenger);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<!-- My CSS -->
	<link rel="stylesheet" href="style-admin.css">

	<!-- Font-Awesome CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>City Taxi - Admin</title>

	<style>
		.activate-btn,
		.reject-btn {
			padding: 5px 10px;
			cursor: pointer;
		}

		.activate-btn {
			background-color: #4CAF50;
			color: white;
		}

		.reject-btn {
			background-color: #f44336;
			color: white;
		}
	</style>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-car'></i>
			<span class="text">City Taxi</span>
		</a>
		<ul class="side-menu top">
			<li class="active" onclick="viewContent('content1')">
				<a href="#">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li onclick="viewContent('content2')">
				<a href="#">
					<i class='bx bxs-layer-plus'></i>
					<span class="text">Booking</span>
				</a>
			</li>
			<li onclick="viewContent('content3')">
				<a href="#">
					<i class='bx bxs-user'></i>
					<span class="text">Drivers</span>
				</a>
			</li>
			<li onclick="viewContent('content4')">
				<a href="#">
					<i class='bx bxs-user-detail'></i>
					<span class="text">Passangers</span>
				</a>
			</li>
			<!-- <li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li> -->
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text" >Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="/imgs/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main class="contents content1 active-content">
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search'></i>
						<i class='bx bx-filter'></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="/imgs/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>
								<td>
									<img src="/imgs/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="/imgs/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>
								<td>
									<img src="/imgs/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="/imgs/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus'></i>
						<i class='bx bx-filter'></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
					</ul>
				</div>
			</div>
		</main>

		<main class="contents content2">
			<div class="head-title">
				<div class="left">
					<h1>Booking</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Booking</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="location">
				<div class="divi location-form active">
					<form onsubmit="event.preventDefault(); calcRoute();">
						<h4>Find Your Trip</h4>
						<div class="input">
							<input type="text" id="from" placeholder="Pick-up Location">
						</div>
						<div class="input">
							<input type="text" id="to" placeholder="Drop-off Location">
						</div>
						<button type="submit" class="btn" onclick="toggleActive('choose-car')">Search</button>
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
								<img src="/imgs/hatchback.png" alt="Hatchback">
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
								<img src="/imgs/seden.png" alt="">
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
								<img src="/imgs/suv.png" alt="">
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
						<button type="submit" class="btn">Book</button>
					</div>

				</div>



				<div>
					<div class="container-fluid">
						<div id="googleMap">

						</div>

					</div>
				</div>

			</div>
		</main>





		<main class="contents content3">
			<div class="head-title">
				<div class="left">
					<h1>Drivers</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Drivers</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="driver-table">
				<!-- <table>
					<tr>
						<th>Driver ID</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Account Status</th>
						<th>Actions</th>
					</tr>
					<tr>
						<td>1234</td>
						<td>Rifkan1234</td>
						<td>Rifkan</td>
						<td>Mohamed</td>
						<td>Rifkan1234@gmail.com</td>
						<td>+941234567</td>
						<td>Active</td>
						<td>
							<button class="btn success">Activate</button>
							<button class="btn error">Reject</button>
						</td>
					</tr>
					<tr>
						<td>1234</td>
						<td>Rifkan1234</td>
						<td>Rifkan</td>
						<td>Mohamed</td>
						<td>Rifkan1234@gmail.com</td>
						<td>+941234567</td>
						<td>Active</td>
						<td>
							<button class="btn success">Activate</button>
							<button class="btn error">Reject</button>
						</td>
					</tr>
				</table>	 -->


				<table>
					<tr>
						<th>DriverID</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Account Status</th>
						<th>Actions</th>
					</tr>
					<?php
					while ($row = $result_driver->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['DriverID'] . '</td>';
						echo '<td>' . $row['Username'] . '</td>';
						echo '<td>' . $row['FirstName'] . '</td>';
						echo '<td>' . $row['LastName'] . '</td>';
						echo '<td>' . $row['Email'] . '</td>';
						echo '<td>' . $row['PhoneNumber'] . '</td>';
						echo '<td>' . $row['AccountStatus'] . '</td>';
						echo '<td>';
						echo '<button class="activate-btn" onclick="activateDriver(' . $row['DriverID'] . ')">Activate</button>';
						echo '<button class="reject-btn" onclick="rejectDriver(' . $row['DriverID'] . ')">Reject</button>';
						echo '</td>';
						echo '</tr>';
					}
					?>
				</table>

			</div>

		</main>




		<main class="contents content4">
			<div class="head-title">
				<div class="left">
					<h1>Passangers</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Passangers</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="driver-table">
				<!-- <table>
					<tr>
						<th>Passenger ID</th>
						<th>Username</th>
						<th>Password</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Account Status</th>
						<th>Registration Time</th>
					</tr>
					<tr>
						<td>1234</td>
						<td>Rifkan1234</td>
						<td>rifkan124554</td>
						<td>Rifkan1234@gmail.com</td>
						<td>+941234567</td>
						<td>Mohamed</td>
						<td>Rifkan</td>
						<td>Active</td>
						<td>9.00 AM</td>
					</tr>
					<tr>
						<td>1234</td>
						<td>Rifkan1234</td>
						<td>rifkan124554</td>
						<td>Rifkan1234@gmail.com</td>
						<td>+941234567</td>
						<td>Mohamed</td>
						<td>Rifkan</td>
						<td>Active</td>
						<td>9.00 AM</td>
					</tr>
				</table> -->


				<table>
					<tr>
						<th>PassengerID</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone Number</th>
					</tr>
					<?php
					while ($row = $result_passenger->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['PassengerID'] . '</td>';
						echo '<td>' . $row['Username'] . '</td>';
						echo '<td>' . $row['FirstName'] . '</td>';
						echo '<td>' . $row['LastName'] . '</td>';
						echo '<td>' . $row['Email'] . '</td>';
						echo '<td>' . $row['PhoneNumber'] . '</td>';
						echo '</tr>';
					}
					?>
				</table>

			</div>
		</main>

	</section>
	<!-- CONTENT -->

	<script>
		function activateDriver(driverID) {
			// Implement the logic to update the driver's account status to 'ACTIVE'

			// Use AJAX or fetch API to send a request to the server to update the status and send an email
			fetch('activateDriver.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({
						driverID: driverID
					}),
				})
				.then(response => response.json())
				.then(data => {
					// Handle the server response if needed
					console.log(data);
					alert("Driver Successfully Activated And Verification Email Sent");
					// Reload the page or update the UI as needed
					location.reload();

				})
				.catch(error => console.error('Error:', error));
		}


		function rejectDriver(driverID) {
			// Implement the logic to reject the driver's account
			// Use AJAX or fetch API to send a request to the server to update the status and send a rejection email
			fetch('rejectDriver.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({
						driverID: driverID
					}),
				})
				.then(response => response.json())
				.then(data => {
					// Handle the server response if needed
					console.log(data);
					alert("Driver Profile Rejeted And Infomed Via Email");
					// Reload the page or update the UI as needed
					location.reload();
				})
				.catch(error => console.error('Error:', error));
		}
	</script>






	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo2ATVL4w-PeF4HKW8gnQG2XMMOUjr5-0&libraries=places&callback=initMap"></script>
	<script src="/main.js"></script>
</body>

</html>