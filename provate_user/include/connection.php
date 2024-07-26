<?php 
$conn = mysqli_connect("localhost","root","","file_management");

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}
?>