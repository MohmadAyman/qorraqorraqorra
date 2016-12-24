<?php
/*
Template Name: Events_Template
*/
 
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

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

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<ul>";
        <table width="200">
        <tr>
        <td> echo "Name: " . $row["eventName"]</td>
        <td> echo "description: " . $row["description"]</td>
        <td> echo "date: " . $row["date"]</td>
        <td> echo "time: " . $row["hallNumber"]</td>;
        </tr>
        </table>
        echo "<a href=\"event\detail.php?id={$row['id']}\">{$row['name']}</a><br>\n";
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
