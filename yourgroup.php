<!DOCTYPE html> 
<html> 
<head>
 <title>
 	SHARE Ur FARE
 </title>
 <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}

?>
  <style type="text/css"> 
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
  h1{color:teal;} 
  .id1{ color:goldenrod; font-size: 22px; } 
  .id1:hover{ color:gold; }
  .id2:hover{ color:indigo; } 
  .id3{ color:olivedrab; font-size: 22px; } 
  .id3:hover{ color:yellowgreen; } 
  .id4{ color:mediumslateblue; font-size: 28px; } 
  .id4:hover{ color:gold; } 
</style> 
</head> 
<body style="background-color:lavender;"> 
	<h1 style="text-align:Center;"><i><b><font class="id2"><ins>SHARE ur FARE</ins></font></b></i></h1> 
	<hr> 
	<font class="id1">Disclaimer:</font>
	<hr>
	<hr> 
	<p style="word-spacing: 3em;">
		<a href="welcome.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Home</font></b></i></a>
		<a href="create_group1.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">CreateGroup</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Contacts</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Profile</font></b></i></a> 
		<a href="yourgroup.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">YourGroup</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a> 
		<a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a> 
		<a href="signout.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr> 
		<?php
		require 'connect.inc.php';
		$userid=@mysql_real_escape_string($_SESSION['loggedin']);
     	$query="SELECT `key` FROM users WHERE `id`='$userid' ";
     //	echo $userid;
     	if(mysql_query($query))
     	{
     		//echo 'success';
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
                <td>'.$count.'</td><td>'.$row3["name"].'</td><td>'.$row3["email"].'</td><td>'.$row3["phone"].'</td><td>'.$row3['book_no'].'</td></tr>';
                $count++;
                if($row3['id']==$userid)
                {
                  $group=$row3['key'];
                  $book_no=$row3['book_no'];
                }
              } 
              echo '</table>';
              echo "<span class=align><form action='leave_group.php' method='post'>" ."<input type='hidden' name='id' value='$userid'>".
              "<input type='hidden' name='group' value='$group'>"."<input type='hidden' name='number' value='$number'>".
              "<input type='hidden' name='book_no' value='$book_no'>".
              "<input type='submit' name='' value='Leave this Group'>"
            ."</form></span>";

            }


        }
        else echo '<span class=id4> <br><br><h2 style="text-align:center"> NO GROUP CREATED OR JOINED</h2</span> ';
     		
     	}
     	else echo '<br>failure';
     	?>
     </body>
