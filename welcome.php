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
        <link href="offcanvas.css" rel="stylesheet">
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
<style type="text/css">
.forms{
float: left;
width: 400px;
}
.newsfeed{
float: left;
width: 800px;
color: #006666;
}
h1.Mag{ font-family: Magneto;
color:teal;}
b.red{
color:red;
}
.col{
color: #6600FF;
font-family: "Lucida Handwriting";
}
.a{ font-family: "Adobe Gothic Std B";}
}
hr{color:blue;}
.new{
  font-family: "Copperplate Gothic Bold";color=purple;
}
body {background-image:url("b1.jpg");}

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

<h1 class="Mag" style="text-align:Center;"><b><ins>Share Ur Fare</ins></b></h1>
<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>

<div class="forms">

<h3 class="form-signin-heading col"> &#160;&#160;&#160;&#160;&#160;&#160;&#160;SEARCH FOR A GROUP</h3>
<form class="form-signin" action="group_search.php" role="form" method ="POST">

<select class="form-control" placeholder="Source" name="source" >
<option value="">Enter Source</option>
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
</select>


<br><select class="form-control" placeholder="Destination" name="destination" >
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
</select>
<br><input type="date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control" placeholder="Date Of Journey" name="date">
<br><input type="time" onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control" placeholder="Time" name="time" >
<br><input type="number" step="0.5" min="0" onfocus="(this.type='number')" onblur="(this.type='number')" class="form-control" placeholder="Time Variation (in hrs)" name="variation" >
<br><input type="number" min="1" class="form-control" placeholder="Number Of People" name="number" >
<br><input type="hidden" name="check" value="1">
<button class="btn btn-lg btn-primary btn-block" type="submit">Find Group
</button></form>
</div>
<div class="newsfeed">
<h1 class=new>NEWSFEED</h1>
<br>
<div class="table-responsive">
<table class="table table-striped a">
<thead>
  <col width="25">
  <col width="90">
  <col width="130">
  <col width="120">
  <col width="100">
  <col width="80">
<tr>
<th>#</th>
<th>Source</th>
<th>Destination</th>
<th>Date</th>
<th>Time</th>
<th>Join?</th>
</tr>
</thead>
</table>
  </div>
<marquee behavior="scroll" direction="up" scrollamount="4" height="360"  onmouseover="this.stop();" onmouseout="this.start();">

<p>
<div class="table-responsive">
<table class="table table-striped a">
<tbody>
  <col width="25">
  <col width="90">
  <col width="130">
  <col width="120">
  <col width="100">
  <col width="80">
<?php
require 'connect.inc.php';
 $sql="SELECT * FROM groups";
  if(mysql_query($sql))
  {
      $query_run=mysql_query($sql);
      while($row=mysql_fetch_assoc($query_run))
       {
          
          $date1=strtotime($row['date']);
          $t=$date1+strtotime($row['time'])-strtotime('00:00:00');
          $key=$row['key'];
          $sql2="UPDATE groups SET `time_diff`='$t' WHERE `key`='$key'";
           if(mysql_query($sql2))
              {
                $query_run1=mysql_query($sql2);
              }
        }
    }
 $sql3="SELECT * FROM groups ORDER BY time_diff LIMIT 20";
 if(mysql_query($sql3))
      {
        $query_run2=mysql_query($sql3);
        $i=0;
         if(mysql_num_rows($query_run2)==0)
          {
            echo '</marquee>';
           echo '<span>';
           echo "NO GROUPS AVAILABLE!";
           echo '</span>';
          }
          while($row=mysql_fetch_assoc($query_run2))
          {
            echo
                "<tr>".
                  "<td>".($i+1)."</td>".
                  "<td>".$row['source']."</td>".
                  "<td>".$row['destination']."</td>".
                  "<td>".$row['date']."</td>".
                  "<td>".$row['time']."</td>".
                  "<td>";
                
              $key=$row['key'];
              $limit=$row['limit'];
              $number=$row['number']+1;
              $gender=$row['gender'];
             echo "<form action='group_search.php' method='post'>" ."<input type='hidden' name='check' value='0'>".
             "<input type='hidden' name='limit' value='$limit'>".
    "<input type='hidden' name='key' value='$key'>".
    "<button type='button submit' class='btn btn-lg btn-default' name='join_group' value='Join Group'>Join</button>"."</form>"."</td>".
                "</tr>";
              $i++;
          }
  

      }

      else
  {echo'invalid query';}
       ?>
</tbody>
</table>
</div>
</p>
</marquee>
</div><!--/span-->
</div><!--/row-->
</div><!--/span-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
