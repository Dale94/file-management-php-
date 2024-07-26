<?php 

require_once("../include/connection.php");
session_start();


if(isset($_POST["logIn"])){

  date_default_timezone_set("asia/manila");
  $date = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $username = mysqli_real_escape_string($conn, $_POST["email_address"]);  
 $password = mysqli_real_escape_string($conn, $_POST["user_password"]);

// $pass=sha1($pass1);
// $salt="a1Bz20ydqelm8m1nel";
// $pass1=$salt.$pass;

$query=mysqli_query($conn,"SELECT * FROM  login_user WHERE email_address = '$username'")or die(mysqli_error($conn));
		$row=mysqli_fetch_array($query);
           $id=$row['id'];
           $user=$row['email_address'];

           $_SESSION["user_no"] = $row["id"];
		   $_SESSION["email_address"] = $row["email_address"];
    
           $counter=mysqli_num_rows($query);
            
		  	if ($counter == 0) 
			  {	
				  echo "<script type='text/javascript'>alert('Invalid Email Address or Password,Please try again!');
				  document.location='../login.html'</script>";
				  header('location: ../login.html');
			  } 
			  else
			  {
			  if(password_verify($password, $row["user_password"]))  
                 {

				  $_SESSION['email_address']=$id;	
				  header('location: ../private_user/home.php');
				  mysqli_query($conn, "UPDATE `login_user` SET `active` = 'true', `logout_time`='still active' WHERE id='$id'");

			
			  	echo "<script type='text/javascript'>document.location='../private_user/home.php'</script>";  
		 }else{
			echo "<script type='text/javascript'>document.location='../login.html'</script>";  

		 }
	  }
   }
?>

