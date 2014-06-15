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
input{
   text-align:center;
}
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
<h2 class="form-signin-heading">Please sign in</h2>
<img src="captcha.php"><br>


<br>
<input type="text"  placeholder="captcha" name="vercode" size="15" required autofocus>
<br><br>

<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        
          <input type="checkbox" value="remember-me"> Remember me
        

<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in
</button></form><br>
</div>

</center>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='') {
echo "Authentication Error!";
}
 else {

$ftp_server = "webhome.cc.iitk.ac.in";
  $ftp_user = $_POST['username'];
  $ftp_pass = $_POST['password'];

  $_SESSION['username']=$ftp_user;
  $_SESSION['password']=$ftp_pass;
  // set up a connection or die
  $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

  // try to login
  if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    /*$_SESSION['loggedin']=$row["id"];
 header('Location: welcome.php');
exit;
  } */
  $_SESSION['loggedin']=$ftp_user;

      //include 'welcome.php';
    header('Location: welcome.php');
    }

  else {
      echo "Your Username & Password isn't a valid combination to take to the Wall";
    ftp_close($conn_id);  
  }
}}
/*
$connect=mysql_connect("localhost","root","pcp10");
if(!$connect)
{
  die("Failed to connect: " . mysql_error());
}
if(!mysql_select_db("iitk")){
die("Failed to select DB:" .mysql_error());
}
$results=mysql_query("SELECT * FROM users WHERE username='$userid'");  
while($row=mysql_fetch_assoc($results))
{
  if(strcmp($row["username"],$userid)==0)
{
  $user=1;
  if(strcmp($row["password"],$password)==0){
$_SESSION['loggedin']=$row["id"];
 header('Location: welcome.php');
exit;
}
  else{
    echo "Wrong password!";
  };}}}


  break
}
?>*/
?>


<br><br><br><br>
<p align="right"><img src="http://hitwebcounter.com/counter/counter.php?page=5664784&style=0005&nbdigits=8&type=page&initCount=0" title="" Alt="" border="0" >
</a><br/></p>
</body>
</html>
