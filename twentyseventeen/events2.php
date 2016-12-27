<?php
/*
Template Name: Events_Template
*/
session_start();
  if(isset($_SESSION['manager'])){
      header("location:404");
   }
   elseif(isset($_SESSION['admin'])){
      header("location:404");
   }
 
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

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

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<img src="data:image/jpg;base64,'.base64_encode( $row['poster'] ).'"width=400 height=300 />';
        echo "<ul>";
        echo "<table width='200'>";
        echo "<tr>";
        echo"<td>" ;
        echo "Name:<strong> <a href=http://127.0.0.1/wordpress/event-details/?eventNumber={$row['eventNumber']}>{$row['eventName']}</a>\n</strong></td>";
        echo "<td>" ;
        echo "Description: "  . $row["description"]. "</td>";
        echo "<td>" ;
        echo "Date: "  . $row["date"]. "</td>";
        echo "<td>";
        echo "Hall Number: "  . $row["hallNumber"]. "</td>";
        echo "</tr>";
        echo "</table>";
        //echo "<a href=http://127.0.0.1/wordpress/event-details/?eventNumber={$row['eventNumber']}>{$row['eventName']}</a><br>\n";
        //echo "<button (click)="remove($row['id'])">X</button>";
        echo "</ul>";
    }
} else {
    echo "0 events found";
}
$conn->close();
?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();