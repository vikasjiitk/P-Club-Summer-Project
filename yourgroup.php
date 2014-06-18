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

?>
  <style type="text/css"> 
   .col{
    color: #6600FF;
    font-family: "Lucida Handwriting";
  }
  h1{ font-family: Magneto;
  color:teal;}
  .new{color: #0000FF;}
  .bau{font-family: "Bradley Hand ITC";color: #330099;}
  .align {text-align: center; color: blue;}
  .cen {text-align: center;}
  .aa{font-family: "Adobe Gothic Std B";color: #0033CC;font-size: 20px;}
  body {background-image:url("b1.jpg");}
  table,th,td
  {
  border:1px solid black;
  border-collapse:collapse;
  }
  th,td
  {
  padding:5px;
  }
  h1{color:teal;} 
   
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
             <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
           <li  class="active"><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span>  Your Group</a></li>
            
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Profile</a></li>
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

 
     
  <?php
    require 'connect.inc.php';
    $userid=@mysql_real_escape_string($_SESSION['loggedin']);
      $query="SELECT `key` FROM users WHERE `username`='$userid' ";
     // echo $userid;
      if(mysql_query($query))
      {
        //echo 'success';
        $run=mysql_query($query) or die(mysql_error());
        $row=mysql_fetch_assoc($run);
        $group_id = $row["key"];

        if($group_id != 0)
        {
          echo '<div id="table" style="background-color:;width:60%;float:left;">';
            $query2="SELECT * FROM groups WHERE `key`='$group_id'";
            $query3="SELECT * FROM users WHERE `key`='$group_id'";
            echo '<br><h2 style=text-align:center class=bau><b>Travel Plan</b></h2>';
            if(mysql_query($query2))
            {
              $run2=mysql_query($query2) or die(mysql_error());
              $row2=mysql_fetch_assoc($run2);
              echo '<table style="width:600px; text-align:center;" align="center" class="aa"> 
              <tr style="background-color:#6699FF">
              <th>Source</th> <th>Destination</th> <th>Date of Travel</th> <th>Time of Travel</th>
              </tr>
              <tr>
              <td>'.$row2["source"].'</td> <td>'.$row2["destination"].'</td> <td>'.$row2["date"].'</td> <td>'.$row2["time"].
              '</td></tr>
              </table>';
              $number=$row2['number'];
            }

            echo '<br><h2 style=text-align:center class=bau><b>Group Members</b></h2>';
            if(mysql_query($query3))
            {
              $run3=mysql_query($query3) or die(mysql_error());
              echo '<table style="width:600px; text-align:center;" align="center" class="aa"> 
              <tr style="background-color:#6699FF">
              <th>S.no</th> <th>Name</th> <th>Email</th> <th>Phone no.</th> <th>Seats Booked</th>
              </tr>';
              $count=1;
              while($row3=mysql_fetch_assoc($run3))
              {
                echo '<tr>
                <td>'.$count.'</td><td>'.$row3["name"].'</td><td>'.$row3["username"].'@iitk.ac.in</td><td>'.$row3["phone"].'</td><td>'.$row3['book_no'].'</td></tr>';
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

            echo '<div id="noti" style="width:39%;float:left;"></br> <br><h2 style=text-align:center class=bau><b> GROUP NOTIFICATIONS</b></h2><br>';
            $query4="SELECT * FROM notification WHERE `key`='$group_id' ORDER BY `time` desc";
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
                  echo '<div style="color:#0033CC; background-color:#6699FF;float:left;width:100%;height:60px;font-size:20px; font:bold;">';
                else 
                  echo '<div style="color:#0033CC;float:left;width:100%;height:60px;font-size:20px; font:bold;">';
                if($row4['code']==0)
                {
                  if($noti>0){
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' left this group at '.$row4['time'].'.<span style="color:#FF0000;text-shadow: 1px 2px #4C0000;"><i> (new)!</i></span><br>';
                  else
                    echo $i.') You'.' left this group at '.$row4['time'].'.<br>';
                    $noti--;}
                    else{
                    if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' left this group at '.$row4['time'].'.<br>';
                  else
                    echo $i.') You'.' left this group at '.$row4['time'].'.<br>';
                    }  
                    

                }
                else 
                {
                  if($noti>0){
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' joined this group at '.$row4['time'].'<span style="color:#FF0000;text-shadow: 1px 2px #4C0000;"><i> (new)!</i></span>.<br>';
                  else
                    echo $i.') You'.' joined this group at '.$row4['time'].'.<br>';
                  $noti--;
                  }
                  else{
                  if($row4['username']!=$userid)
                    echo $i.') '.$row4['username'].' joined this group at '.$row4['time'].'.<br>';
                  else
                    echo $i.') You'.' joined this group at '.$row4['time'].'.<br>';  
                  }
                }
                $i++;
                echo '</div>';
              }
            }
            echo '</div>';

        }
        else echo '<span class=bau> <br><br><h2 style="text-align:center; color:red; font-size:40px;"><b>NO GROUP CREATED OR JOINED</b></h2</span> ';
      
      }
      else echo '<br>failure';
      ?>
     </body>
