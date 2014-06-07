<!DOCTYPE HTML>
<?php session_start();?>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    
    
<style>
body {background-image:url("b1.jpg");}
background-repeat:repeat-x;
{h1:color:blue;}
</style>
<style>
h1
{
font-family: Magneto;
font-size: 50px;

}
</style>
<style>
.error {color: #FF0000;}
</style>
<title>
SHARE ur FARE_login
</title>
</head>
<body>
<p align="right"><script type="text/javascript">
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var strcount
var x = new Date()
document.getElementById('ct').innerHTML = x;
tt=display_c();
}
</script>
</head>
<body onload=display_ct();>
<span id='ct' ></span></p>
<?php

$userid = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["username"])) 
     {$userid = test_input($_POST["username"]);
   $_SESSION['userlogin']=$userid;}
   
   if (!empty($_POST["password"])) 
     $password = test_input($_POST["password"]);
   }
   

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<center><h1>Share Ur Fare</h1>
<br>
<br>
<div class="container">

        

<form class="form-signin" role="form" method="post" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="captcha.php"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="text" name="vercode"size="6"
<br>
<br> 
<h2 class="form-signin-heading">Please sign in</h2>
<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
         <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>

<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in
</button></form><br>
</div>
<a href="signup.php">Sign Up</a><br>
</form>
<a href ="for_my_password.php">Forgotten your Password?</a>
</center>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='') {
echo "Authentication Error!";
}
 else {
$connect=mysql_connect("localhost","root","pcp10");
if(!$connect)
{
  die("Failed to connect: " . mysql_error());
}
if(!mysql_select_db("iitk")){
die("Failed to select DB:" .mysql_error());
}
$results=mysql_query("SELECT * FROM users");
$user=0;
while($row=mysql_fetch_array($results))
{
  if(strcmp($row["username"],$userid)==0)
{
  $user=1;
  if(strcmp($row["password"],$password)==0){
$_SESSION['loggedin']="Yes";
 header('Location: welcome.php');
exit;
}
  else{
    echo "Wrong password!";
  }
  break;
}}
if($user==0){
echo "User does not exist";}
}
}
?>
<br>
<p align="right"><img src="http://hitwebcounter.com/counter/counter.php?page=5664784&style=0005&nbdigits=8&type=page&initCount=0" title="" Alt="" border="0" >
</a><br/></p>
</body>
</html>
