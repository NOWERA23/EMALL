<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mall_auth";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = htmlspecialchars($_POST['name']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM buyers WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed);
    $stmt->fetch();
    if (password_verify($password, $hashed)) {
        // Redirect to LANDINGPAGE.html after successful login
        header("Location: LANDINGPAGE.html");
        exit();
    } else {
        echo "<h3 style='color: red;'>Incorrect password.</h3>";
    }
} else {
    echo "<h3 style='color: red;'>User not found.</h3>";
}

$stmt->close();
$conn->close();
?>
