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

b.red{
color:red;
}

}
hr{color:blue;}
body {background-image:url("ooo.jpg");
background-repeat: no-repeat;
background-size: cover; }
.pic{
  margin-left: 200px;
float: left;
width: 290px;
color: #006666;
}
.forms{
float: left;
width: 400px;
}
.new{
font-family: "Gungsuh";
}

h1.Mag{ font-family: Magneto;
color:#FFCC00;}
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
          <a class="navbar-brand" href="welcome.php">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
           <li ><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span>  Your Group</a></li>
            <li class="active"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>
            <li ><a href="chat.php"><span class="glyphicon glyphicon-comment"></span> Group Chat</a></li>
           
            </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>  Sign-out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
<h1 style="text-align:Center;" class="Mag"><b>Share Ur Fare</b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>
<?php

require 'connect.inc.php';
$userid=@mysql_real_escape_string($_SESSION['loggedin']);
 $query="SELECT * FROM users WHERE `username`='$userid' ";
 if(mysql_query($query))
      {
      //echo 'success';
      $run=mysql_query($query) or die(mysql_error());
      $row=mysql_fetch_assoc($run);
      $nam=$row["name"];
      $gender=$row["gender"];
      $ph=$row["phone"];
      $pic=$row["Photo"];
      $Add=$row["Address"];
      $male="m.jpg";
      $female="f.jpg";
    
}

$nameErr=$genErr=$PhoneErr="";


$name=$Phone=$username=$addr="";
$username=$_SESSION['loggedin'];
$check=0;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$check=$_POST['check'];
if(!empty($_POST["name"]))
{
         $name=test($_POST["name"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$name))
         $nameErr = "*Only letters and white space allowed";
         else $nameErr="";
      }
      


   if(!empty($_POST["Phone"]))
      
   
   {
      $Phone=test($_POST["Phone"]);
      if (!preg_match("/^[0-9]*$/",$Phone) || strlen($Phone)!=10){
        
         $PhoneErr="only 10 digit phone no. required";}
         else $PhoneErr="";
       
   }
if(!empty($_POST["addr"]))
   {
         $addr=test($_POST["addr"]);
    }

   //echo 'phone' . $PhoneErr;
   
}
function test($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;}
  ?>
  <div class="pic">
  <br>
  <h3 class="new" style="color:#FFCC66;">Profile Picture</h3>
  <image src="upload/<?= $pic?>" height=200px width=190px />
<form action="upload_file.php" method="post"
enctype="multipart/form-data">

<input type="file" name="file" id="file"><br>

<input type="submit" name="submit" value="Submit">

</form><br>
<form action="remove_file.php" method="post"
enctype="multipart/form-data">
<input type="submit" name="submit" value="Remove Photo">
</form>
<p id="demo"></p>
</div>

<div class="forms">
<span class=align>



<div class="container">
<form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<h2 class="form-signin-heading new" style="color:#FFCC66;"><b>Profile</b></h2>
<input type="text" class="form-control" placeholder="<?= $nam?>" name="name">
<input type="hidden" class="form-control"  name="check" value="1">



</datalist>
<input type="text" class="form-control" placeholder="<?= $Add?>" name="addr">
<?php if($ph=="")
echo'<input type="text" class="form-control" placeholder="Phone Number(Recommended)" name="Phone" >';
else
echo '<input type="text" class="form-control" placeholder="'.$ph.'" name="Phone" >';
?>
<br>

<button class="btn btn-lg btn-primary btn-block" type="submit"></span>UPDATE
</button></form><br>
</div>
</span>
</div>
<?php
if(empty($PhoneErr) && empty($nameErr) && $check==1)
  {
    
    $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }

    $name=@mysqli_real_escape_string($con,$_POST["name"]);
    
    $Phone=@mysqli_real_escape_string($con,$_POST["Phone"]);
    
    $addr=@mysqli_real_escape_string($con,$_POST["addr"]);
        if($name=="")
      $name=$nam;
    
    if($Phone=="")$Phone=$ph;
     if($addr=="")$addr=$Add;
 $sql="UPDATE users SET `name`='$name',`phone`='$Phone',`Address`='$addr' WHERE `username`='$username'"; 

  
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=profile.php">';
    exit;
      @mysqli_close($con);
      $nameErr="*";
      $PhoneErr='*';
    }
    ?>

</body>
</html>
