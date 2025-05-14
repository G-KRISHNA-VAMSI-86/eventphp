<?php
session_start(); // Ensure session starts at the top

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

$username = $_SESSION['username']; // Get username from session
?>
<?php
$servername = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$dbname = "event"; // Your database name

// ✅ Corrected: Use $dbname instead of $database
$conn = new mysqli($servername, $username, $password, $dbname);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Run the query safely
$sql = "SELECT * FROM Students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>The Event Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styledisplay.css" rel="stylesheet">
    <style>
        table {
            margin-top: 200px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-size: 14px;
        }
    </style>
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

<table border='1'>
    <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Username</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Phone</th>
    </tr>
    <?php if ($result && $result->num_rows > 0) { // ✅ Check if $result is valid
        while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                <td><?php echo htmlspecialchars($row["name"]); ?></td>
                <td><?php echo htmlspecialchars($row["username"]); ?></td>
                <td><?php echo htmlspecialchars($row["address"]); ?></td>
                <td><?php echo htmlspecialchars($row["gender"]); ?></td>
                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
            </tr>
    <?php } } else { echo "<tr><td colspan='6'>No records found</td></tr>"; } ?>
</table>

<?php $conn->close(); ?>
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
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
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

        Designed by <a href="https://bootstrapmade.com/">G.krishna vamsi</a>
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
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
