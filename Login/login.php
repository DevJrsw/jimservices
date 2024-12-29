<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "sql8.freesqldatabase.com"; // Your MySQL server address
$dbUsername = "sql8754710"; // Your MySQL username (default for XAMPP/WAMP)
$dbPassword = "LlHpxzJKLZ"; // Your MySQL password (default is empty for XAMPP/WAMP)
$dbName = "users"; // Your database name

// Connect to the database
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Validate user credentials
$sql = "SELECT * FROM users WHERE username = ? AND password = MD5(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Successful login
    header("Location: index.html.lnk");
    exit();
} else {
    // Invalid credentials
    echo "<h2>Invalid username or password. <a href='index.html'>Try again</a></h2>";
}


// Close the connection
$stmt->close();
$conn->close();
?>