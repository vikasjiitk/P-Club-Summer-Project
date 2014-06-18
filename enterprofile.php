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
Profile
</title>
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
<style>
body {background-image:url("beach.jpg");}
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
<center><h1>Share Ur Fare</h1><br><br>

<?php
$nameErr="*";
$genErr=$PhoneErr="";

$err="Fill all details";
$gen=$name=$Phone=$username="";
$username=$_SESSION['loggedin'];
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
<h2 class="form-signin-heading">Create  your  Profile</h2>
<input type="text" class="form-control" placeholder="Name" name="name">

<input class="form-control" placeholder="Gender" list="gender" name="gender">

<datalist id="gender">
<option value ="Male">
<option value ="Female"">

</datalist>
<input type="number" class="form-control" placeholder="Phone Number(recommended)" name="Phone" >
<br>


<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> &#160;Create
</button></form><br>
</div>
</span>




<?php
if( empty($genErr)&& empty($nameErr) && empty($PhoneErr))
  {
    
    $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }

    $name=@mysqli_real_escape_string($con,$_POST["name"]);
    
    $Phone=@mysqli_real_escape_string($con,$_POST["Phone"]);
    
    if(strcmp($_POST['gender'],"Male")==0)
  $gender='M';
else $gender='F';
    $gen=@mysqli_real_escape_string($con,$gender);
    $usr=$_SESSION['loggedin'];
    $male="m.jpg";
    $female="f.jpg";
    if(strcmp($gender,'M')==0)
    $sql="INSERT INTO users (`name`,`gender`, `phone`,`username`,`Photo`)
VALUES('$name','$gen','$Phone','$username','$male')";
 else $sql="INSERT INTO users (`name`,`gender`, `phone`,`username`,`Photo`)
VALUES('$name','$gen','$Phone','$username','$female')";
    
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
$message = "Created sucessfully";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
    exit;
      @mysqli_close($con);
      $nameErr="*";
      $PhoneErr='*';
    }
    ?>

</body>
</html>
