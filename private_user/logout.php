<?php
require_once("include/connection.php");

session_start();

// Check if user is logged in
if(isset($_SESSION["user_no"])) {
    $id = $_SESSION["user_no"];

    // Update user status to "Deactive" and update logout time
    mysqli_query($conn, "UPDATE `login_user` SET `Active` = 'false', `logout_time` = NOW() WHERE id='$id'");

    // Unset and destroy session
    session_unset();
    session_destroy();

    // Redirect to login page after logout
    echo "<script type='text/javascript'>alert('Logged out successfully!');
          document.location='../login.html'</script>";
} else {
    // Redirect to login page if session ID is not set
    header("Location: ../login.html");
    exit();
}
?>
