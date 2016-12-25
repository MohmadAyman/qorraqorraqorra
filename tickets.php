<?php
/*
Template Name: TicketNumber_Template
*/
 
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
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $hallnum = $row["hallNumber"]; 
        echo "Hall umber is "+ $hallnum;
    }
} else {
    echo "0 events found";
}


$sql2 = "SELECT * FROM halls WHERE hallNumber={$hallnum} ";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $totalSeats = $row["numberSeat"];
        $totalSeats *= $row["rowNumber"];
        echo "  Avilabl seats ";
        echo  $totalSeats;
    }
} else {
    echo "0 events found";
}


$sql3 = "SELECT ticketNumber FROM ticket WHERE eventNumber={$eventId} ";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
        $reservedSeats = $row["ticketNumber"];
    }
}

$reservedSeats = $row["ticketNumber"];

$availableSeats= $totalSeats-$reservedSeats;

if ($availableSeats != 0) {
        echo "<table width='200'>";
        echo "<td>";
        echo "Availabe Seats:" . "</td>";
        echo "<td>";
        echo "<select>";
        // for($i=1;i<=$availableSeats;$i++) {
            echo "<option value=";1; echo">1</option>";
        // }
        echo "</select>" . "</td>";
        
        /*echo "<ul>";
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
        echo "</table>";
        echo "</ul>";*/
        //echo "<button (click)="remove($row['id'])">X</button>";
        //echo "<button (click)="reserve($row['id'])">R</button>";
    }
    else {
    echo "No Seats Available";
}

// $eventId=$_GET['eventNumber'];

// $sql = "SELECT * FROM events WHERE eventNumber={$eventId} ";
// $result = $conn->query($sql);


// if ($result->num_rows > 0) {
// $row = $result->fetch_assoc();
// $hallNumber = $row["hallNumber"];
// echo $hallNumber;
// }else{
//     echo 'bhubhbhg';
// }

// $sql2 = "SELECT numberSeat,rowNumber FROM halls WHERE hallNumber={$hallNumber} ";
// $result2 = $conn->query($sql2);

// $sql3 = "SELECT ticketNumber FROM ticket WHERE eventNumber={$eventId} ";
// $result3 = $conn->query($sql3);

// if ($result2->num_rows > 0) {
// $row = $result2->fetch_assoc();
// $totalSeats = $row["numberSeat"] * $row["rowNumber"];
// echo $totalSeats;
// }

// if ($result2->num_rows > 0) {
// $row2 = $result3->fetch_assoc();
// $reservedSeats = $row["ticketNumber"];
// }

// $availableSeats= $totalSeats-$reservedSeats;

// //$remove_sql = "SELECT * FROM ticket WHERE ticketNumber={$ticketNumber} ";
// //public function remove ($value='')
// //{
//   //  $result = $conn->query($remove_sql);
// //}

// $reserve_sql = "Insert into tickets ()";

// //echo $result->fetch_assoc();

// if ($availableSeats != 0) {
//     // output data of each row
//         //echo "Name: " . $row["eventName"]. "Description: " . $row["description"]. "Date: " . $row["date"].  "Hall Number " . $row["hallNumber"]."<br>";
//         echo "<table width='200'>";
//         echo "<td>";
//         echo "Availabe Seats:" . "</td>";
//         echo "<td>";
//         echo "<select>";
//         for($i=1;i<=$availableSeats;$i++) {
//         echo "<option value=";$i; echo">$i</option>";
//         }
//         echo "</select>" . "</td>";
        
//         /*echo "<ul>";
//         echo "<tr>";
//         echo"<td>" ;
//         echo "Name:  " . $row["eventName"]. "</td>";
//         echo "<td>" ;
//         echo "Description: "  . $row["description"]. "</td>";
//         echo "<td>" ;
//         echo "Date: "  . $row["date"]. "</td>";
//         echo "<td>";
//         echo "Hall Number: "  . $row["hallNumber"]. "</td>";
//         echo "</tr>";
//         echo "</table>";
//         echo "</ul>";*/
//         //echo "<button (click)="remove($row['id'])">X</button>";
//         //echo "<button (click)="reserve($row['id'])">R</button>";
//     }
//     else {
//     echo "No Seats Available";
// }

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