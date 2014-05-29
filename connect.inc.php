<?php
$host = 'localhost';
$user='root';
$pass = 'pcp10';
$db='iitk';
if(!@mysql_connect($host,$user,$pass) || !@mysql_select_db($db)){
	die('could not connect');
}
//echo 'connected with sever' . '<br />';

 
?>
