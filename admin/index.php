<?php
session_start();
include 'DbConnect.php'; // Include your database connection file

if (isset($_SESSION['isAdmin'])) {
    header('Location: admin.php'); // Redirect to login page if  logged in as admin
    exit();
}

// Define variables to store username/email and password
$username = $password = '';
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username/email and password from the form
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Perform validation (e.g., check if username/email and password match)
    $conn = connectDB();
    $query = "SELECT * FROM systemusers WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Valid credentials, set session variables and redirect to dashboard
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['Username'];
        $_SESSION['isAdmin'] = true;
        header('Location: admin.php'); // Redirect to dashboard or any other page
        exit();
    } else {
        // Invalid credentials, set error message
        // $error = 'Invalid credentials. Please try again.';
        echo '<script>alert("Invalid credentials");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Driver</title>
    <link rel="stylesheet" href="/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>

    <nav>
        <!-- Navigation code -->
            <div class="container nav_container">
                <div class="nav_left">
                    <a href="/">
                        <img src="/imgs/City.png" alt="Book a Taxi">
                    </a>
                </div>
            </div>
    </nav>

    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="contact">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h3>
                            <p>Admin Portal</p>
                        </h3>
                        <input type="text" placeholder="USERNAME" id="Username" name="Username" required>
                        <input type="password" placeholder="PASSWORD" id="Password" name="Password" required>
                        <button class="submit" name="submit">LET'S GO</button>
                    </form>
                    <?php if (!empty($error)) { ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="right">
                <!-- Right section content -->
            </div>
        </div>
    </section>

</body>

</html>