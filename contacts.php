<!DOCTYPE html>
<html>
<head>
<title>
  Contacts
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
        <link href="offcanvas.css" rel="stylesheet">
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}

?>
<style type="text/css">
.contacts{
 float: left;
width: 40%;
color: #006666;
background-color:transparent;
border: 0px solid;

margin-left: 60px;
}
.forms{
  float: left;
width: 40%;
margin-left: 200px;

}

h1.Mag{ font-family: Magneto;
color:#FFE88D;}
b.red{
color:red;
}
.col{
color: #FFEB99;
font-family: "Berlin Sans FB Demi";
}
.a{ font-family: "Adobe Gothic Std B";
background-color: transparent;
}
}
hr{color:blue;}
.new{
font-family: "Copperplate Gothic Bold";color=purple;
}
body {background-image: url("b.jpg");
background-repeat: no-repeat;
background-size: cover;
}
</style>
</head>
<body>
  
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
<li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>
<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
<li><a href="chat.php"><span class="glyphicon glyphicon-comment"></span> Group Chat</a></li>

</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="aboutus.php">About Us</a></li>
<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>Sign-out</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>


<h1 class="Mag" style="text-align:Center;"><b>Share Ur Fare</b></h1>
<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>
<div class="contacts">

<div class="table-responsive ">
    <table class="table table-striped a">
       <thead>
       <col width="20">
       <col width="90">
       <col width="90">
       <col width="90">

       <tr>
       <th>#</th>
       <th>Phone</th>
       <th>Vehicle</th>
       <th>Name</th>
       </tr>
       </thead>
    </table>
</div>

<div class="table-responsive ">

  <marquee behavior="scroll" direction="up" scrollamount="9" height="470" onmouseover="this.stop();" onmouseout="this.start();">
    <table class="table table-striped a">
      <tbody>
      <col width="20">
      <col width="90">
      <col width="90">
       <col width="90">

<?php
require 'connect.inc.php';
 $sql="SELECT * FROM drivers ORDER BY Type ";
  $i=0;
  if(mysql_query($sql))
  {
      $query_run=mysql_query($sql);
       
      while($row=mysql_fetch_assoc($query_run))
       { 
        $phone=$row["Phone"];
        $type=$row["Type"];
        $name=$row["Name"];
        if(empty($name))$name="-";
          echo
                "<tr>".
                  "<td>".($i+1)."</td>".
                  "<td>".$phone."</td>".
                  "<td>".$type."</td>".
                  "<td>".$name."</td>".
                  
            
                  "<tr>";
                  ++$i;
            }
          } 

      else
  {echo'invalid query';}

                  
?>


                  
         </tbody> 
</table>
</marquee>
</div></div>



<div class="forms">
  <br><br><br><br><br><br><br>
  <h3 class="form-signin-heading col">  &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Know a Driver? ADD HIM !</h3>
   <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" method ="POST">


          <input type="text" class="form-control" placeholder="Name" name="dri" >
          <select type="text" class="form-control" placeholder="Vehicle" name="gadi" required>
            <option value="">Enter Vehicle Type</option>
            <option value="Auto-Rickshaw">Auto-Rickshaw</option>
            <option value="Vikram Tempo">Vikram Tempo</option>
          </select>
         <input type="number" class="form-control" placeholder="Phone Number" name="pho" >
         
<br>
         <button class="btn btn-lg btn-danger btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> &#160;SUBMIT
         </button>
   </form>
</div>
<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
  $con = @mysqli_connect('localhost','root','pcp10','iitk');
    if(mysqli_connect_errno()){
      echo"Failed to connect to MYSQL: ".mysqli_connect_error;
      }
    $name=@mysqli_real_escape_string($con,$_POST["dri"]);
    $vehicle=@mysqli_real_escape_string($con,$_POST["gadi"]);
    $pho=@mysqli_real_escape_string($con,$_POST["pho"]);
    $sql="INSERT INTO drivers (`Name`, `Phone`, `type`) VALUES ('$name','$pho','$vehicle')";

if(!mysqli_query($con,$sql))
     {die('Error: '.mysqli_error($con));}
     @mysqli_close($con);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     }
      
?>
</body>
</html>










