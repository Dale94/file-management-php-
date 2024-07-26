<!DOCTYPE html>
<html lang="en">
<?php

// Inialize session
session_start();
error_reporting(0);
        require_once("include/connection.php");
  $id = mysqli_real_escape_string($conn,$_GET['id']);


// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_user'])) {
header('Location: index.html');
}
else{
    $uname=$_SESSION['admin_user'];
  //  $desired_dir="user_data/$uname/";
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>VIEW USER</title>
  <link rel="icon" href="Private_Dashboard/img/images.png" type="image/x-icon"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">

    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
      $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
            });
  })
    </script>

  <style>
          select[multiple], select[size] {
    height: auto;
    width: 20px;
}
.pull-right {
    float: right;
    margin: 2px !important;
}

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
#loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
  
    table{
   overflow-y:scroll;
   height:300px;
   display:block;
}
  </style>

    <script src="jquery.min.js"></script>
<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>
</head>

<body class="grey lighten-3">
<?php 
  $id = $_SESSION['admin_user'];
  include('side_bar.php');
?>
  <!--Main Navigation-->
  <header>
  <?php
    require_once("include/connection.php");


    $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


   $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));

   $row = mysqli_fetch_array($r);

    $id=$row['admin_user'];
    $admin_password=$row['admin_password'];
    $admin_department=$row['department'];
    // $fname=$row['fname'];
    // $lname=$row['lname'];

 ?>

    <!-- Sidebar -->
    

  </header>
  <!--Main Navigation-->
 <div id="loader"></div>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5 barchartdata">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="dashboard.php">Home Page</a>
            <span>/</span>
            <span>View User</span>
          </h4>
<!-- 
          <form class="d-flex justify-content-center">
       
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-primary btn-sm my-0 p" type="submit">
              <i class="fas fa-search"></i>
            </button>

          </form> -->

        </div>

      </div>
<div class="">
  
 <table id="dtable" class = "table table-striped">


          <thead>
              <th>Name</th>
              <th>Admin User</th>
              <th>Admin Password</th>
              <th>Status</th>
              <th>Action</th>
          </thead><br /><br />
          <tbody>
     <?php
         require_once("include/connection.php");

            $query="SELECT * FROM login_user where `department` = '$admin_department'";
            $result=mysqli_query($conn,$query);
            while($rs=mysqli_fetch_array($result)){
                $id =  $rs['id'];
               $fname=$rs['name'];
               $admin=$rs['email_address'];
               $pass=$rs['user_password'];
               $status=$rs['user_status'];
           
          ?>       
    
           <tr>
               <td ><?php echo  $fname; ?></td>
               <td ><?php echo $admin; ?></td>
               <td ><?php echo $pass; ?></td>
               <td ><?php echo $status; ?></td>
               <td ><a href="#modalRegisterFormss?id=<?php echo $id;?>"><i class="fas fa-user-edit" data-toggle="modal" data-target="#modaledituser"></i></a></td>
           </tr>
       
    <?php  } ?>
       </tbody>
   </table>

<!-- <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Launch
    Modal Register Form</a>
</div> -->
    <hr></div>
  <!--/.Footer-->

<!-- Card -->
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

  <script type="text/javascript" src="js/popper.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/mdb.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>   
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>

</body>
   <!--modal--->






<div class="modal fade" id="modaledituser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <?php 

require_once("include/connection.php");
  
$q = mysqli_query($conn,"select * from login_user where id = '$id'") or die (mysqli_error($conn));
 $rs1 = mysqli_fetch_array($q);
 
               $id1=$rs1['id'];
               $department=$rs1['department'];
               $username=$rs1['name'];

?>
  <div class="modal-dialog" role="document">
    <form method="POST">
    
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-edit"></i> Edit <?php echo $username;?> account
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body mx-3">
           <div class="md-form mb-5">
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $id1;?>"><br>
        </div>

        <?php
                  $query = mysqli_query($conn,"SELECT * FROM department where `id` = $dep") or die (mysqli_error($con));
                  $department_val=mysqli_fetch_array($query)
              ?>
        Current department: <?php echo $department_val['name'] ?>
        <div class="md-form mb-5">
            <select id="materialFormCardPasswordEx" name="department" class="form-control">
              <?php
                  $query = mysqli_query($conn,"SELECT * FROM department") or die (mysqli_error($con));
                  while($department=mysqli_fetch_array($query)){
                    $department_name = $department['name'];
                    $department_id = $department['id'];

              ?>
                <option value="<?php echo $department_id ?>"><?php echo $department_name?></option>
              <?php }?> 
              
            </select>
                  </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" class="form-control validate" name="confirm_password_admin">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" name="edit_user_department">UPDATE</button>
      </div>
    </div>
  </div>
</div>
</form>

  <!--modal--->
 <?php 

 require_once("include/connection.php");

  
 if(isset($_POST['edit_user_department'])){
         $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $department_user = mysqli_real_escape_string($conn,$_POST['department']);
         $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password_admin']);
         $user = mysqli_real_escape_string($conn,$_POST['user_id']);
         $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);



         if (password_verify($confirm_password, $admin_password)) 
         {
          // Passwords match, proceed with the update
          echo "<script type='text/javascript'>alert('The User has been updated');document.location='view_user.php'</script>";

              mysqli_query($conn, "UPDATE `login_user` SET `department` = '$department_user' WHERE id='$user'") or die (mysqli_error($conn));
            } else {
              echo "<script type = 'text/javascript'>alert('wrong password');document.location='dashboard.php'</script>";
        
            }
  }

?>
</html>
