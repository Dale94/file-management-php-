<!DOCTYPE html>
<html lang="en">
<?php
// include('Private_Dashboard/include/connection.php');
session_start();
if(!isset($_SESSION["email_address"])){
    header("location:../login.html");
}

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>HOME</title>
  <link rel="icon" href="img/images.png" type="image/x-icon"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">


<!-- 
<link href="css/addons/datatables.min.css" rel="stylesheet">
<script href="js/addons/datatables.min.js" rel="stylesheet"></script>
<link href="css/addons/datatables-select.min.css" rel="stylesheet">
<script href="js/addons/datatables-select.min.js" rel="stylesheet"></script> -->


<!-- <link rel="stylesheet" id="font-awesome-style-css" href="http://phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script> -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="media/css/dataTable.css" />
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
      $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
                //"destroy":true;
            });
  })
    </script>
    <style type="text/css">
      select[multiple], select[size] {
    height: auto;
    width: 20px;
}
.pull-right {
    float: right;
    margin: 2px !important;
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

    .group{
      width: 90%;
      margin-left: 5%;
    }
 /*   #dtable{
 display: block;

  overflow-x: scroll;
  width: 600px;
    }*/



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

<body style="padding:0px; margin:0px; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
  <?php 

     require_once("include/connection.php");


   $id = mysqli_real_escape_string($conn,$_SESSION['email_address']);


  $r = mysqli_query($conn,"SELECT * FROM login_user where id = '$id'") or die (mysqli_error($con));

  $row = mysqli_fetch_array($r);

   $id=$row['email_address'];
   $name=$row['name'];
   $department=$row['department'];
   $status=$row['user_status'];
   // $fname=$row['fname'];
   // $lname=$row['lname'];

?>
  <!-- Start your project here-->
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color fixed-top">
    <a class="navbar-brand" href="#"><img src="js/img/images.png" width="33px" height="33px"> <font color="#F0B56F">L</font>GU <font color="#F0B56F">F</font>ile <font color="#F0B56F">M</font>anagement <font color="#F0B56F">S</font>ystem</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fab fa-facebook-f"></i> Facebook
          <span class="sr-only">(current)</span>
        </a>
      </li>-->
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
           <font color="black">Welcome!,</font> <?php echo ucwords(htmlentities($id)); ?> <i class="fas fa-user-circle"></i> Login </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
        <!-- <a class="dropdown-item" href="delete_account.php"><i class="fas fa-trash-alt"></i> Delete Account</a> -->
        <a class="dropdown-item" data-toggle="modal" data-target="#modaldeletedd"><i class="fas fa-user-edit"></i> Delete Account</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalRegisterFormss"><i class="fas fa-user-edit"></i> Edit Account</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalpassword"><i class="fas fa-user-edit"></i>Change password</a>
          <!-- <a class="dropdown-item" href="history_log.php"> <i class="fas fa-chalkboard-teacher"></i> User Logged</a>
          <a class="dropdown-item" href="history_log.php"> <i class="fas fa-chalkboard-teacher"></i> User Logged</a> -->
          <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-in-alt"></i> LogOut</a>

        </div>
      </li>
    </ul>
  </div>
</nav>
<br>
<!--/.Navbar -->
<br><Br><br>
<!-- Card -->
<div class="group">
  <div class="row">
     <div class="col-md-12">
     <Form name="multiple_files" method="post" action="delete.php">
      <!-- Heading -->
      <div class="">
    <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegisterForm">Add File</button> -->
    <input type="hidden" name= "name" value="<?php echo ucwords(htmlentities($name)); ?>" class="form-control" readonly="">

    <a href="add_file.php"><button type="button" class="btn btn-success"><i class="fas fa-file-medical"></i>  Add File</button></a>
    <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete Files</button>
    <button type="submit" class="btn btn-primary" name="download"><i class="fa fa-download"></i> Download Files</button>
    </div>
  
<hr>
 
 <div class="col-md-12">

 <div style="overflow-x: auto;">
  <table id="dtable" class="table table-striped">
    <thead style="position: sticky; top: 0; background-color: white; z-index: 1;">
     

    <th>Select</th>
    <th>Filename</th>
    <th>FileSize</th>
    <th>Uploader</th>
     <th>Status</th>   
    <th>Date/Time Upload</th>
    <th>Downloads</th>

</thead>
<tbody style="overflow-y: auto; max-height: 400px;">

    
    <tr>
        <?php 
   
        require_once("include/connection.php");
      
   $name=$row['name'];
      $query = mysqli_query($conn,"SELECT DISTINCT ID,NAME,SIZE,EMAIL,ADMIN_STATUS,TIMERS,DOWNLOAD FROM upload_files WHERE NAME != 'EMPTY' AND department = '$department' AND ADMIN_STATUS = 'Employee' AND archived = 'No' group by NAME DESC") or die (mysqli_error($con));
      $query_empty = mysqli_query($conn,"SELECT DISTINCT ID,NAME,SIZE,EMAIL,ADMIN_STATUS,TIMERS,DOWNLOAD FROM upload_files WHERE NAME = 'EMPTY' group by NAME DESC") or die (mysqli_error($con));
      
      if(mysqli_num_rows($query) < 1) {
        $query_data = $query_empty;
      }else{
        $query_data =$query;
      }

      while($file=mysqli_fetch_array($query_data)){
         $id =  $file['ID'];
         $name =  $file['NAME'];
         $size =  $file['SIZE'];
         $uploads =  $file['EMAIL'];
          $status =  $file['ADMIN_STATUS'];
         $time =  $file['TIMERS'];
         $download =  $file['DOWNLOAD'];
    
      ?>
     <td><input name="checkbox[]" type="checkbox" value="<?php echo $id; ?>"></td>
     <input type="hidden" name= "ID" value="<?php echo ucwords(htmlentities($id)); ?>" class="form-control" readonly="">

      </form>
      <td width="17%"><?php echo  $name; ?></td>
      <td><?php echo floor($size / 1000) . ' KB'; ?></td>
      <td><?php echo $uploads; ?></td>
      <td><?php echo $status; ?></td>
      <td><?php echo $time; ?></td>
      <td><?php echo $download; ?></td>
  </div>
    </tr>
<?php } ?>
</tbody>
   </table>
    </div>



 
  

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
</html>

<div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <?php 

require_once("include/connection.php");
  
$user_id = $_SESSION["email_address"];
$q = mysqli_query($conn,"select * from login_user where id = '$user_id'") or die (mysqli_error($conn));
 $rs1 = mysqli_fetch_array($q);
 
               $id1=$rs1['id'];
               $pass1=$rs1['user_password'];
               $status=$rs1['user_status'];
               $department=$rs1['department'];
?>
  <div class="modal-dialog" role="document">
    <form method="POST">
    
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-edit" ></i> Edit Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body mx-3">
           <div class="md-form mb-5">
            <input type="hidden" class="form-control" name="id" value="<?php echo $id1;?>"><br>
        </div>
        <!-- <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" value="<?php echo $fname1;?>" class="form-control validate">
          <label for="orangeForm-name">Your name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="email_address" value="<?php echo $admin1;?>" class="form-control validate">
          <label for="orangeForm-email">Your email</label>
        </div> -->
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="current_password" class="form-control validate">
          <label for="orangeForm-pass">Current password</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="user_password" class="form-control validate">
          <label for="orangeForm-pass">Your password</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="confirmation_password" class="form-control validate">
          <label for="orangeForm-pass">Confirmation password</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" name="edit_pass">UPDATE</button>
      </div>
    </div>
  </div>
</div>
</form>


<div class="modal fade" id="modalRegisterFormss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <?php 

require_once("include/connection.php");
  
$user_id = $_SESSION["email_address"];
$q = mysqli_query($conn,"select * from login_user where id = '$user_id' and user_status = '$status'") or die (mysqli_error($conn));
 $rs1 = mysqli_fetch_array($q);
 
               $id1=$rs1['id'];
               $fname1=$rs1['name'];
               $admin1=$rs1['email_address'];
               $pass1=$rs1['user_password'];
               $status=$rs1['user_status'];
               $department=$rs1['department'];
?>
  <div class="modal-dialog" role="document">
    <form method="POST">
    
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-edit" ></i> Edit account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body mx-3">
           <div class="md-form mb-5">
            <input type="hidden" class="form-control" name="id" value="<?php echo $id1;?>"><br>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" value="<?php echo $fname1;?>" class="form-control validate">
          <label for="orangeForm-name">Your name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="email_address" value="<?php echo $admin1;?>" class="form-control validate">
          <label for="orangeForm-email">Your email</label>
        </div>
        <?php
                  $query = mysqli_query($conn,"SELECT * FROM department where `id` = $department") or die (mysqli_error($con));
                  $department_val=mysqli_fetch_array($query)
              ?>
        Current department: <?php echo $department_val['name'] ?>
        <div class="md-form mb-5">
            <select id="materialFormCardPasswordEx" name="department" class="form-control">
              <?php
                  $query = mysqli_query($conn,"SELECT * FROM department") or die (mysqli_error($con));
                  while($department=mysqli_fetch_array($query)){
                    $name = $department['name'];
                    $id = $department['id'];

              ?>
                <option value="<?php echo $id ?>"><?php echo $name?></option>
              <?php }?> 
              
            </select>
                  </div>
      
      <div class="md-form mb-5">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="current_password" class="form-control validate">
          <label for="orangeForm-pass">Current password</label>
        </div>

        </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" name="edit">UPDATE</button>
      </div>
    </div>
  </div>
</div>
</form>


<div class="modal fade" id="modaldeletedd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-edit"></i> Delete Account</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" id="orangeForm-pass" name="user_password_delete" class="form-control validate">
            <label for="orangeForm-pass">Password</label>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-danger" name="delete_account">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <!--modal--->
 <?php 

 require_once("include/connection.php");
  
 if(isset($_POST['edit'])){
  $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);
         $current_password = mysqli_real_escape_string($conn,$_POST['current_password']);
         $department = mysqli_real_escape_string($conn,$_POST['department']);
  if (password_verify($current_password, $pass1)) {
      //  $user_status = mysqli_real_escape_string($conn,$_POST['status']);
    // if($user_pass == $user_pass2)
    // {
    echo "<script type = 'text/javascript'>alert('You have update your account');document.location='home.php'</script>";

     mysqli_query($conn,"UPDATE `login_user` SET `name` = '$user_name', `email_address` = '$email_address', `department` = '$department'where id='$user_id'") or die (mysqli_error($conn));
     //  mysqli_query($conn,"UPDATE `login_user` SET `name` = '$user_name', `email_address` = '$email_address', `user_password` = '$user_password' where id='$id'") or die (mysqli_error($conn));
    //   echo "<script type = 'text/javascript'>alert('You have edit your account');document.location='home.php'</script>";
     
    // }else{
    //   echo "<script type = 'text/javascript'>alert('Password didn't match');document.location='home.php'</script>";

    // }
  } else {
    echo "<script type = 'text/javascript'>alert('Wrong password');document.location='home.php'</script>";

  }

}


 $user_id = $_SESSION["email_address"];  
 if (isset($_POST['edit_pass'])) {
  $current_password = $_POST['current_password'];
  $user_pass = $_POST['user_password'];
  $user_pass2 = $_POST['confirmation_password'];

  // Verify if the current password matches
  if(!password_verify($user_pass, $pass1))
  {
    if (password_verify($current_password, $pass1)) {
        // Check if the new password and confirmation match
        if ($user_pass == $user_pass2) {
            // Hash the new password
            $hashed_user_pass = password_hash($user_pass, PASSWORD_DEFAULT, array('cost' => 12));
            
            // Update the password in the database
            mysqli_query($conn, "UPDATE `login_user` SET `user_password` = '$hashed_user_pass' WHERE id='$user_id'")
                or die(mysqli_error($conn));
            echo "<script type = 'text/javascript'>alert('You have completely change your password');document.location='home.php'</script>";

            
            // Redirect to home.php after successful password change
            header("Location: home.php");
            exit; // Make sure to stop executing further code after redirection
        } else {
          echo "<script type = 'text/javascript'>alert('password didn't match');document.location='home.php'</script>";

        }
    } else {
      echo "<script type = 'text/javascript'>alert('wrong password');document.location='home.php'</script>";

    }
  }else{
    echo "<script type = 'text/javascript'>alert('Don'y use your old password');document.location='home.php'</script>";

  }
}


if (isset($_POST['delete_account'])) {
  $user_pass_delete = $_POST['user_password_delete'];
    // Verify if the current password matches
    if (password_verify($user_pass_delete, $pass1)) {
      // Define the path to the user's folder
      $user_folder_path = "../uploads/" . $fname1;

      // Check if the user's folder exists
      if (file_exists($user_folder_path) && is_dir($user_folder_path)) {
          // Define archive directory
          $archive_directory = "../archived/deleted_accounts";

          // Create archive directory if it doesn't exist
          if (!file_exists($archive_directory)) {
              mkdir($archive_directory, 0777, true);
          }

          // Define new folder name with datetime prefix
          $new_folder_name = date('Y-m-d_H-i-s') . "_" . $fname1;

          // New path for the archived folder
          $new_folder_path = $archive_directory . "/" . $new_folder_name;

          // Move the folder to the archive directory with the new name
          if (rename($user_folder_path, $new_folder_path)) {
              // If folder move is successful, insert archive folder info into the database
              mysqli_query($conn, "INSERT INTO archive_folder (folder_name, owner) VALUES ('$new_folder_name', '$fname1')");

              // Delete the user account from the database
              mysqli_query($conn, "DELETE FROM login_user WHERE name='$fname1'");

              // Delete related files from the database
              mysqli_query($conn, "DELETE FROM upload_files WHERE `EMAIL`='$fname1'");

              $_SESSION = NULL;
              $_SESSION = [];
              session_unset();
              session_destroy();


              echo "<script>alert('User folder archived successfully!');</script>";
              echo "<script>window.location='index.html';</script>";
          } else {
              echo "<script>alert('Failed to archive user folder!');</script>";
          }
      } else {
          echo "<script>alert('User folder not found!');</script>";
      }
  } else {
      echo "<script>alert('Wrong password');</script>";
  }
}

?>