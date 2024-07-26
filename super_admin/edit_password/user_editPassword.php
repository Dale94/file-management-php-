<?php 

require_once("../include/connection.php");
// session_start();

if (isset($_POST['edit_pass'])) {
    $user_id = $_POST['name'];
    $admin_password = $_POST['admin_password'];
    $new_password = $_POST['new_password'];
    $new_password2 = $_POST['confirmation_password'];

    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}$/';
    if (!preg_match($pattern, $new_password)) {
        // Password does not meet the pattern requirements
        echo '<script type="text/javascript">alert("Password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 7 characters long."); window.location = "../signup.php";</script>';
        exit; // Stop further execution
    }

    // Retrieve the hashed password from the database
    $result = mysqli_query($conn, "SELECT * FROM super_admin");
    $row = mysqli_fetch_assoc($result);
    $hashed_admin_password = $row['password'];

    // Verify if the current password matches
    if (password_verify($admin_password, $hashed_admin_password)) {
        // Check if the new password and confirmation match
        if ($new_password == $new_password2) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT, array('cost' => 12));

            // Update the password in the database
            mysqli_query($conn, "UPDATE login_user SET user_password = '$hashed_new_password' WHERE name='$user_id'")
                or die(mysqli_error($conn));
            echo "<script type = 'text/javascript'>alert('You have completely changed your password');</script>";

            // Redirect to dashboard.php after successful password change
            header("Location: view_user_department.php");
            exit; // Make sure to stop executing further code after redirection
        } else {
            echo "<script type = 'text/javascript'>alert('Passwords didn't match');</script>";
        }
    } else {
        echo "<script type = 'text/javascript'>alert('Wrong password');</script>";
    }
}
?>
