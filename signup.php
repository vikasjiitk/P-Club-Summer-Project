<html>
<? php session_start();?>
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
$genErr=$PhoneErr="";
$err="Fill all details";
$gen=$name=$username=$Phone=$pass=$Email=$conf="";
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
   if(empty($_POST["gender"]))
    $genErr="*required";
  else
    {
         $gen=test($_POST["gender"]);
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



<div class="container">

        

<form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

 
<h2 class="form-signin-heading">Sign Up</h2>
<input type="text" class="form-control" placeholder="Name" name="name">


        <input type="text" class="form-control" placeholder="E-Mail" name="Email" >
        <input class="form-control" placeholder="Gender" list="gender" name="gender">

<datalist id="gender">
<option value ="Male">
<option value ="Female"">

</datalist>
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
if(empty($usernameErr) && empty($passErr)&& empty($genErr) && empty($confErr) && empty($nameErr) && empty($EmailErr) && empty($PhoneErr))
  { 
    echo 'Hi! '.$_POST["name"];
    $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }

    $name=@mysqli_real_escape_string($con,$_POST["name"]);
    $Email=@mysqli_real_escape_string($con,$_POST["Email"]);
    $Phone=@mysqli_real_escape_string($con,$_POST["Phone"]);
    $username=@mysqli_real_escape_string($con,$_POST["username"]);
    $pass=@mysqli_real_escape_string($con,$_POST["pass"]);
    if(strcmp($_POST['gender'],"Male")==0)
  $gender='M';
else $gender='F';
    $gen=@mysqli_real_escape_string($con,$gender);
    $sql="INSERT INTO users (`id`, `username`, `password`, `name`,`gender`, `email`, `phone`)
     VALUES(NULL,'$username','$pass','$name','$gen','$Email','$Phone')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
$message = "Account created successfully!";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';    
    exit;  
      @mysqli_close($con);
      $nameErr=$EmailErr=$usernameErr=$passErr=$confErr="*";
      $PhoneErr='*';
    }
    ?>
</body>
  </html>
