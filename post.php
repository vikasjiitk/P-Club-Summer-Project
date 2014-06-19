<?php
session_start();
if(isset($_SESSION['loggedin'])){
$array=explode(" ",$_SESSION['loggedin']); 
  $text = $_POST['text'];
    $t=$array[1];
    $fp = fopen($t, 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$array[0]."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
