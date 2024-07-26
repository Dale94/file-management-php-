<style>
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }

  .barchartdata{
    width: 95%;
    padding-left: 250px;   
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}




@media screen and (max-width: 1300px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }

  .barchartdata{
  width: 95%;
  padding-left: 250px;       
}
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 900px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }

  .barchartdata{
  width: 70%;
  margin-left: 260px; 
  padding-left: 0;   

}
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }

  .barchartdata{
  width: 60%;
  margin-left: 250px; 
  padding-left: 0;   

}
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

.sidebar {
    width: 265px;
    height: 100%; /* Adjust height as needed */
    position: fixed;
    overflow-y: auto; /* Add scrollbar when content exceeds height */
    top: 0px; /* Adjust top position */
    left: 0;
    background-color: #f8f9fa; /* Optional: Add background color */
    padding: 10px; /* Optional: Add padding */
  }

  .sidebar a {
  float: left;
  transition: color 0.3s, transform 0.3s;
}

.sidebar a:hover {
  color: blue; /* Change color to blue on hover */
  transform: translateX(5px); /* Move the link 5 pixels to the right on hover */
}

  .sidebar img {
    padding-left: 0px;
  }

  .list-group {
    margin-bottom: 0; /* Remove default margin */
  }
</style>

<div class="sidebar">
    <img src="img/images.png" height="140px" alt="" style="padding-left: 40px;">
    <div class="list-group list-group-flush">
        <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item active waves-effect">
                <i class="fas fa-chart-pie mr-3"></i>Dashboard <br> <?php echo ucwords(htmlentities($id)); ?>
            </a>
            <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalRegisterForm">
                <i class="fas fa-user mr-3"></i>Add Admin
            </a>
            <a href="view_admin.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-users"></i> View Admin
            </a>
            <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalRegisterForm2">
                <i class="fas fa-user mr-3"></i>Add User
            </a>
            <a href="view_user.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-users"></i>  View User
            </a>
            <a href="add_document.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-file-medical"></i> Add Document
            </a>
            <a href="view_userfile.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-folder-open"></i> View User File
            </a>
            <a href="view_group.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-folder-open"></i> View Group
            </a>
            <a data-toggle="modal" data-target="#modalRegisterFormss" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-chalkboard-teacher"></i> Edit Account
            </a>
            <a data-toggle="modal" data-target="#modalpassword" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-chalkboard-teacher"></i> Change password
            </a>
            <a data-toggle="modal" data-target="#modaldeletedd" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-chalkboard-teacher"></i> Delete account
            </a>
            <a href="logout.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-chalkboard-teacher"></i> Sign Out
            </a>
        </div>
    </div>


    </div>

    <div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <?php 

require_once("include/connection.php");
  
$user_id = $_SESSION["admin_user"];
$q = mysqli_query($conn,"select * from admin_login where admin_user = '$user_id'") or die (mysqli_error($conn));
 $rs1 = mysqli_fetch_array($q);
 
               $id1=$rs1['id'];
               $fname1=$rs1['name'];
               $admin1=$rs1['admin_user'];
               $pass1=$rs1['admin_password'];
               $dep=$rs1['department'];
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

  <div class="modal-dialog" role="document">
    <form method="POST">
    
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-edit" ></i> Edit User</h4>
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


<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="create_Admin.php" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
           <div class="md-form mb-5">
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Admin name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="admin_user" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-email">Admin email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="admin_password" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Admin password</label>
        </div>
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="confirmation_password" class="form-control validate">
          <label for="orangeForm-pass">Confirmation admin password</label>
        </div>
        <div class="md-form mb-4">
          <!-- <i class="fas fa-user prefix grey-text"></i> -->
          <input type="hidden" id="orangeForm-pass" name="admin_status" value = "Admin" class="form-control validate" readonly="">
        </div>
        <div class="md-form mb-4">
            <select name="department" class="form-control">
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
          <input type="password" id="orangeForm-pass" name="admin_password" class="form-control validate">
          <label for="orangeForm-pass">Your password</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" name="reg">Sign up</button>
      </div>
    </div>
  </div>
</div>
</form>
<!--end modaladmin-->
  <!--Add user-->
   <div class="modal fade" id="modalRegisterForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="create_user.php" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add User Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
           <div class="md-form mb-5">

        </div>
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate">
          <label data-error="wrong" data-success="right" for="orangeForm-name">USer name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="email_address" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-email">User email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="user_password" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">User password</label>
        </div>
        
         <div class="md-form mb-4">
          <!-- <i class="fas fa-user prefix grey-text"></i> -->
          <input type="hidden" id="orangeForm-pass" name="user_status" value = "Employee" class="form-control validate" readonly="">
        </div>
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="confirmation_password" class="form-control validate">
          <label for="orangeForm-pass">Confirmation password</label>
          </div>
        <div class="md-form mb-4">
            <select name="department" class="form-control">
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
          <input type="password" id="orangeForm-pass" name="admin_password" class="form-control validate">
          <label for="orangeForm-pass">Your password</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" name="reguser">Sign up</button>
      </div>
    </div>
  </div>
</div>
</form>
<!--end modaluser-->

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
    echo "<script type = 'text/javascript'>alert('You have update your account');document.location='dashboard.php'</script>";

     mysqli_query($conn,"UPDATE `admin_login` SET `name` = '$user_name', `admin_user` = '$email_address', `department` = '$department'where admin_user='$admin1'") or die (mysqli_error($conn));
     //  mysqli_query($conn,"UPDATE `login_user` SET `name` = '$user_name', `email_address` = '$email_address', `user_password` = '$user_password' where id='$id'") or die (mysqli_error($conn));
    //   echo "<script type = 'text/javascript'>alert('You have edit your account');document.location='home.php'</script>";
     
    // }else{
    //   echo "<script type = 'text/javascript'>alert('Password didn't match');document.location='home.php'</script>";

    // }
  } else {
    echo "<script type = 'text/javascript'>alert('Wrong password');document.location='dashboard.php'</script>";

  }

}

// Other PHP sections...
?>


  <!--modal--->
 <?php 

 require_once("include/connection.php");
 $user_id = $_SESSION["admin_user"];  
 if (isset($_POST['edit_pass'])) {
  $current_password = $_POST['current_password'];
  $user_pass = $_POST['user_password'];
  $user_pass2 = $_POST['confirmation_password'];

  $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}$/';
    if (!preg_match($pattern, $user_pass)) {
        // Password does not meet the pattern requirements
        echo '<script type="text/javascript">alert("Password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 7 characters long."); window.location = "../signup.php";</script>';
        exit; // Stop further execution
    }

  // Verify if the current password matches
  if(!password_verify($user_pass, $pass1))
  {
    if (password_verify($current_password, $pass1)) {
        // Check if the new password and confirmation match
        if ($user_pass == $user_pass2) {
            // Hash the new password
            $hashed_user_pass = password_hash($user_pass, PASSWORD_DEFAULT, array('cost' => 12));
            
            // Update the password in the database
            mysqli_query($conn, "UPDATE `admin_login` SET `admin_password` = '$hashed_user_pass' WHERE id='$user_id'")
                or die(mysqli_error($conn));
            echo "<script type = 'text/javascript'>alert('You have completely change your password');document.location='dashboard.php'</script>";

            
            // Redirect to home.php after successful password change
            header("Location: dashboard.php");
            exit; // Make sure to stop executing further code after redirection
        } else {
          echo "<script type = 'text/javascript'>alert('password didn't match');document.location='dashboard.php'</script>";

        }
    } else {
      echo "<script type = 'text/javascript'>alert('wrong password');document.location='dashboard.php'</script>";

    }
  }else{
    echo "<script type = 'text/javascript'>alert('Don't use your old password');document.location='dashboard.php'</script>";

  }
}

if (isset($_POST['delete_account'])) {
  // Get user input
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
              // If folder move is successful, delete the user account from the database
              mysqli_query($conn, "INSERT INTO archive_folder (folder_name, owner) VALUES ('$new_folder_name', '$fname1')");
              mysqli_query($conn, "DELETE FROM admin_login WHERE id='$user_id'");
              mysqli_query($conn, "DELETE FROM upload_files WHERE EMAIL='$fname1'");
              // Delete associated group and archive its folder

                $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


                  $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));

                  $row = mysqli_fetch_array($r);

                  $owner=$row['name'];
                  $g = mysqli_query($conn,"SELECT * FROM group_names where owner = '$owner'") or die (mysqli_error($con));
                  $g_row = mysqli_fetch_array($g);

                  $group_name = $g_row['group_name'];

                  $password = $_POST['current_password'];

                  // Define the path to the user's folder
                  $user_folder_path = "../uploads/group_files/" . $group_name;
                  // Define archive directory
                  $archive_directory = "../archived/deleted_groups";

                  // Create archive directory if it doesn't exist
                  if (!file_exists($archive_directory)) {
                      mkdir($archive_directory, 0777, true);
                  }

                  // Define new folder name with datetime prefix
                  $new_folder_name = date('Y-m-d_H-i-s') . "_" . $group_name;

                  // New path for the archived folder
                  $new_folder_path = $archive_directory . "/" . $new_folder_name;

                  // Move the folder to the archive directory with the new name
                  if (rename($group_folder_path, $new_folder_path)) {
                      // If folder move is successful, delete the group data from the database
                      mysqli_query($conn, "INSERT INTO archive_group_folder (folder_name, group_name) VALUES ('$new_folder_name', '$group_name')");
                      mysqli_query($conn, "DELETE FROM group_names WHERE group_name='$group_name'");
                      mysqli_query($conn, "DELETE FROM group_files WHERE group_name='$group_name'");
                      mysqli_query($conn, "DELETE FROM group_members WHERE group_name='$group_name'");

                      $_SESSION = NULL;
                      $_SESSION = [];
                      session_unset();
                      session_destroy();

                      echo "<script type='text/javascript'>alert('LogOut Successfully!');
                                document.location='index.html'</script>";
                  } else {
                      echo "<script>alert('Failed to archive group folder!');</script>";
                  }
              
              echo "<script>alert('User folder archived successfully!');</script>";
              echo "<script>window.location='index.html';</script>";
              exit; // Exit after redirect
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
