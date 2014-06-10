<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Signup</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style.css">
   <title>
      validform
   </title>
<style>
body {background-image:url("a1.jpg");}
h1
{
font-family: Magneto;
font-size: 50px;

}
.error {color:red;}
.align {text-align: center;}
</style>
</head>
<body>
  <center><h1>Share Ur Fare</h1>
<?php
$nameErr=$EmailErr=$usernameErr=$passErr=$confErr="*";
$PhoneErr="";
$err="Fill all details";
$name=$username=$Phone=$pass=$Email=$conf="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(empty($_POST["name"]))
$nameErr="Please enter your Name";
else
{
         $name=test($_POST["name"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$name))
         $nameErr = "For Name, Only letters and white space allowed";
         else $nameErr="";
      }

if (empty($_POST["Email"]))
     $EmailErr = "Please enter your Email";

    else {
     $Email = test($_POST["Email"]);
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$Email))
      $EmailErr = "*Invalid Email Format";
     else $EmailErr="";
     }
   if(empty($_POST["Phone"]))
      $PhoneErr="";
   else
   {
      $Phone=test($_POST["Phone"]);
      if (!preg_match("/^[0-9]*$/",$Phone) || strlen($Phone)!=10){
        
         $PhoneErr="Only 10 Digit Phone No. Required";}
       else $PhoneErr="";
   }
   //echo 'phone' . $PhoneErr;
      if(empty($_POST["username"]))
    $usernameErr="Please enter a Username";
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
              $usernameErr="Username not available";
          }}

         if (!preg_match("/^[a-zA-Z0-9]*$/",$username))
         $usernameErr = "For username, only letters and digits are allowed";
      }
      //echo '<br>'. $usernameErr . '<br>';

   if(empty($_POST["pass"]))
    {$passErr="*Password is required";}
     elseif(strlen($_POST["pass"])<=7)
      {$passErr="At least 8 character Password required";}
       else {$passErr="";}
   
   if(empty($_POST["conf"]))
   {$confErr="Confirm Your Password";}
   else
   {
    if ( strcmp($_POST["pass"], $_POST["conf"])!=0)
    {$confErr="*Enter Same Password"; }
    else $confErr="";
   }

//empty($nameErr) && empty($EmailErr)&&empty($PhoneErr)&&
//&&empty($passErr)&&empty($confErr)

//echo '<br>' . $usernameErr . '<br>';


}


function test($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;}
   ?>
<span class=align>
<div class="container">

       <form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

 
<h2 class="form-signin-heading">Sign Up</h2>
<input type="text" class="form-control" placeholder="Name" name="name">


        <input type="text" class="form-control" placeholder="E-Mail" name="Email" >
        
        <input type="number" class="form-control" placeholder="Phone Number(optional)" name="Phone" >
        
        <input type="text" class="form-control" placeholder="Choose your Username" name="username" >
        
        <input type="password" class="form-control" placeholder="Password" name="pass" >
        
        <input type="password" class="form-control" placeholder="Confirm Password" name="conf" >
        


         <br>
      

<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign Up
</button></form><br>
</div>
</span>
<?php
if($nameErr!= "" && $nameErr!= "*" ) $err=$nameErr;
else if($EmailErr!= "" && $EmailErr!= "*") $err=$EmailErr;
else if($PhoneErr!= "" && $PhoneErr!= "*")$err=$PhoneErr;
else if($usernameErr!= "" && $usernameErr!= "*") $err=$usernameErr;
else if($passErr!= "" && $passErr!= "*")$err=$passErr;
else if($confErr!= "" && $confErr!= "*") $err=$confErr;?>

<div id="display-error">
       <img src="error.png" alt="Error" /> <?php echo $err ?>
</div>




<?php
if(empty($usernameErr) && empty($passErr) && empty($confErr) && empty($nameErr) && empty($EmailErr) && empty($PhoneErr))
  {
    
    $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno())
    {
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
     {
      die('Error: '.mysqli_error($con));
    }

      $message = "Signed Up Successfully!
      Please login to continue.";
echo "<script type='text/javascript'>alert('$message');</script>";
 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login1.php">';

     

      @mysqli_close($con);
      $nameErr=$EmailErr=$usernameErr=$passErr=$confErr="";
      $PhoneErr='';
    }    ?>
</body>
</html>
