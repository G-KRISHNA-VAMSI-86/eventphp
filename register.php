<?php
session_start(); // Ensure session starts at the top



$username = $_SESSION['username']; // Get username from session


// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$database = "event"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Error: This page must be accessed via the registration form.");
}

// Retrieve and sanitize form data
$id = isset($_POST['sid']) ? trim($_POST['sid']) : null;
$name = isset($_POST['sname']) ? trim($_POST['sname']) : null;
$username = isset($_POST['uname']) ? trim($_POST['uname']) : null;
$password = isset($_POST['pwd']) ? trim($_POST['pwd']) : null;
$address = isset($_POST['saddr']) ? trim($_POST['saddr']) : null; // Optional field
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : null;
$phone = isset($_POST['sphno']) ? trim($_POST['sphno']) : null;

// Debugging: Log the request method and data
error_log("Request Method: " . $_SERVER["REQUEST_METHOD"]);
error_log("Form Data: " . json_encode($_POST));

// Validate required fields (All except address)
if (empty($id) || empty($name) || empty($username) || empty($password) || empty($gender) || empty($phone)) {
    die("All fields except address are required!");
}

// Validate email format
if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format!");
}

// Validate phone number (10 to 15 digits)
if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
    die("Phone number must be between 10-15 digits.");
}

// Hash the password before storing
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO Students (id, name, username, password, address, gender, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("issssss", $id, $name, $username, $hashedPassword, $address, $gender, $phone);

if ($stmt->execute()) {
    echo "Registration successful! Your Student ID is: <b>$id</b>. Redirecting to login...";
    header("refresh:3; url=login.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
