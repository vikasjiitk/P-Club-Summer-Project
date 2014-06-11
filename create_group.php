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
 
  <style type="text/css">
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
  <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
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
          <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome1.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
            <li><a href="#about"><span class="glyphicon glyphicon-phone-alt"></span>  Contacts</a></li>
            <li><a href="#contact"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>

            
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
            <li class="active"><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>  Sign-out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>


<span><h3 class="col">&#160;&#160;&#160;&#160;&#160;&#160;Create ur group</h3></span>
<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" method ="POST">

<input type="text" class="form-control" placeholder="Source" name="source" required autofocus>
        <input type="text" class="form-control" placeholder="Destination" name="destination" required>
<input type="date"  onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control" placeholder="Date Of Journey" name="date" required>
<input type="time"  onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control" placeholder="Time" name="time" required>
<br>
<font class= "gender"><abbr title="Any specific gender you want to share your fare with?">Gender specific: </abbr>
</font><br>
<input type="radio" name="gender" value="F">Only Female(for females only)<br>
<input type="radio" name="gender" value="M">Only Male(for males only)<br>
<input type="radio" name="gender" value="B">both<br><br>
<select class="form-control" name="vehicle">
<option value="AUTO">AUTO-RICKSHAW</option>
<option value="VIKRAM">VIKRAM TEMPO</option>
<option value="ANY">ANY</option>
</select>


<input type="number" name="number" class="form-control" placeholder="No. of people you are booking for ">
<input type="number" name="limit" class="form-control" placeholder="Limit group to "><br><br>

<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> &#160;Create Group
</button>
</form>
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
    if(empty($limit))
    {
      if($vehicle=='AUTO')
        $limit=3;
        else
        $limit=7;
    }
     $limit_no=@mysqli_real_escape_string($con,$limit);
    $sql="INSERT INTO groups (`source`, `destination`, `date`, `time`, `gender`, `vehicle`,`number`,`limit`)
VALUES('$source','$destination','$date','$time','$gender','$vehicle','$number','$limit_no')";
     if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
      $userid=@mysqli_real_escape_string($con,$_SESSION['loggedin']);
     $key=mysqli_insert_id($con);
    $sql1="UPDATE users SET `key`= '$key',`book_no`='$number' WHERE `id`='$userid' ";
      if(!mysqli_query($con,$sql1))
     {die('Error: '.mysqli_error($con));}
     echo '<br>' . "<h3>Welcome to share your fare</h3>" . '<br>';
     @mysqli_close($con);}
      ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
