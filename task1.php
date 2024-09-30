<?php
// Database credentials
$servername = "localhos"; // or your server name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "login_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare SQL query
    $sql = "SELECT * FROM details WHERE username = ? AND password = ?";
    
    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $inputUsername, $inputPassword);
    
    // Execute query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Wrong username or password.";
    }

    $stmt->close();
}

$conn->close();
?>