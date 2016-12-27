<?php
/*
 Template Name: AdminControl_Page
 */
 session_start();
  if(!isset($_SESSION['admin'])){
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
         $approveErr = $changeAuthorityErr = $usernameErr = "";
         $approveUser = $changeAuthority = $username = "";
         

                if (!empty($_POST["approveUser"])) {
                $approveUser = test_input($_POST["approveUser"]);
                $username=test_input($_POST["username"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE users SET approval='$approveUser' WHERE username='$username'";
                     $data = $conn->query($query);              
                }
            }

                if (!empty($_POST["changeAuthority"])) {
                $changeAuthority = test_input($_POST["changeAuthority"]);
                $username=test_input($_POST["username"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
                    $query="UPDATE users SET access='$changeAuthority' WHERE username='$username'";
                     $data = $conn->query($query);              
                }
            }

                if (!empty($_POST["username"])) {
                    $username=test_input($_POST["username"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["cancel"]){
                    $query="DELETE from users WHERE username='$username'";
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
      <title>admin Control Page</title>
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Admin Control</b></div>
				
            <div style = "margin:30px">


      <form action="" method="post">
      <table width="400">


        <tr>
        <td>Username:</td>
        <td><input name="username" type="text" /></td>
        </tr>

        <tr>
        <td>Approve User:</td>
        <td><select name="approveUser" >
        <option value="0">0</option>
        <option value="1">1</option>
        </select></td>
        </tr>

        <tr>
        <td>Change Authority:</td>
        <td><input name="changeAuthority" type="text" /></td>
        </tr>


       
        <tr>
        <td><input type="submit" name="update" value="Update" /></td>
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