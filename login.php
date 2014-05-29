<!DOCTYPE HTML> 
<html>
<head>
<style>
body {background-image:url("b1.jpg");}
background-repeat:repeat-x;
{h1:color:blue;}
</style>
<style>
h1
{
text-shadow:  10px 7px 5px #87CEEB;
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
$useridErr = $passwordErr= "";
$userid = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     $useridErr = "Username is required";
   } else {
     $userid = test_input($_POST["username"]);
   }
   
   if (empty($_POST["password"])) {
     $passwordErr = "password is required";
   } else {
     $password = test_input($_POST["password"]);
   }
   }

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<center><h1>SHARE ur FARE</h1>
<br><br><br><br><br><br>
<p><span class="error">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="captcha.php"><br><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="vercode"size="6"<span class="error">*</span><br>
  <br> username: <input type="text" name="username">
   <span class="error">* <?php echo $useridErr;?></span>
   <br><br>
   password: <input type="password" name="password">
   <span class="error">* <?php echo $passwordErr;?></span>
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit"> 
</form><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="signup.php">Sign Up</a><br>
</form>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="for_my_password.php">Forgotten your Password?</a>
</center>
<?php
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
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
<br><br><br>
<p align="right"><img src="http://hitwebcounter.com/counter/counter.php?page=5664784&style=0005&nbdigits=8&type=page&initCount=0" title="" Alt=""   border="0" >
</a><br/></p>
</body>
</html>
