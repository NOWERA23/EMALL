<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mall_auth"; // updated

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = htmlspecialchars($_POST['name']);
$surname = htmlspecialchars($_POST['surname']);
$age = (int)$_POST['age'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($age < 18) {
    echo "<h3 style='color: red;'>You must be at least 18 years old to register.</h3>";
    exit();
}

$stmt = $conn->prepare("INSERT INTO buyers (name, surname, age, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $name, $surname, $age, $password);

if ($stmt->execute()) {
    echo "<h3 style='color: green;'>Account created successfully. <a href='login2.html'>Login here</a></h3>";
} else {
    echo "<h3 style='color: red;'>Error: " . $stmt->error . "</h3>";
}

$conn->close();
?>
