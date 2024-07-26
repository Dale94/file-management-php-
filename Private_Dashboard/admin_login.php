

<?php

require_once("../include/connection.php");

session_start();

if(isset($_POST["adminlog"])){


  date_default_timezone_set("asia/manila");
  $date = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $username = mysqli_real_escape_string($conn, $_POST["admin_user"]);  
 $password = mysqli_real_escape_string($conn, $_POST["admin_password"]);



$query=mysqli_query($conn,"SELECT * FROM admin_login WHERE admin_user = '$username'")or die(mysqli_error($conn));
		$row=mysqli_fetch_array($query);
           $id=$row['id'];
            $admin=$row['admin_user'];
		   $_SESSION["user_no"] = $id;
           $_SESSION["admin_user"] = $row["admin_user"];
           $_SESSION["department"] = $row["department"];
           $_SESSION["name"] = $row["name"];

           $counter=mysqli_num_rows($query);
            
		  	if ($counter == 0) 
			  {	
				   echo "<script type='text/javascript'>alert('Invalid Email Address or Password,Please try again!');
				  document.location='index.html'</script>";
			  } 
			  else
			  {
				if(password_verify($password, $row["admin_password"]))  
                 {

				  $_SESSION['email_address']=$id;	
				  header('location: dashboard.php');
				  mysqli_query($conn, "UPDATE `admin_login` SET `active` = 'true', `logout_time`='still active' WHERE id='$id'");


			
			  		echo "<script type='text/javascript'>document.location='dashboard.php'</script>";  
		 		} else{
					echo "<script type='text/javascript'>document.location='index.html'</script>";  

				}
			  }
	    }
?>