<?php
session_start(); // Ensure session starts at the top

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

$username = $_SESSION['username']; // Get username from session


// Database connection
$servername = "localhost";
$db_username = "root"; // Default username for local server
$db_password = ""; // Default password for local server
$database = "event"; // Your database name

$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session contains a logged-in username
if (!isset($_SESSION['username'])) {
    die("Error: User is not logged in.");
}

$username = $_SESSION['username'];

// Fetch user data
$query = "SELECT * FROM students WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Assign data to variables
    $id = $row['id'];
    $name = $row['name'];
    $username = $row['username'];
    $address = $row['address'];
    $gender = $row['gender'];
    $phone = $row['phone'];
} else {
    die("Error: User not found in database.");
}

$stmt->close();
$conn->close();
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
  <link href="css/styleprofile.css" rel="stylesheet">

</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="" class="scrollto"><img src="img/logo.png" alt="" title=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active">
		  <a href="index.php">Home</a></li>
          <li><a href="About.html">About us</a></li>
		  <li><a href="profile.php">profile</a></li>
          <li><a href="Speakers.html">Speakers</a></li>
          <li><a href="Schedule.html">Schedule</a></li>
          <li><a href="Venue.html">Venue</a></li>
          <li><a href="Hotels.html">Hotels</a></li>
          <li><a href="Gallery.html">Gallery</a></li>
		  <li class="buy-tickets"><a href="#buy-tickets">Buy Tickets</a></li>
		  <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  <!--=================================================
  profile
  ====================================================-->
  <section id="profile">
    <div class="profile-container">
        <center>
            <h2>User Profile</h2>
            <table>
    <tr>
        <th>Id</th>
        <td><?= htmlspecialchars($id) ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?= htmlspecialchars($name) ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?= htmlspecialchars($username) ?></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><?= htmlspecialchars($address ?? 'N/A') ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?= htmlspecialchars($gender) ?></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><?= htmlspecialchars($phone) ?></td>
    </tr>
</table>


            <h6>If you want to update the password, click here <a href="update.php">Update</a></h6>
            <h6>If you want to see all registered users, click here <a href="display.php">Display</a></h6>
        </center>
    </div>
</section>
		
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
