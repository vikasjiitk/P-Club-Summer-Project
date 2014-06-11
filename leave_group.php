<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
echo '<script>
if(confirm("Leave this Group")==true)
{
	window.open("leave.php","_self");

}
else
{
	window.open("yourgroup.php","_self");
}
</script>';

?>
