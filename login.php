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
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <script src="modernizr.custom.63321.js"></script>
    
    
<style>
body {background-image:url("b5.jpg");}
background-repeat:repeat-x;
{h1:color:blue;}

.bg {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -5000;
}
</style>
<style>
h1.ab
{
font-family: Magneto;
font-size: 50px;

}
</style>
<style>
.error {color: #FF0000;}
body {
        background: #7f9b4e url(a1.jpg) no-repeat center top;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
      }
      .container > header h1,
      .container > header h2 {
        color: #fff;
        text-shadow: 0 1px 1px rgba(0,0,0,0.7);
      }
</style>
<script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-7243260-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

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
<body class="bg" onload=display_ct();>
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
<center><h1 class="ab" style="color:#D6AD33;">Share Ur Fare</h1></center>
<br>
<br>
<section class="main">
        <form class="form-4" role="form" method="post">
            <h1 style="color:#ADAD85;">Login or Register</h1>
            <p>
                <label for="login">Username or email</label>
                <input type="text" name="username" placeholder="CC Username" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name='password' placeholder="CC Password" required> 
            </p>

            <p>
                <input type="submit" name="submit" value="Sign-in">
            </p>       
        </form>​
      </section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$ftp_server = "webhome.cc.iitk.ac.in";
  $ftp_user = $_POST['username'];
  $ftp_pass = $_POST['password'];

  $_SESSION['username']=$ftp_user;
  $_SESSION['password']=$ftp_pass;
  // set up a connection or die
  $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 
  // try to login
  if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    
  $_SESSION['loggedin']=$ftp_user;
          require 'connect.inc.php';
          $query = "SELECT `username` from `users` WHERE `username`='$ftp_user'";
          if($query_run=mysql_query($query))
          {
          if(mysql_fetch_assoc($query_run))
          header('Location: welcome.php');
          else
    header('Location: enterprofile.php');
    }}

  else {
       echo "<div class='container'>"."<form class='form-signin' role='form'>"."<center>".
"<button class='btn btn-lg btn-warning' disabled>Incorrect Username/Password
</button>"."</center>"."</form>".

"</div>";
    ftp_close($conn_id);  
  }
}
?>
<br><br><br><br><br><br><br>
<p align="right"><img src="http://hitwebcounter.com/counter/counter.php?page=5664784&style=0005&nbdigits=8&type=page&initCount=0" title="" Alt="" border="0" >
</a><br/></p>

</body>
</html>
