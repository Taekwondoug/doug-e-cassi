<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "futeba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, teamName FROM Teams";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["teamName"]. " <button class='delete' data-id='" . $row["id"] . "'>Delete</button><br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
