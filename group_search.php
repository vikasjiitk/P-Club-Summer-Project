<html>
<head>
  <title>groups</title>
    <?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
  <style type="text/css">
  .my{color: red; font-size: 15pt;}
  .align{text-align: center; color: blue;}
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
    <a href="create_group.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">CreateGroup</font></b></i></a> 
    <a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Contacts</font></b></i></a> 
    <a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Profile</font></b></i></a> 
    <a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Notifications</font></b></i></a> 
    <a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3" style="word-spacing: 0.2em;">About us</font></b></i></a> 
    <a href="" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Help</font></b></i></a> 
    <a href="signout.php" target=_top STYLE="text-decoration: none"><i><b><font class="id3">Signout</font></b></i></a></p> <hr> <hr> 
  <span class=align><h1>Available Groups</h1></span> 
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
  $number=$_POST["number"];
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
      }}
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
 }   while($row=mysql_fetch_assoc($query_run2))
  {
    
    echo '<hr>';
    echo '<span class=my>';
      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
    . ($i+1) . '.' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
    . $source . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
    . $desti . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
    . $row['date'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
    .$row['time'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
     $row['gender'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'."TOTAL: ".$row['limit']
     .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    // if(strcmp($_row['vehicle'],"ANY")
     //{
    //echo $row['number']."Members till now.".'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'."AUTO/VIKRAM";
     //}
     //else{
     echo ($row['limit']-$row['number'])." SEATS AVAILABLE".'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['vehicle'];
    $key=$row['key'];
    $limit=$row['limit'];//}
    $number+=$row['number'];
    $gender=$row['gender'];
    echo "<form action='join_group.php' method='post'>" ."<input type='hidden' name='group' value='$key'>".
    "<input type='hidden' name='number' value='$number'>"."<input type='hidden' name='limit' value='$limit'>".
    "<input type='hidden' name='gender' value='$gender'>".
    "<input type='submit' name='join_group'value='Join Group'>"
 ."</form>";
    echo '</span>';
    echo '<hr>'; 
    $i++;

  }
 }
  else
  {echo'invalid query';}
}
?>
</body>
</html>
