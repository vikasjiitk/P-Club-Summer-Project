<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php session_start(); ?>
<head>
<?php if(!isset($_SESSION['loggedin'])){
    header('Location:login.php');
    exit;
}
?>
<title>Group-Chat</title>
<link type="text/css" rel="stylesheet" href="styling.css" />
</head>
<body>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<?php
$username=$_SESSION['loggedin'];
require 'connect.inc.php';
 $sql="SELECT `key` FROM users WHERE `username`='$username'";
  if(mysql_query($sql))
  {
      $query_run=mysql_query($sql);
      $row=mysql_fetch_assoc($query_run);
      $var="chat/".$row['key'].".html";
    }
?>
<script type="text/javascript">var address='<?php echo $var;?>';</script>
<script type="text/javascript">
$(document).ready(function(){
$("#exit").click(function(){
    window.location = 'chat.php?logout=true';
    });
$("#submitmsg").click(function(){   
   
    var clientmsg = $("#usermsg").val();
    $.post("post.php", {text: clientmsg,
        group: address});              
    $("#usermsg").attr("value", "");
    return false;
    
});
function loadLog(){     
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    
    $.ajax({

        url: address,
        cache: false,
        success: function(html){        
            $("#chatbox").html(html);    
            //Auto-scroll           
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }               
        },
    });
}
setInterval(loadLog,0);
});
</script>
<div id="wrapper">
<?php
if(isset($_GET['logout'])){ 
    $fp = fopen($var, 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $username ." has left the chat session.</i><br></div>");
    fclose($fp);
  header("Location: welcome.php"); //Redirect the user
}

?>
    <div id="menu">
        <p class="welcome">Welcome, <b><?php echo $username; ?></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>    
   <div id="chatbox"><?php
if(file_exists("<?php echo $var ;?>") && filesize("<?php echo $var ;?>") > 0){
    $handle = fopen("<?php echo $var ;?>", "r");
    $contents = fread($handle, filesize("<?php echo $var ;?>"));
    fclose($handle);
     
    echo $contents;
}
?></div>     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>     
</body>
</html>
