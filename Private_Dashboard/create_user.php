<?php

 require_once("include/connection.php");
session_start();
   
   if(isset($_POST['reguser'])){
    $user_id = $_SESSION["admin_user"];
$q = mysqli_query($conn,"select * from admin_login where admin_user = '$user_id'") or die (mysqli_error($conn));
 $rs1 = mysqli_fetch_array($q);
               $pass1=$rs1['admin_password'];
        
         $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);
         $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT, array('cost' => 12));  //PASSWORD_ARGON2I//PASSWORD_ARGON2ID
         $user_password = mysqli_real_escape_string($conn,$_POST['user_password']);
         $confirm_password = mysqli_real_escape_string($conn,$_POST['confirmation_password']);
         $department = mysqli_real_escape_string($conn,$_POST['department']);
         $user_status = mysqli_real_escape_string($conn,$_POST['user_status']);
         $admin_pass = mysqli_real_escape_string($conn,$_POST['admin_password']);

		 $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}$/';
		if (!preg_match($pattern, $user_password)) {
			// Password does not meet the pattern requirements
			echo '<script type="text/javascript">alert("Password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 7 characters long."); window.location = "../signup.php";</script>';
			exit; // Stop further execution
		}

		 if (password_verify($admin_pass, $pass1)) {
			// Check if the new password and confirmation match
			if ($user_password == $confirm_password) {

			$q_checkadmin = $conn->query("SELECT * FROM `login_user` WHERE `email_address` = '$email_address'") or die(mysqli_error());
				$v_checkadmin = $q_checkadmin->num_rows;
				if($v_checkadmin == 1){
					echo '
						<script type = "text/javascript">
							alert("Email Address already taken");
							window.location = "dashboard.php";
						</script>
					';
				}else{
					$conn->query("INSERT INTO `login_user` VALUES('','$user_name', '$email_address', '$hash_password', '$user_status', '$department')") or die(mysqli_error());
					echo '
						<script type = "text/javascript">
							alert("Saved Employee Info");window.location = "dashboard.php";
						</script>
					';
				}
			}else{
				echo '
						<script type = "text/javascript">
							alert("Passowrd did not match");window.location = "dashboard.php";
						</script>
					';
			}
		}else{
			echo '
						<script type = "text/javascript">
							alert("Wrong password");window.location = "dashboard.php";
						</script>
					';
		}
}


 ?>