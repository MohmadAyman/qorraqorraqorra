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

$sql = "SELECT * FROM events WHERE id={$_GET['id']} ";
$result = $conn->query($sql);
$remove_sql = "SELECT * FROM events WHERE id={$_GET['id']} ";
//TODO
$reserve_sql = "Insert into tickets ()";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. "description: " . $row["description"]. "date: " . $row["date"].  "time: " . $row["time"]."<br>";
        echo "<button (click)="remove($row['id'])">X</button>";
        echo "<button (click)="reserve($row['id'])">R</button>";
    }
} else {
    echo "0 events found";
}

$conn->close();
?>

<html>

    <form name="testForm" id="testForm"  method="POST"  >
        <input type="submit" name="remove" value="submit" autofocus  onclick="return true;"/>
    </form>
 <?php
    if(isset($_POST['remove'])){
        $result = $conn->query($remove_sql);
     }
  ?>
</html>