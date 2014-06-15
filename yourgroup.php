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
  .col{
    color: #6600FF;
    font-family: "Lucida Handwriting";
  }
  }
  hr{color:blue;}
  body {background-image:url("b1.jpg");}

  .align{text-align: center;}
  table,th,td
  {
  border:1px solid black;
  border-collapse:collapse;
  }
  th,td
  {
  padding:5px;
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
          <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
             <li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span>  Your Group</a></li>
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
<?php
    require 'connect.inc.php';
    $username=@mysql_real_escape_string($_SESSION['loggedin']);
      $query="SELECT `key` FROM users WHERE `username`='$username' ";
     
      if(mysql_query($query))
      {
        $run=mysql_query($query) or die(mysql_error());
        $row=mysql_fetch_assoc($run);
        $group_id = $row["key"];

        if($group_id != 0)
        {
            $query2="SELECT * FROM groups WHERE `key`='$group_id'";
            $query3="SELECT * FROM users WHERE `key`='$group_id'";
            echo '<br><h2 style=text-align:center class=id4>Travel Plan</h2>';
            if(mysql_query($query2))
            {
              $run2=mysql_query($query2) or die(mysql_error());
              $row2=mysql_fetch_assoc($run2);
              echo '<table style="width:500px; text-align:center;" align="center"> 
              <tr style="background-color:#6699FF">
              <th>Source</th> <th>Destination</th> <th>Date of Travel</th> <th>Time of Travel</th>
              </tr>
              <tr>
              <td>'.$row2["source"].'</td> <td>'.$row2["destination"].'</td> <td>'.$row2["date"].'</td> <td>'.$row2["time"].
              '</td></tr>
              </table>';
              $number=$row2['number'];
            }

            echo '<br><h2 style=text-align:center class=id4>Group Members</h2>';
            if(mysql_query($query3))
            {
              $run3=mysql_query($query3) or die(mysql_error());
              echo '<table style="width:500px; text-align:center;" align="center"> 
              <tr style="background-color:#6699FF">
              <th>S.no</th> <th>Name</th> <th>Email</th> <th>Phone no.</th> <th>seats booked</th>
              </tr>';
              $count=1;
              while($row3=mysql_fetch_assoc($run3))
              {
                echo '<tr>
                <td>'.$count.'</td><td>'.$row3["name"].'</td><td>'.$row3["username"]."@iitk.ac.in".'</td><td>'.$row3["phone"].'</td><td>'.$row3['book_no'].'</td></tr>';
                $count++;
                if($row3['username']==$username)
                {
                  $group=$row3['key'];
                  $book_no=$row3['book_no'];
                }
              } 
              echo '</table>';
              echo "<span class=align><form action='leave_group.php' method='post'>" ."<input type='hidden' name='username' value='$username'>".
              "<input type='hidden' name='group' value='$group'>"."<input type='hidden' name='number' value='$number'>".
              "<input type='hidden' name='book_no' value='$book_no'>"."<br>".
              " <button class='btn btn-lg btn-default' type='submit'>Leave Group
</button>"
            ."</form></span>";

            }


        }
        else echo '<span class=id4> <br><br><h2 style="text-align:center"> NO GROUP CREATED OR JOINED</h2</span> ';
        
      }
      else echo '<br>failure';
      ?>
     </body>



