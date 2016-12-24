<?php
/*
Template Name: EventsDetails_Template
*/
 
get_header(); ?>

<?php
$servername = "localhost";
$username = "webuser";
$password = "12345";
$dbname = "webdb";
$num_of_events=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
$eventId=$_GET['eventNumber'];

$sql = "SELECT * FROM events WHERE eventNumber={$eventId} ";
$result = $conn->query($sql);

$remove_sql = "SELECT * FROM events WHERE eventNumber={$eventId} ";
public function remove ($value='')
{
    $result = $conn->query($remove_sql);
}

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