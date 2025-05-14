<?php
session_start();

// Database connection parameters
$servername = "localhost"; // Change if needed
$username = "root"; // Default MySQL username for XAMPP
$password = ""; // Default password for XAMPP is empty
$database = "event"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data safely
$uname = isset($_POST['uname']) ? trim($_POST['uname']) : null;
$pwd = isset($_POST['pwd']) ? trim($_POST['pwd']) : null;

// Validate input fields
if (empty($uname) || empty($pwd)) {
    echo "<script>alert('Both fields are required!'); window.location.href='login.html';</script>";
    exit();
}

// Prepare SQL query to fetch user details
$query = "SELECT id, username, password FROM Students WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPwd = $row['password'];

    // Verify the password
    if (password_verify($pwd, $hashedPwd)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: index.php"); // Redirect to home page
        exit();
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('Invalid credentials'); window.location.href='login.html';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
