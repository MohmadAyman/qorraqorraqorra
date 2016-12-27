<?php
/*
 Template Name: EditHalls_Page
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
         $numberSeatErr = $rowNumberErr = $hallNumberErr = "";
         $numberSeat = $rowNumber = $hallNumber = "";
         

                if (!empty($_POST["hallNumber"])) {
                $hallNumber = test_input($_POST["hallNumber"]);
                $rowNumber = test_input($_POST["rowNumber"]);
                $numberSeat = test_input($_POST["numberSeat"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO halls (hallNumber,rowNumber,numberSeat) VALUES ('$hallNumber','$rowNumber','$numberSeat')";
                     $data = $conn->query($query);
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE halls SET hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }

                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from halls WHERE hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }



                if (!empty($_POST["numberSeat"])) {
                $numberSeat = test_input($_POST["numberSeat"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO halls (hallNumber,numberSeat) VALUES ('$hallNumber','$numberSeat')";
                     $data = $conn->query($query);
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE halls SET numberSeat='$numberSeat' WHERE hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }

                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from halls WHERE hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }



                if (!empty($_POST["rowNumber"])) {
                $rowNumber = test_input($_POST["rowNumber"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
                    $query = "INSERT INTO halls (hallNumber,rowNumber) VALUES ('$hallNumber','$rowNumber')";
                     $data = $conn->query($query);
                }
                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE halls SET rowNumber='$rowNumber' WHERE hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }

                elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from halls WHERE hallNumber='$hallNumber'";
                     $data = $conn->query($query);              
                }
            }


            // if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["create"]){
            //         $query = "INSERT INTO events (eventName,eventNumber,hallNumber) VALUES ('$eventName','$eventNumber','$hallNumber')";
            //          $data = $conn->query($query);
            //     }
            // if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
            //         $query="UPDATE events SET eventName='$eventName' WHERE eventNumber='$eventNumber' and hallNumber='$hallNumber'";
            //          $data = $conn->query($query);              
            //     }
            // if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
            //         $query="UPDATE events SET hallNumber='$hallNumber' WHERE eventNumber='$eventNumber' and eventName='$eventName'";
            //          $data = $conn->query($query);              
            //     }
            // if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
            //         $query="UPDATE events SET eventNumber='$eventNumber' WHERE eventName='$eventName' and hallNumber='$hallNumber'";
            //          $data = $conn->query($query);              
            //     }
            // if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
            //         $query="DELETE from events WHERE eventName='$eventName' and eventNumber='$eventNumber' and hallNumber='$hallNumber'";
            //          $data = $conn->query($query);              
            //     }

         
            
         
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit or Create Halls</b></div>
				
            <div style = "margin:30px">


      <form action="" method="post">
      <table width="400">


        <tr>
        <td>Hall Number:</td>
        <td><input name="hallNumber" required="" type="number" /></td>
        </tr>

        <tr>
        <td>Number of Seats per Row:</td>
        <td><input name="numberSeat" type="number" /></td>
        </tr>

        <tr>
        <td>Number of Rows:</td>
        <td><input name="rowNumber" type="number" /></td>
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