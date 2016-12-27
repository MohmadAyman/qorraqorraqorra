<?php
/*
Template Name: TicketNumber_Template
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
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $hallnum = $row["hallNumber"]; 
        //echo "Hall umber is "+ $hallnum;
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
        echo "Available Seats";
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

//       echo "<div class='demo'>";
//    		echo "<div id='seat-map'>";
// 			echo"<div class='front'>Theatre</div> ";					
// 		echo "</div>";
// 		echo "<div class='booking-details'>";
// 		echo "<p>Performance: <span> Gingerclown</span></p>";
// 		echo	"<p>Time: <span>November 3, 21:00</span></p>";
// 		echo	"<p>Seat: </p>";
// 		echo	"<ul id='selected-seats'></ul>";
// 		echo	"<p>Tickets: <span id='counter'>0</span></p>";
// 		echo	"<p>Total: <b>$<span id='total'>0</span></b></p>";
					
// 		echo	"<button class='checkout-button'>BUY</button>";
					
// 		echo	"<div id='legend'></div>";
// 		echo    "</div>";
// 		echo "<div style='clear:both'></div>";
//    echo "</div>";
        // echo "<table width='200'>";
        // echo "<td>";
        // echo "Availabe Seats:" . "</td>";
        // echo "<td>";
        // echo "<select>";
        // // for($i=1;i<=$availableSeats;$i++) {
        //     echo "<option value=";1; echo">1</option>";
        // // }
        // echo "</select>" . "</td>";

        add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}
    wp_enqueue_script( 'seats', get_template_directory_uri() . '/js/jquery.seats.js', 'jquery' );	

//     add_action( 'wp_enqueue_scripts', 'add_my_script' );
//     function add_my_script() {
//     wp_enqueue_script(
//         'seats', // name your script so that you can attach other scripts and de-register, etc.
//         get_template_directory_uri() . '/js/seats.js', // this is the location of your script file
//         array('jquery') // this array lists the scripts upon which your script depends
//     );
// }

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
<head>
<style type = "text/css">
front{width: 300px;margin: 5px 32px 45px 32px;background-color: #f0f0f0; color: #666;text-align: center;padding: 3px;border-radius: 5px;} 
booking-details {float: right;position: relative;width:200px;height: 450px; } 
booking-details h3 {margin: 5px 5px 0 0;font-size: 16px;} 
booking-details p{line-height:26px; font-size:16px; color:#999} 
booking-details p span{color:#666} 
div.seatCharts-cell {color: #182C4E;height: 25px;width: 25px;line-height: 25px;margin: 3px;float: left;text-align: center;outline: none;font-size: 13px;} 
div.seatCharts-seat {color: #fff;cursor: pointer;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius: 5px;} 
div.seatCharts-row {height: 35px;} 
div.seatCharts-seat.available {background-color: #B9DEA0;} 
div.seatCharts-seat.focused {background-color: #76B474;border: none;} 
div.seatCharts-seat.selected {background-color: #E6CAC4;} 
div.seatCharts-seat.unavailable {background-color: #472B34;cursor: not-allowed;} 
div.seatCharts-container {border-right: 1px dotted #adadad;width: 400px;padding: 20px;float: left;} 
div.seatCharts-legend {padding-left: 0px;position: absolute;bottom: 16px;} 
ul.seatCharts-legendList {padding-left: 0px;} 
seatCharts-legendItem{float:left; width:90px;margin-top: 10px;line-height: 2;} 
span.seatCharts-legendDescription {margin-left: 5px;line-height: 30px;} 
checkout-button {display: block;width:80px; height:24px; line-height:20px;margin: 10px auto;border:1px solid #999;font-size: 14px; cursor:pointer} 
#selected-seats {max-height: 150px;overflow-y: auto;overflow-x: none;width: 200px;} 
#selected-seats li{float:left; width:72px; height:26px; line-height:26px; border:1px solid #d3d3d3; background:#f7f7f7; margin:6px; font-size:14px; font-weight:bold; text-align:center} 
</style>
</head>

<body>
<div class="demo">
   		<div id="seat-map">
			<div class="front">Theatre</div>					
		</div>
		<div class="booking-details">
			<p>Movie: <span> Gingerclown</span></p>
			<p>Time: <span>November 3, 21:00</span></p>
			<p>Seat: </p>
			<ul id="selected-seats"></ul>
			<p>Tickets: <span id="counter">0</span></p>
			<p>Total: <b>$<span id="total">0</span></b></p>
					
			<button class="checkout-button">BUY</button>
					
			<div id="legend"></div>
		</div>
		<div style="clear:both"></div>
   </div>

    <form name="testForm" id="testForm"  method="POST"  >
        <input type="submit" name="remove" value="Submit" autofocus  onclick="return true;"/>
    </form>
 <?php
    if(isset($_POST['remove'])){
        $result = $conn->query($remove_sql);
     }
  ?>
</body>
</html>