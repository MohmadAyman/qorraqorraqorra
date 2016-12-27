<?php
/*
Template Name: EventsDetails_Template
*/
 session_start();
   if(!isset($_SESSION['login_user'])){
      header("location:login");
   }
get_header(); ?>

<?php
$servername = "localhost";
$username = "webuser";
$password = "12345";
$dbname = "webdb";
//$num_of_events=0;
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
//public function remove ($value='')
//{
  //  $result = $conn->query($remove_sql);
//}

$reserve_sql = "Insert into tickets ()";

//echo $result->fetch_assoc();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "Name: " . $row["eventName"]. "Description: " . $row["description"]. "Date: " . $row["date"].  "Hall Number " . $row["hallNumber"]."<br>";
        echo "<ul>";
        echo "<table width='200'>";
        echo "<tr>";
        echo"<td>" ;
        echo "Name:  " . $row["eventName"]. "</td>";
        echo "<td>" ;
        echo "Description: "  . $row["description"]. "</td>";
        echo "<td>" ;
        echo "Date: "  . $row["date"]. "</td>";
        echo "<td>";
        echo "Hall Number: "  . $row["hallNumber"]. "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "Reserve<strong> <a href=http://127.0.0.1/wordpress/tickets/?eventNumber={$row['eventNumber']}>{$row['eventName']}</a>\n</strong></td>";
        echo "</tr>";
        echo "</table>";
        echo "</ul>";
        //echo "<button (click)="remove($row['id'])">X</button>";
        //echo "<button (click)="reserve($row['id'])">R</button>";
    }
} else {
    echo "0 events found";
}

$conn->close();
?>

<html>

    <form name="testForm" id="testForm"  method="POST"  >
        <input type="submit" name="remove" value="Submit" autofocus  onclick="return true;"/>
    </form>
 <?php
    if(isset($_POST['remove'])){
        $result = $conn->query($remove_sql);
     }
  ?>
</html>