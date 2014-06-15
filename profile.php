<!DOCTYPE html>
<html>

<head>
<title>Profile</title>


<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
<link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
    <link href="welcome.css" rel="stylesheet">

<style type="text/css">
h1{ font-family: Magneto;
    color:teal;}
    b.red{
        color:red;
    }
  .col{
    color: #6600FF;
    font-family: "Lucida Handwriting";
  }
  }
    hr{color:blue;}
    body {background-image:url("b1.jpg");}

</style>


</head>

<body style="background-color:lavender;">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['loggedin']?> !</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>
<li><a href="#about"><span class="glyphicon glyphicon-phone-alt"></span> Contacts</a></li>
<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="#">Notifications</a></li>
<li><a href="http://www.facebook.com">Help</a></li>
<li class="divider"></li>
<li class="dropdown-header">Account</li>
<li><a href="#">About Us</a></li>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#">Help</a></li>
<li><a href="navbar-static-top/">About Us</a></li>
<li class="active"><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign-out</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>
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
<h2 class="form-signin-heading">Profile</h2>
<input type="text" class="form-control" placeholder="Name" name="name">

<input class="form-control" placeholder="Gender" list="gender" name="gender">

<datalist id="gender">
<option value ="Male">
<option value ="Female"">

</datalist>
<input type="number" class="form-control" placeholder="Phone Number(recommended)" name="Phone" >
<br>

<button class="btn btn-lg btn-primary btn-block" type="submit"></span>UPDATE
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
    $sql="UPDATE users SET `name`='$name',`gender`='$gen',`phone`='$Phone'
 WHERE `username`='$username'";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
$message = "Updated sucessfully";
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
