<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mall_auth";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$shopnumber = $_POST['shopnumber'];

// Get user by username and shop number
$sql = "SELECT * FROM users WHERE username='$username' AND shopnumber='$shopnumber'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $row['password'])) {
        echo "<h3 style='color: green;'>Login successful! Welcome to your shop, " . htmlspecialchars($row['shopname']) . ".</h3>";
    } else {
        echo "<h3 style='color: red;'>Invalid password.</h3>";
    }
} else {
    echo "<h3 style='color: red;'>Invalid username or shop number.</h3>";
}

$conn->close();
?>
