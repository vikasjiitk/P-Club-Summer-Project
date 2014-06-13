<html>
<head>
  <title>groups</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/bootstrap-theme.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <link href="theme.css" rel="stylesheet">

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
.my{color: red; font-size: 15pt;}
.align{text-align: center; }
body {background-image:url("b1.jpg");}

.bau{font-family: "Bradley Hand ITC";color: #330099;
}
.aa{font-family: "Adobe Gothic Std B";color: #0033CC;}
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
<a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['userlogin']?> !</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>
<li><a href="#about"><span class="glyphicon glyphicon-phone-alt"></span> Contacts</a></li>
<li><a href="#contact"><span class="glyphicon glyphicon-user"></span> Profile</a></li>

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




          <h2 class="sub-header bau"><b>Available Groups</b></h2>
          <div class="table-responsive">
            <table class="table table-striped aa">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Source</th>
                  <th>Destination</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Gender</th>
                  <th>Seats</th>
                  <th>Available</th>
                  <th>Vehicle</th>
                  <th>Join?</th>
                </tr>
              </thead>
          <tbody>


<?php
require 'connect.inc.php';
if($_SERVER["REQUEST_METHOD"]=='POST')
{
  $desti=$_POST["destination"];
  $source=$_POST["source"];
  $time=$_POST["time"];
  $date=$_POST["date"];
  $var=$_POST["variation"];
  //$gend=$_POST['gender'];
  $veh=$_POST["vehicle"];
  $book_no=$number=$_POST["number"];

  $time1=strtotime($time);
  $time2=strtotime($time)+$var*60*60;
  $sql="SELECT * FROM groups WHERE source='$source' and destination='$desti'";
  if(mysql_query($sql))
  {
      $query_run=mysql_query($sql);
      while($row=mysql_fetch_assoc($query_run))
       {
          $date1=date_create($row['date']);
          $date2=date_create($date);
          $diff=date_diff($date2,$date1);
          $difference=$diff->format("%R%a");
          $difference*=86400;
          $t=abs(strtotime($row['time'])-$time1+$difference);
          $key=$row['key'];
          $sql2="UPDATE groups SET `time_diff`='$t' WHERE `key`='$key'";
           if(mysql_query($sql2))
              {
                $query_run1=mysql_query($sql2);
              }
        }
    }
      $var*=3600;
     $sql3="SELECT * FROM groups WHERE source='$source' and destination='$desti' and time_diff<='$var' ORDER BY time_diff";
     if(mysql_query($sql3))
      {
        $query_run2=mysql_query($sql3);
        $i=0;
         if(mysql_num_rows($query_run2)==0)
          {
           echo '<span class=my>';
           echo "SORRY! NO GROUPS AVAILABLE";
           echo '</span>';
          } 
          while($row=mysql_fetch_assoc($query_run2))
          {
            echo 
                "<tr>".
                  "<td>".($i+1)."</td>".
                  "<td>".$source."</td>".
                  "<td>".$desti."</td>".
                  "<td>".$row['date']."</td>".
                  "<td>".$row['time']."</td>".
                  "<td>".$row['gender']."</td>".
                  "<td>".$row['limit']."</td>".
                  "<td>".($row['limit']-$row['number'])."</td>".
                 "<td>".$row['vehicle']."</td>".
                 "<td>";
                
              $key=$row['key'];
              $limit=$row['limit'];
              $number+=$row['number'];
              $gender=$row['gender'];
             echo "<form action='join_group.php' method='post'>" ."<input type='hidden' name='group' value='$key'>".
    "<input type='hidden' name='number' value='$number'>"."<input type='hidden' name='limit' value='$limit'>".
    "<input type='hidden' name='gender' value='$gender'>"."<input type='hidden' name='book_no' value='$book_no'>".
    "<button type='button submit' class='btn btn-lg btn-default'  name='join_group' value='Join Group'>Join Group</button>"."</form>"."</td>".
                "</tr>";
              $i++;
          }
  

      }

      else
  {echo'invalid query';}
    }

?>
</tbody>
</table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
</body>
</html>
