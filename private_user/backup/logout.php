
<?php

require_once("include/connection.php");
// this is logout page when user click button logout in system page

session_start();
  date_default_timezone_set("asia/manila");
  $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $email = $_SESSION['email_address'];
  

mysqli_query($conn,"UPDATE history_log SET `logout_time` = '$time'  WHERE `id` = '$email'");

$_SESSION = NULL;
$_SESSION = [];
session_unset();
session_destroy();

echo "<script type='text/javascript'>alert('LogOut Successfully!');
				  document.location='../login.html'</script>";

?>

