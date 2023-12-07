<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "futeba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$teamName = $_POST['teamName'];
$sql = "INSERT INTO Teams (teamName) VALUES ('$teamName')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>