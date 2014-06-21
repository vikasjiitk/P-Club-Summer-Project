<html> 
<head>
  <title>Create Group</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
    <link href="welcome.css" rel="stylesheet">
         <link href="offcanvas.css" rel="stylesheet">
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
require 'connect.inc.php';
$userid=@mysql_real_escape_string($_SESSION['loggedin']);
$sql2="SELECT `key` from users WHERE `username`='$userid'";
 if($run=mysql_query($sql2))
 {
  $row=mysql_fetch_assoc($run);
  if($row['key']!=0)
   {$message = "Sorry!.You are already in a group.";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     exit;
   }
   } 
?>
  <style type="text/css">
  body {background-image: url("b1.jpg");
background-repeat: no-repeat;
background-size: cover;
}
  .create{
    margin-left: 20%;
  }  
   .col{
    color: #6600FF;
    font-family: "Lucida Handwriting";
  }
  h1{ font-family: Magneto;
  color:teal;}h1{ font-family: Magneto;
  color:teal;}
  .align {text-align: center; color: blue;}
  .cen {text-align: center;}
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
          <a class="navbar-brand" href="welcome.php">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li class="active"><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
           <li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span>  Your Group</a></li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>
            <li><a href="chat.php"><span class="glyphicon glyphicon-comment"></span> Group Chat</a></li>

            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="contacts.php"><span class="glyphicon glyphicon-phone-alt"></span>Contacts</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>Sign-out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>


<div class="create"><span><h3 class="col">&#160;&#160;&#160;&#160;&#160;&#160;Create ur group</h3></span>
<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" method ="POST">


<select class="form-control" placeholder="Source" name="source" onchange='CheckInput(this.value);' required>
<option>Enter Source</option>
<option value="Allen Zoo">Allen Zoo</option>
<option value="Gumti">Gumti</option>
<option value="IITK">IITK</option>
<option value="JK Temple">JK Temple</option>
<option value="Kanpur Central">Kanpur Central</option>
<option value="Kalyanpur">Kalyanpur</option>
<option value="Moti Jheel">Moti Jheel</option>
<option value="Rawatpur">Rawatpur</option>
<option value="Rave 3">Rave 3</option>
<option value="Rave Moti">Rave Moti</option>
<option value="Z Square">Z Square</option>
<option value="others">Others</option>
</select>
<input type="text" name="source" id="source" class="form-control" placeholder="Enter Source" style='display:none;'/ required>
<select class="form-control" placeholder="Destination" name="destination" onchange='CheckInput1(this.value);'required>
              <option value="">Enter Destination</option>
              <option value="Allen Zoo">Allen Zoo</option>
              <option value="Gumti">Gumti</option>
              <option value="IITK">IITK</option>
              <option value="JK Temple">JK Temple</option>
              <option value="Kanpur Central">Kanpur Central</option>
              <option value="Kalyanpur">Kalyanpur</option>
              <option value="Moti Jheel">Moti Jheel</option>
              <option value="Rawatpur">Rawatpur</option>
              <option value="Rave 3">Rave 3</option>
              <option value="Rave Moti">Rave Moti</option>
              <option value="Z Square">Z Square</option>
            <option value="others">Others</option>
            </select>
<input type="text" name="destination" id="destination" class="form-control" placeholder="Enter destination" style='display:none;'/ required>
<input type="date"  onblur="(this.type='text')" onfocus="(this.type='date')" min="2014-06-20" class="form-control" placeholder="Date Of Journey" name="date" required>
<input type="time"  onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control" placeholder="Time" name="time" required>
<select class="form-control" name="gender" required>
<option value="">--Gender Specificness--</option>
<option value="B">Both</option>
<option value="M">Only Males</option>
<option value="F">Only Females</option>
</select>
<select class="form-control" name="vehicle">
  <option value="">--select vehicle type--</option>
<option value="AUTO">AUTO-RICKSHAW</option>
<option value="VIKRAM">VIKRAM TEMPO</option>
<option value="ANY">ANY</option>
</select>
<input type="number" name="number" min="1" class="form-control" placeholder="No. of people you are booking for " required>
<input type="number" name="limit" min="1" max="7" class="form-control" placeholder="Limit group to "><br><br>

<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> &#160;Create Group
</button>
</form></div>
<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
  $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }
    $source=@mysqli_real_escape_string($con,$_POST["source"]);
    $destination=@mysqli_real_escape_string($con,$_POST["destination"]);
    $date=@mysqli_real_escape_string($con,$_POST["date"]);
    $time=@mysqli_real_escape_string($con,$_POST["time"]);
    $gender=@mysqli_real_escape_string($con,$_POST["gender"]);
    $vehicle=@mysqli_real_escape_string($con,$_POST["vehicle"]);
    $number=@mysqli_real_escape_string($con,$_POST["number"]);
    $limit=$_POST["limit"];
      if(empty($limit)){
      if($vehicle=='AUTO')
         $limit=3;
      else if($vehicle=="VIKRAM")
         $limit=7;   
    }
    $limit_no=@mysqli_real_escape_string($con,$limit);
    $sql="INSERT INTO groups (`source`, `destination`, `date`, `time`, `gender`, `vehicle`,`number`,`limit`)
VALUES('$source','$destination','$date','$time','$gender','$vehicle','$number','$limit_no')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
      $username=@mysqli_real_escape_string($con,$_SESSION['loggedin']);
     $key=mysqli_insert_id($con);
    $sql1="UPDATE users SET `key`= '$key',`book_no`='$number' WHERE `username`='$username' ";
      if(!mysqli_query($con,$sql1))
     {die('Error: '.mysqli_error($con));}
     echo '<br>' . "<h3>Welcome to share your fare</h3>" . '<br>';
     @mysqli_close($con);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     }
      ?>
<script type="text/javascript">
function CheckInput(val){
 var element=document.getElementById('source');
 if(val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}
function CheckInput1(val){
 var element=document.getElementById('destination');
 if(val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
