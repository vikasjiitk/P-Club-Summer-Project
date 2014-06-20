<?php
session_start();
if(isset($_SESSION['loggedin'])){
  $text = $_POST['text'];
    $group=$_POST['group'];
    $fp = fopen($group, 'a');
    $timestamp=time();
    fwrite($fp, "<div class='msgln'>(".date("g:i A",$timestamp+12600).") <b>".$_SESSION['loggedin']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
