<!DOCTYPE html>
<html>
<head>
<title>
  SHARE Ur FARE
 </title>
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
    
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
<style type="text/css">
h1{ font-family: Magneto;
	color:teal;}
	b.red{
		color:red;
	}
	hr{color: red}
	body {background-image:url("b1.jpg");}
.id1{ color:goldenrod; font-size: 22px; }
.id1:hover{ color:gold; }
.id2:hover{ color:indigo; }
.id3{ color:olivedrab; font-size: 22px; }
.id3:hover{ color:yellowgreen; }
.id4{ color:mediumslateblue; font-size: 15px; }
.id4:hover{ color:gold; }
.id5:{ color:gold font-size: 12px; }
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
          <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome1.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="#about"><span class="glyphicon glyphicon-phone-alt"></span>  Contacts</a></li>
            <li><a href="#contact"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Sign-out</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Help</a></li>
            <li><a href="../navbar-static-top/">About Us</a></li>
            <li class="active"><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>  Sign-out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>

<h3 class="form-signin-heading">Please fill the following details.</h3>
<form class="form-signin" action="result.php" role="form" method ="POST">

<input type="text" class="form-control" placeholder="Source" name="source" required autofocus>
        <br><input type="text" class="form-control" placeholder="Destination" name="destination" required>
        <br><input type="date"  onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control" placeholder="Date Of Journey" name="date" required>
        <br><input type="time"  onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control" placeholder="Time" name="time" required>
        <br><input type="time" type="text" onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control" placeholder="Time Variation" name="variation" required>
        <br><input class="form-control" placeholder="Type of vehicle" list="vehicle" name="vehicle">

<datalist id="vehicle">
<option value="Auto">
<option value="Vikram">
<option value="Any">
</datalist>
 <br><input type="number" class="form-control" placeholder="Number Of People" name="number" required>
       <br>  <font class= "id4">Gender Specific: </font>
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="female");?>
value="female">Female
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="male");?>
value="male">Male
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="any");?>
value="any">Any
   <br><br>
   <button class="btn btn-lg btn-primary btn-block" type="submit">Submit
</button></form>








</body>
</html>
