<?php
/*
 Template Name: Login_Page
 */
session_start();

?>

<?
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


   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = $conn->query($sql);
      //$active = $row['active'];
      
      //$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
         //session_start();
         //session_register($username);
         $_SESSION['login_user'] = $myusername;
         $_SESSION['valid'] = true;
         $_SESSION['timeout'] = time();

         if($row['access'] == "customer"){
         $_SESSION['customer']=true;
         header("location: http://127.0.0.1/wordpress/");
         }
         elseif($row['access'] == "manager"){
         $_SESSION['manager'] = true;
         header("location: http://127.0.0.1/wordpress/event-management");
         }
         elseif($row['access'] == "admin"){
         $_SESSION['admin'] = true;
         header("location: http://127.0.0.1/wordpress/admin-control");
         }


      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   
?>
<html>
   
   <head>
      <title>Login Page</title>
      <?php wp_head(); ?>


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
      
   </head>
   
	<body>

         <div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" autofocus/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password"/><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>

<?php get_footer();
