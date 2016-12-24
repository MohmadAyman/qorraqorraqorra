<?php
$servername = "localhost";
$username = "mhh";
$password = "root";
$dbname = "cons_proj";
$num_of_events=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<ul>";
        echo "Name: " . $row["name"]. "description: " . $row["description"]. "date: " . $row["date"].  "time: " . $row["time"]."<br>";
        echo "<a href=\"event\detail.php?id={$row['id']}\">{$row['name']}</a><br>\n";
        echo "<button (click)="remove($row['id'])">X</button>";
        echo "</ul>";
    }
} else {
    echo "0 events found";
}
$conn->close();
?>
