<?php
// Connection settings for XAMPP (localhost)
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mall_auth";

// Connect to MySQL
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$fullname = htmlspecialchars($_POST['fullname']);
$email = htmlspecialchars($_POST['email']);
$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hash
$phone = htmlspecialchars($_POST['phone']);
$shopname = htmlspecialchars($_POST['shopname']);
$category = htmlspecialchars($_POST['category']);
$shopnumber = htmlspecialchars($_POST['shopnumber']);

// Check if the username or shop number already exists
$check = "SELECT * FROM users WHERE username='$username' OR shopnumber='$shopnumber'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<h3 style='color: red;'>Username or shop number already exists.</h3>";
} else {
    // Insert into the database
    $sql = "INSERT INTO users (fullname, email, username, password, phone, shopname, category, shopnumber)
            VALUES ('$fullname', '$email', '$username', '$password', '$phone', '$shopname', '$category', '$shopnumber')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color: green;'>Shop account created successfully!</h3>";
    } else {
        echo "<h3 style='color: red;'>Error: " . $conn->error . "</h3>";
    }
}

$conn->close();
?>
