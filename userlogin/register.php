<?php

require_once("../include/connection.php");

if(isset($_POST["register"])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email_address']);
    $Pass1 = mysqli_real_escape_string($conn, $_POST['user_password']); 
    $Pass2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $employee = mysqli_real_escape_string($conn, 'Employee');

    // Password pattern validation
    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}$/';
    if (!preg_match($pattern, $Pass1)) {
        // Password does not meet the pattern requirements
        echo '<script type="text/javascript">alert("Password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 7 characters long."); window.location = "../signup.php";</script>';
        exit; // Stop further execution
    }

    if ($Pass1 != $Pass2) {
        // Passwords do not match
        echo '<script type="text/javascript">alert("Passwords do not match."); window.location = "../signup.php";</script>';
        exit; // Stop further execution
    }

    // Check if email address is already taken
    $q_checkadmin = $conn->query("SELECT * FROM `login_user` WHERE `email_address` = '$email'") or die(mysqli_error());
    $v_checkadmin = $q_checkadmin->num_rows;

    if($v_checkadmin == 1){
        // Email address already taken
        echo '<script type="text/javascript">alert("Email Address already taken."); window.location = "../signup.php";</script>';
        exit; // Stop further execution
    } else {
        // Insert new employee
        $Pass = password_hash($Pass1, PASSWORD_DEFAULT, array('cost' => 12));
        $conn->query("INSERT INTO `login_user` VALUES('', '$username', '$email', '$Pass', '$employee', '$department')") or die(mysqli_error());
        echo '<script type="text/javascript">alert("Saved Employee Info"); window.location = "../login.html";</script>';
    }
}
?>
