<?php
session_start(); // Ensure session starts at the top

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

$username = $_SESSION['username']; // Get username from session
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The Event Management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/venobox/venobox.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/styleupdate.css" rel="stylesheet">

    <script>
        function validateForm() {
            var newPassword = document.registration.newPassword.value;

            if (newPassword === "" || newPassword === null) {
                alert("Please enter a new password");
                document.registration.newPassword.focus();
                return false;
            }

            if (newPassword.length < 8) {
                alert("Password should be at least 8 characters long");
                document.registration.newPassword.focus();
                return false;
            }

            var checkUpper = /[A-Z]+/.test(newPassword);
            var checkLower = /[a-z]+/.test(newPassword);
            var checkNumber = /[0-9]+/.test(newPassword);
            if (!(checkUpper && checkLower && checkNumber)) {
                alert("Password should contain at least one uppercase letter, one lowercase letter, and one number");
                document.registration.newPassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <a href=""><img src="img/logo.png" alt="" title=""></a>
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="index.php">Home</a></li>
                <li><a href="About.html">About us</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="Speakers.html">Speakers</a></li>
                <li><a href="Schedule.html">Schedule</a></li>
                <li><a href="Venue.html">Venue</a></li>
                <li><a href="Hotels.html">Hotels</a></li>
                <li><a href="Gallery.html">Gallery</a></li>
                <li class="buy-tickets"><a href="#buy-tickets">Buy Tickets</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="login">
    <div class="container">
        <center><h2>Update Password</h2></center>
        <form action="update.php" method="post" name="registration" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="email" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">
            
            <input type="submit" value="Update Password">
        </form>
    </div>
</section>

<?php
// Secure session handling
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database credentials
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "event";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : null;

    if (!$username || !$newPassword) {
        die("<p>Error: All fields are required.</p>");
    }

    // Hash new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Secure update query
    $sql = "UPDATE Students SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $hashedPassword, $username);
        if ($stmt->execute()) {
            echo "<p>Password updated successfully.</p>";
            echo "<h6>Please log in again <a href='login.html'>Login</a></h6>";
            session_destroy(); // Logout user after password update
        } else {
            echo "<p>Error updating password: " . htmlspecialchars($stmt->error) . "</p>";
        }
        $stmt->close();
    } else {
        echo "Error: " . htmlspecialchars($conn->error);
    }
}

$conn->close();
?>



	
     <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo.png" alt="TheEvenet">
            <p>Hosting various types of events is a regular business practice for many organizations. Event management can be challenging as it requires a range of skills and specialized knowledge. Learning about how event management works can help organizations to devote proper efforts and resources to it.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              BCENT ROAD <br>
              ANDHRA PRADESH, NY 535022<br>
              INDIA <br>
              <strong>Phone:</strong> +91 9491754854<br>
              <strong>Email:</strong> krishnavamsi8514@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="google.com" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://.com/">G.KRISHNA VAMSI</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>