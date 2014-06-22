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
@import url("style1.css");
.col{
color: #6600FF;
font-family: "Lucida Handwriting";
}
h1{ font-family: Magneto;
color:teal;}

.bau{font-family: "Bradley Hand ITC"-+--+9;color: #330099;}
.align {text-align: center; color: blue;}
.cen {text-align: center;}
.aa{font-family: "Adobe Gothic Std B";color: #0033CC;font-size: 20px;}
body {background-image: url("ooo.jpg");
background-repeat: no-repeat;
background-size: cover;}

.gallerycontainer{
position: relative;
/*Add a height attribute and set to largest image's height to prevent overlaying*/
}
h2.in{
  text-align: center;
}
.thumbnail img{
border: 2px ridge gray;
margin: 0 5px 5px 0;

}
.red{
  color: red;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: transparent; ;
padding: 5px;
left: -1000px;
font-family:"Berlin Sans FB";
text-align: center;
font-size: 20px;
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
top: 520px;
width: 50px;
left: 0px; /*position where enlarged image should offset horizontally */
z-index: 50;
}
.thumbnail1 img{
border: 2px ridge gray;
margin: 0 5px 5px 0;

}

.thumbnail1:hover{
background-color: transparent;
}



.thumbnail1 span{ /*CSS for enlarged image*/
position: absolute;
background-color: white  ;
padding: 5px;
left: -1000px;

border: 2px solid gray;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail1:hover span{ /*CSS for enlarged image*/
visibility: visible;
top: 50px;
width: 400px;
left: 0px; /*position where enlarged image should offset horizontally */
z-index: 50;
}

#noti{
  font-family: "Adobe Gothic Std B";
}
h1{color:teal;}
.forms{
float: center;
}
.new{
  font-family: "Gungsuh";
color:#FFCC66;
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
<a class="navbar-brand" href="welcome.php">Welcome <?php echo $_SESSION['loggedin']?> !</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li class="active"><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>

<li><a href="yourgroup.php" ><span class='thumbnail1' >  Notifications: <span>
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
                  echo '<div style="color:black; background-color:#FF9999;font-size:15px;" >';
                else 
                  echo '<div style="color:black;font-size:15px;">';
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
<li><a href="contacts.php"><span class="glyphicon glyphicon-phone-alt"></span>Contacts</a></li>
<li><a href="#">Help</a></li>
<li><a href="aboutus.php">About Us</a></li>
<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign-out</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<h1 style="text-align:Center; color:#FFCC00;" ><b>Share Ur Fare</b></h1>

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
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=yourgroup.php">';
    exit;
      @mysql_close();
      $PhoneErr='*';
    }

      




          echo '<a href="notification.php"><span style="float:right;color:#FFFFCC;font-size:20px;"><u>See all Notifications</u></span></a>';
          
            $query2="SELECT * FROM groups WHERE `key`='$group_id'";
            $query3="SELECT * FROM users WHERE `key`='$group_id'";
            echo '<br><br><h2 class="new" style="text-align:center;"><b>Travel Plan</b></h2>'; 
            if(mysql_query($query2))
            {
              $run2=mysql_query($query2) or die(mysql_error());
              $row2=mysql_fetch_assoc($run2);
              $ph=$row2['contact'];
              
              if(empty($ph))
                $status='Unbooked';
              else $status='Booked';
              echo '<center><table style="width:600px;text-align:center;" id="gradient-style">
<tr style="background-color:#6699FF">
<th scope=col>Source</th> <th scope=col>Destination</th> <th scope=col>Date of Travel</th> <th scope=col>Time of Travel</th><th scope=col>Status</th>
</tr>
<tr>
<td>'.$row2["source"].'</td> <td>'.$row2["destination"].'</td> <td>'.$row2["date"].'</td> <td>'.$row2["time"].'</td><td>'.$status.
              '</td></tr>
</table></center>';
              $number=$row2['number'];
            }


?>

<center>
<div class="container">
<form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">


<input type="hidden" class="form-control"  name="check" value="1">


 <?php if(empty($ph))echo '<input type="text" class="form-control" placeholder="Update Driver`s number" name="Phone" >';
else echo "<input type='text' class='form-control' placeholder='$ph(Driver`s number)' name='Phone' >";

echo $PhoneErr;?>


<button class="btn btn-lg btn-danger btn-block" type="submit"></span>UPDATE
</button></form>
</div>
</center>

<?php


            echo '<center><h2 class="new"><b>Group Members</b></h2>';
            if(mysql_query($query3))
            {
              $run3=mysql_query($query3) or die(mysql_error());
              echo '<table style="width:600px; text-align:center;" align="center" class="aa" id="gradient-style">
<tr style="background-color:#6699FF">
<th  scope=col>S.no</th> <th scope=col>Name</th> <th scope=col>Email</th> <th scope=col>Phone no.</th> <th scope=col>Seats Booked</th>
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
           
              echo '</table></center>';
              echo "<span class=align><form action='leave_group.php' method='post'>" ."<input type='hidden' name='username' value='$userid'>".
              "<input type='hidden' name='group' value='$group'>"."<input type='hidden' name='number' value='$number'>".
              "<input type='hidden' name='book_no' value='$book_no'>"."<br>".
              "<button type='button submit' class='btn btn-lg btn-danger'>Leave this Group</button>"
            ."</form></span>";
              echo '</div>';
            }

            
        }
        else echo '<span class=bau> <br><br><h2 style="text-align:center; color:red; font-size:40px;"><b>NO GROUP CREATED OR JOINED</b></h2</span> ';
    

echo '<div class="forms">



</div>';
?>
</body>
</html>
