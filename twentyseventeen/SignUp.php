<?php
/*
 Template Name: SignUp_Page
 */
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
         $passErr = $userErr = $lnameErr = $fnameErr = $emailErr = $genderErr = $dateErr = $cityErr = "";
         $user = $fname = $lname = $pass = $date = $gender = $city = $address = $email ="";
         
            if (empty($_POST["fname"])) {
               $fnameErr = "First Name is required";
            }else {
               $fname = test_input($_POST["fname"]);
            }
         

            if (empty($_POST["lname"])) {
               $lnameErr = "Last Name is required";
            }else {
               $lname = test_input($_POST["lname"]);
            }
        


            if (empty($_POST["user"])) {
               $userErr = "Username is required";
            }else {
               $user = test_input($_POST["user"]);
            }
         
         
            if (empty($_POST["pass"])) {
               $passErr = "Password is required";
            }else {
               $pass = test_input($_POST["pass"]);
            }

            if (empty($_POST["city"])) {
               $cityErr = "City is required";
            }else {
               $city = test_input($_POST["city"]);
            }
        


            if (empty($_POST["email"])) {
               $emailErr = "Email is required";
            }else {
               $email = test_input($_POST["email"]);
               
               // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format"; 
               }
            }
            
            if (empty($_POST["address"])) {
               $address = "";
            }else {
               $address = test_input($_POST["address"]);
            }
            
            
            if (empty($_POST["gender"])) {
               $genderErr = "Gender is required";
            }else {
               $gender = test_input($_POST["gender"]);
            }

         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
    $query = "INSERT INTO users (fname,lname,email,username,password,gender,city,address) VALUES ('$fname','$lname','$email','$user','$pass','$gender','$city','$address')";
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["SignUp"])
       $data = $conn->query($query);
 
?>

<html>

       <head>
      <title>SignUp Page</title>
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
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      

    <body>
     <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>SignUp</b></div>
				
            <div style = "margin:30px">

      <form action="" method="post">
      <table width="200">
       
        <tr>
        <td>Username:</td>
        <td><input name="user" required="" type="text" /></td>
        </tr>
        <tr>
        <td>Password:</td>
        <td><input name="pass" required="" type="password" /></td>
        </tr>
        <tr>
        <td>First Name:</td>
        <td><input name="fname" required="" type="text" /></td>
        </tr>
        <tr>
        <td>Last Name:</td>
        <td><input name="lname" required="" type="text" /></td>
        </tr>
        <tr>
        <td>Birth Date:</td>
        <td><input name="date" required="" type="date" /></td>
        </tr>
        <tr>
        <td>Gender:</td>
        </tr>
        <tr>
        <td>Male:</td>
        <td><input name="gender" required="" type="radio" value="male" /></td>
        </tr>
        <tr>
        <td>Female:</td>
        <td><input name="gender" required="" type="radio" value="female" /></td>
        </tr>
        <tr>
        <td>City:</td>
        <td><select name="city" required="">
        <option value="cairo">Cairo</option>
        <option value="giza">Giza</option>
        <option value="alexandria">Alexandria</option>
        <option value="tanta">Tanta</option>
        </select></td>
        </tr>
        <tr>
        <td>Address:</td>
        <td><input name="address" type="text" /></td>
        </tr>
        <tr>
        <td>Email:</td>
        <td><input name="email" required="" type="email" /></td>
        </tr>
        <tr>
        <td><input type="submit" name="SignUp" value="Sign-Up" /></td>
        </tr>
       
        </table>
        </form>
        Already a member? <strong> <a href=http://127.0.0.1/wordpress/login/> Log-In</strong></td>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
    </body>
</html>