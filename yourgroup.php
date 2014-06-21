<!DOCTYPE html>
<html>
<head>
 <title>
  My Group
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
require 'connect.inc.php';
$userid=@mysql_real_escape_string($_SESSION['loggedin']);
$sql1="SELECT `notify`,`key` from users WHERE `username`='$userid'";
 if($run=mysql_query($sql1))
 {
  $row=mysql_fetch_assoc($run);
  $noti=$row['notify'];
  $group_id=$row['key'];
 }
 else die();
?>
<style type="text/css">
.col{
color: #6600FF;
font-family: "Lucida Handwriting";
}
h1{ font-family: Magneto;
color:teal;}
.new{color: #0000FF;}
.bau{font-family: "Bradley Hand ITC"-+--+9;color: #330099;}
.align {text-align: center; color: blue;}
.cen {text-align: center;}
.aa{font-family: "Adobe Gothic Std B";color: #0033CC;font-size: 20px;}
body {background-image:url("b1.jpg");
background-repeat: no-repeat;
background-size: cover; }
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}

.gallerycontainer{
position: relative;
/*Add a height attribute and set to largest image's height to prevent overlaying*/
}

.thumbnail img{
border: 2px ridge gray;
margin: 0 5px 5px 0;

}

.thumbnail:hover{
background-color: transparent;
}

.thumbnail:hover img{
border: 1px ridge black;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: #F0F0F0 ;
padding: 5px;
left: -1000px;
border: 5px ridge gray;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail:hover span{ /*CSS for enlarged image*/
visibility: visible;
top: 50px;
width: 500px;
left: 0px; /*position where enlarged image should offset horizontally */
z-index: 50;
}
th,td
{
padding:5px;
}
h1{color:teal;}
.forms{
float: center;
}
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
<li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li class="active"><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>

<li><a href="yourgroup.php" ><span class='thumbnail'> New Notifications: <span>
<?php

$notii=$noti;
echo '<div id="noti" style="float:left;"><br>';
            if($group_id){
            $query4="SELECT * FROM notification WHERE `key`='$group_id' ORDER BY `time` desc LIMIT 10";
            $query5="UPDATE users SET `notify`=0 WHERE `username`='$userid'";
            if($run4=mysql_query($query4))
            {
              if(!mysql_query($query5))
              {
                die();
              }
              
              $i=1;
              //echo 'hi';
              while($row4=mysql_fetch_assoc($run4))
              {
                if($i%2!=0)
                  echo '<div style="color:#0033CC; background-color:#6699FF;font-size:20px; font:bold;">';
                else 
                  echo '<div style="color:#0033CC;font-size:20px; font:bold;">';
                if($row4['code']==0)
                {
                  if($noti>0){
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' left this group at '.$row4['time'].'.<font color="red"><i> (new)!</i></font><br><br>';
                  else
                    echo $i.') You'.' left this group at '.$row4['time'].'.<br><br>';
                    $noti--;}
                    else{
                    if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' left this group at '.$row4['time'].'.<br><br>';
                  else
                    echo $i.') You'.' left this group at '.$row4['time'].'.<br><br>';
                    }  
                    

                }
                else 
                {
                  if($noti>0){
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' joined this group at '.$row4['time'].'<font color="red"><i> (new)!</i></font>.<br><br>';
                  else
                    echo $i.') You'.' joined this group at '.$row4['time'].'.<br><br>';
                  $noti--;
                  }
                  else{
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' joined this group at '.$row4['time'].'.<br><br>';
                  else
                    echo $i.') You'.' joined this group at '.$row4['time'].'.<br><br>';  
                  }
                }
                $i++;
                echo '</div>';
              }
            }}
            else echo 'No Group';
            echo '</div>';
?>


</span><?php if($notii!=0){echo '<font color="red" size="5"><i><b>('.$notii.')</b></i></font>';} else echo '(0)';?></span></a></li>



<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>

</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#">Help</a></li>
<li><a href="navbar-static-top/">About Us</a></li>
<li class="active"><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign-out</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
<br><br>
<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>

<?php
    require 'connect.inc.php';
        $PhoneErr="";


$Phone="";
$check=0;

        if($group_id != 0)
        { 
                if($_SERVER["REQUEST_METHOD"]=="POST")
                {
                  function test($data) {
                   $data = trim($data);
                   $data = stripslashes($data);
                   $data = htmlspecialchars($data);
                   return $data;}
                   $check=$_POST['check'];
                    
                   if(!empty($_POST["Phone"]))
                   {
                      $Phone=test($_POST["Phone"]);
                      if (!preg_match("/^[0-9]*$/",$Phone) || strlen($Phone)!=10){
                         $PhoneErr="only 10 digit phone no. required";}
                         else $PhoneErr="";
                   }
                   
                }

  
if(empty($PhoneErr) && $check==1)
  {

    
    $Phone=@mysql_real_escape_string($_POST["Phone"]);

 $sql="UPDATE groups SET `contact`='$Phone' WHERE `key`='$group_id'"; 

  
     if(!mysql_query($sql))
     {die('Error: '.mysqli_error());}
$message = "Updated sucessfully";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=yourgroup.php">';
    exit;
      @mysql_close();
      $PhoneErr='*';
    }

      




          echo '<a href="notification.php"><span style="float:right;color:red;font-size:20px;"><u>See all Notifications</u></span></a>';
          echo '<div id="table gallerycontainer" style="float:center;">';
            $query2="SELECT * FROM groups WHERE `key`='$group_id'";
            $query3="SELECT * FROM users WHERE `key`='$group_id'";
            echo '<br><h2 style=text-align:center class=bau><b>Travel Plan</b></h2>'; 
            if(mysql_query($query2))
            {
              $run2=mysql_query($query2) or die(mysql_error());
              $row2=mysql_fetch_assoc($run2);
              $ph=$row2['contact'];
              
              if(empty($ph))
                $status='Unbooked';
              else $status='Booked';
              echo '<table style="width:600px; text-align:center;" align="center" class="aa">
<tr style="background-color:#6699FF">
<th>Source</th> <th>Destination</th> <th>Date of Travel</th> <th>Time of Travel</th><th>Status</th>
</tr>
<tr>
<td>'.$row2["source"].'</td> <td>'.$row2["destination"].'</td> <td>'.$row2["date"].'</td> <td>'.$row2["time"].'</td><td>'.$status.
              '</td></tr>
</table>';
              $number=$row2['number'];
            }

?>
<div class="forms">



<center>
<div class="container">
<form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">


<input type="hidden" class="form-control"  name="check" value="1">

</datalist>
<?php if(empty($ph))echo "<input type='text' class='form-control' placeholder='Update Driver`s number' name='Phone' >";
else echo "<input type='text' class='form-control' placeholder='$ph(Driver`s number)' name='Phone' >";

echo $PhoneErr;
?>

<button class="btn btn-lg btn-primary btn-block" type="submit"></span>UPDATE
</button></form>
</div>
</center>

</div>
<?php


            echo '<h2 style=text-align:center class=bau><b>Group Members</b></h2>';
            if(mysql_query($query3))
            {
              $run3=mysql_query($query3) or die(mysql_error());
              echo '<table style="width:600px; text-align:center;" align="center" class="aa">
<tr style="background-color:#6699FF">
<th>S.no</th> <th>Name</th> <th>Email</th> <th>Phone no.</th> <th>Seats Booked</th>
</tr>';
              $count=1;
              while($row3=mysql_fetch_assoc($run3))
              {$pic=$row3["Photo"];
                echo '<tr>
<td>'.$count.'</td><td><a class=thumbnail>'.$row3["name"].'<span><img src="upload/'.$pic.'" width=190 height=220/><br />'.$row3["name"].'('.$row3["gender"].')'.'<br>'.$row3["Address"].'</span></a>'.'</td><td>'.$row3["username"].'@iitk.ac.in</td><td>'.$row3["phone"].'</td><td>'.$row3['book_no'].'</td></tr>';
                $count++;
                if($row3['username']==$userid)
                {
                  $group=$row3['key'];
                  $book_no=$row3['book_no'];
                }
                if($row3["username"]==$userid)
                  $noti=$row3['notify'];
              }
           
              echo '</table>';
              echo "<span class=align><form action='leave_group.php' method='post'>" ."<input type='hidden' name='username' value='$userid'>".
              "<input type='hidden' name='group' value='$group'>"."<input type='hidden' name='number' value='$number'>".
              "<input type='hidden' name='book_no' value='$book_no'>"."<br>".
              "<button type='button submit' class='btn btn-lg btn-danger'>Leave this Group</button>"
            ."</form></span>";
              echo '</div>';
            }

            
        }
        else echo '<span class=bau> <br><br><h2 style="text-align:center; color:red; font-size:40px;"><b>NO GROUP CREATED OR JOINED</b></h2</span> ';
    
?>
</body>
