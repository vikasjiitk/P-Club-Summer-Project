<html>
<head>
   <title>
      Share ur Fare
   </title>
<style>
.error {color:red;}
.align {text-align: center;}
</style>
</head>
<body style="background-color:lavender";>
<?php 
$nameErr=$EmailErr=$usernameErr=$passErr=$confErr="*";
$PhoneErr="";
$name=$username=$Phone=$pass=$Email=$conf="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["name"]))
		$nameErr="*required";
	else
		{
         $name=test($_POST["name"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
         $nameErr = "*Only letters and white space allowed"; 
         else $nameErr="";
      }

	 if (empty($_POST["Email"])) 
     $EmailErr = "*required";

    else {
     $Email = test($_POST["Email"]);
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$Email)) 
      $EmailErr = "*Invalid email format"; 
     else $EmailErr="";
     }
   if(empty($_POST["Phone"]))
      $PhoneErr="";
   else
   {
      $Phone=test($_POST["Phone"]);
      if (!preg_match("/^[0-9]*$/",$Phone) || strlen($Phone)!=10){
        
         $PhoneErr="only 10 digit phone no. required";}
       else $PhoneErr="";
   }
   //echo 'phone' . $PhoneErr;
      if(empty($_POST["username"]))
    $usernameErr="*required";
  else
    {
         $username=test($_POST["username"]);
          //echo '<br>' . $username . '<br>';
          require 'connect.inc.php';
          $query = "SELECT `username` from `users`";
          $usernameErr="";
          if($query_run=mysql_query($query))
          {
          while($query_row = mysql_fetch_assoc($query_run))
          {
            $user = $query_row['username'];
           // echo $user . '<br>';
            if(strcmp($username,$user)==0)
              $usernameErr="*not available";
          }}

         if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) 
         $usernameErr = "*Only letters and digits are allowed"; 
      }
      //echo '<br>'. $usernameErr . '<br>';

   if(empty($_POST["pass"]))
    {$passErr="*password is required";}
     elseif(strlen($_POST["pass"])<=7) 
      {$passErr="*8 characters required";}
       else {$passErr="";} 
   
   if(empty($_POST["conf"]))
   {$confErr="*confirm your password";} 
   else 
   { 
    if ( strcmp($_POST["pass"], $_POST["conf"])!=0) 
    {$confErr="*Enter same password"; }
    else $confErr="";
   }
   
}


function test($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;}
   ?>
   <span class=align>
   <h2><i>SIGN UP</i></h2>

   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Name: <input type="text" name="name">
   <span class=error><?php echo $nameErr;?></span>
   <br><br>
   Email: <input type="text" name="Email">
   <span class=error><?php echo $EmailErr;?></span>
   <br><br>
   Phone no.: <input type="text" name="Phone">
   <span class=error><?php echo $PhoneErr;?></span>
   <br><br>
   Choose a username: <input type="text" name="username">
   <span class=error><?php echo $usernameErr;?></span>
   <br><br>
   Password: <input type="password" name="pass">
   <span class=error><?php echo $passErr;?></span>
   <br><br>
   Confirm Password: <input type="password" name="conf">
   <span class=error><?php echo $confErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>
</span>
<?php
if(empty($usernameErr) && empty($passErr) && empty($confErr) && empty($nameErr) && empty($EmailErr) && empty($PhoneErr))
  { 
    echo 'hi';
    $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }

    $name=@mysqli_real_escape_string($con,$_POST["name"]);
    $Email=@mysqli_real_escape_string($con,$_POST["Email"]);
    $Phone=@mysqli_real_escape_string($con,$_POST["Phone"]);
    $username=@mysqli_real_escape_string($con,$_POST["username"]);
    $pass=@mysqli_real_escape_string($con,$_POST["pass"]);
    $sql="INSERT INTO users (`id`, `username`, `password`, `name`, `email`, `phone`)
     VALUES(NULL,'$username','$pass','$name','$Email','$Phone')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}

     echo '<br>' . "<h3>Welcome to share your fare</h3>" . '<br>';

     echo "<a href=login.php>Go to Login Page</a>";

      @mysqli_close($con);
      $nameErr=$EmailErr=$usernameErr=$passErr=$confErr="*";
      $PhoneErr='*';
    }
    ?>
</body>
  </html>
