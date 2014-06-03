<!DOCTYPE html>
<html>
<body><?php 
    session_start();
    $_SESSION = array();
    $message = "Logged out successfully!";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
 ?>
</body></html>
