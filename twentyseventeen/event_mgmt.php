<?php
/*
 Template Name: EventMgmt_Page
 */
 session_start();
  if(!isset($_SESSION['manager'])){
      header("location:404");
   }
 get_header();
?>   
   
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
         // define variables and set to empty values
         $eventNameErr = $eventNumberErr = $eventDiscErr = $eventDateErr = $eventPosterErr = $hallNumberErr = "";
         $eventName = $eventNumber = $eventDisc = $eventDate = $eventPoster = $hallNumber = "";
         

            if (empty($_POST["eventName"]) && empty($_POST["eventNumber"]) && empty($_POST["hallNumber"])) {
                 $eventNameErr="Required"; $eventNumberErr="Required"; $hallNumberErr="Required";}
                 else{

                if (!empty($_POST["eventDisc"])) {
                $eventDisc = test_input($_POST["eventDisc"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO events (eventName,eventNumber,description,hallNumber) VALUES ('$eventName','$eventNumber','$eventDisc','$hallNumber')";
                     $data = $conn->query($query);
                     echo "Data Created Successfully";
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE events SET description='$eventDisc' WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }

                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from events WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }

                if (empty($_POST["eventPoster"])) {
                    $eventPosterErr="Required";}
                else{
                $imagename=$_FILES["myimage"]["name"];
                $imagetmp=addslashes (file_get_contents($_FILES["myimage"]["tmp_name"]));
                if($_POST["create"]){
                    $query_hall="INSERT INTO halls (hallNumber) VALUES ('$hallNumber')";
                    $data_hall=$conn->query($query_hall);
                    $query = "INSERT INTO events (eventName,eventNumber,poster) VALUES ('$eventName','$eventNumber','$imagetmp')";
                    $data = $conn->query($query);
                    if($conn->query($query) === True)
                        echo("Image Inserted Successfully");
                    else
                        echo "Error Inserting Image: " . $conn->error;
                }
                elseif($_POST["update"]){
                    $query="UPDATE events SET poster='$imagename' WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);
                     if($conn->query($query) === True)
                        echo("Image Updated Successfully");
                    else
                        echo "Error Updating Image: " . $conn->error;              
                }
                elseif($_POST["cancel"]){
                    $query="DELETE from events WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }


                if (!empty($_POST["eventDate"])) {
                $eventDate = test_input($_POST["eventDate"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO events (eventName,eventNumber,eventDate,hallNumber) VALUES ('$eventName','$eventNumber','$eventDate','$hallNumber')";
                     $data = $conn->query($query);
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE events SET eventDate='$eventDate' WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from events WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO events (eventName,eventNumber,hallNumber) VALUES ('$eventName','$eventNumber','$hallNumber')";
                     $data = $conn->query($query);
                }
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE events SET eventName='$eventName' WHERE eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE events SET hallNumber='$hallNumber' WHERE eventNumber='$eventNumber' and eventName='$eventName'";
                     $data = $conn->query($query);              
                }
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE events SET eventNumber='$eventNumber' WHERE eventName='$eventName' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from events WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }

            }
         
            
         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
    
?>

<html>

       <head>
      <title>Event Management Page</title>
        </head>

         <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
      </style>
      

    <body>
     <div align = "center">
         <div style = "width:700px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit Event</b></div>
				
            <div style = "margin:30px">

<form action="edit-halls" method="get">
    <input type="submit" value="Edit or Create Halls" name="Submit" />
</form>

      <form action="" method="post">
      <table width="200">
       
        <tr>
        <td>Event Name:</td>
        <td><input name="eventName" required="" type="text" /></td>
        </tr>

        <tr>
        <td>Event Number:</td>
        <td><input name="eventNumber" required="" type="number" /></td>
        </tr>

        <tr>
        <td>Event Description:</td>
        <td><textarea name="eventDisc" rows="10" cols="50"></textarea></td>
        </tr>

        <tr>
        <td>Hall Number:</td>
        <td><input name="hallNumber" required="" type="number" /></td>
        </tr>

        <tr>
        <td>Event Date:</td>
        <td><input name="eventDate" type="date" /></td>
        </tr>

        <tr>
        <td>Image:</td>
        <td><input type="file" name="myimage" /></td>
        </tr>

        <tr>
        <td><input type="submit" name="update" value="Update" /></td>
        <td><input type="submit" name="create" value="Create" /></td>
        <td><input type="submit" name="cancel" value="Cancel" /></td>
        </tr>
       
        </table>
        </form>
        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
    </body>
</html>