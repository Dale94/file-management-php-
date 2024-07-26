<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Check if the username session is NOT set then this page will jump to the login page
if (!isset($_SESSION['admin_user'])) {
    header('Location: index.html');
}

require_once("include/connection.php");

// Retrieve the hashed_group_name from the URL parameter
$encoded_hashed_group_name = $_GET['group_name'];

// URL decode the hashed_group_name
$hashed_group_name = urldecode($encoded_hashed_group_name);
$d_session = $_SESSION['department'];

        


// Query the database to find the matching group_name
$query = mysqli_query($conn, "SELECT * FROM group_names WHERE MD5(group_name) = '$hashed_group_name'");
if ($row = mysqli_fetch_assoc($query)) {
    $original_group_name = $row['group_name'];
    $group_department = $row['department'];
    // Now you have the original group_name
    $group_name = $original_group_name;

    if($d_session != $group_department)
    {
            header('location: view_group.php');
        }

    // Proceed with your logic using $group_name

    // Now you can use $group_name in your queries or other operations
} else {
    // Handle the case where no matching group_name is found
    echo "Invalid group name!";
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VIEW GROUP DETAILS</title>
    <link rel="icon" href="img/images.png" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <!-- DataTables JS -->
    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <style>
        /* Your custom styles here */
    </style>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
            });
        })
    </script>

    
</head>
<body class="grey lighten-3">
    <!-- Main Navigation -->
    <?php 
    $id = $_SESSION['admin_user'];
    include('side_bar.php');
    ?>
    <header>
    <?php
    require_once("include/connection.php");
    $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);
    $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));
    $row = mysqli_fetch_array($r);
    $id=$row['admin_user'];
    $department_=$row['department'];
    $name__=$row['name'];
    ?>
    </header>

    <!-- Main layout -->
    <main class="pt-5 mx-lg-5 barchartdata">
        <div class="container-fluid mt-5">
            <!-- Buttons -->
            
            <!-- Heading -->
            <div class="card mb-4 wow fadeIn">
                <div class="card-body d-sm-flex justify-content-between">
                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <a href="dashboard.php">Home Page</a>
                        <span>/</span>
                        <span>View Group Detail</span>
                    </h4>
                </div>
            </div>
            <!-- Heading -->

            <!-- Table and Card -->
            <div class="row">
                <div class="col-md-3">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST">
                                <button class="btn btn-info" name="update_members">Update members</button>
                                <button class="btn btn-danger" name="delete_group">Delete Group</button>
                                <div class="md-form mb-4">
                                    <i class="fas fa-lock prefix grey-text"></i>
                                    <input type="password" id="orangeForm-pass" name="current_password" class="form-control validate">
                                    <label for="orangeForm-pass">Your password</label>
                                </div>
                                


                                <?php
                                $r = mysqli_query($conn,"SELECT * FROM group_names where group_name = '$group_name'") or die (mysqli_error($con));
                                $row = mysqli_fetch_array($r);
                                $creator_department = $row['department'];


                                
                                // Fetch current group members from the database
                                $current_group_members = [];
                                $current_group_query = "SELECT * FROM group_members WHERE group_name = '$group_name'";
                                $current_group_result = mysqli_query($conn, $current_group_query) or die(mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($current_group_result)) {
                                    $current_group_members[] = $row['department_id'];
                                }

                                // Fetch department data from the database
                                $query = mysqli_query($conn, "SELECT * FROM department where id != '$creator_department'") or die(mysqli_error($con));
                                ?>

                                <!-- Display checkboxes for departments -->
                                <?php while ($department = mysqli_fetch_array($query)) { ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="department_<?php echo $department['id']; ?>" name="departments[]" value="<?php echo $department['id']; ?>" <?php echo in_array($department['id'], $current_group_members) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="department_<?php echo $department['id']; ?>"><?php echo $department['name']; ?></label>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
                <div class="col-md-9">
                    <!-- Table -->
                    <Form name="multiple_files" method="post" action="delete_group.php">
                    <!-- Heading -->
                    <div class="">
                    <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegisterForm">Add File</button> -->
                    <?php
                            // Original group_name
                            $original_group_name = $group_name;

                            // Hash the group_name using md5 (you can use other hashing algorithms as well)
                            $hashed_group_name = md5($original_group_name);

                            // URL encode the hashed group_name
                            $encoded_hashed_group_name = urlencode($hashed_group_name);
                    ?>
                    <input type="hidden" name= "name" value="<?php echo ucwords(htmlentities($group_name)); ?>" class="form-control" readonly="">
                    <a href="add_groupfile.php?group_name=<?php echo $encoded_hashed_group_name; ?>"><button type="button" class="btn btn-success"><i class="fas fa-file-medical"></i>  Add File</button></a>
                    <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete Files</button>
                    <button type="submit" class="btn btn-primary" name="download"><i class="fa fa-download"></i> Download Files</button>
                    </div>

                    <div class="table-responsive">
                        <table id="dtable" class="table table-bordered" cellspacing="0" width="100%" >
                        <thead>

                        <th>Select</th>
                        <th>Filename</th>
                        <th>Uploader</th> 
                        <th>Date/Time Upload</th>
                    </thead>
                    <tbody>

                        
                        <tr>
                            <?php 
                    
                            require_once("include/connection.php");

                        $query = mysqli_query($conn,"SELECT DISTINCT id, file_name, department_id, time FROM group_files WHERE group_name != 'NONE' AND group_name = '$group_name'group by file_name DESC") or die (mysqli_error($con));
                        $query_empty = mysqli_query($conn,"SELECT DISTINCT id, file_name, department_id, time FROM group_files WHERE group_name = 'NONE' group by file_name DESC") or die (mysqli_error($con));
                        
                        if(mysqli_num_rows($query) < 1) {
                            $query_data = $query_empty;
                        }else{
                            $query_data =$query;
                        }
                        
                        while($file=mysqli_fetch_array($query_data)){
                            $id =  $file['id'];
                            $name =  $file['file_name'];
                            $departmentId =  $file['department_id'];
                            $time =  $file['time'];

                            $department_name = 'None'; // Default value if no department is found
                            $query_d = mysqli_query($conn,"SELECT * FROM department WHERE id = '$departmentId'") or die (mysqli_error($con));
                            if(mysqli_num_rows($query_d) > 0) {
                                $depp = mysqli_fetch_array($query_d);
                                $department_name = $depp['name'];
                            }



                        
                        ?>
                        <td><input name="checkbox[]" type="checkbox" value="<?php echo $id; ?>"></td>
                        <input type="hidden" name= "ID" value="<?php echo ucwords(htmlentities($id)); ?>" class="form-control" readonly="">

                        </form>
                        <td><?php echo  $name; ?></td>
                        <td><?php echo $department_name?></td>
                        <td><?php echo $time; ?></td>

                        </tr>
                    <?php } ?>
                    </div>
                    <!-- Table -->
                </div>
            </div>
        </div>
    </main>


    <!-- Scripts -->
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>   
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
</body>
</html>

<?php
// Check if the form is submitted
if(isset($_POST['update_members'])) {
    $user_id = $_SESSION["admin_user"];
    $q = mysqli_query($conn,"select * from admin_login where admin_user = '$user_id'") or die (mysqli_error($conn));
    $rs1 = mysqli_fetch_array($q);
    $pass1=$rs1['admin_password'];

    $password = $_POST['current_password'];

    if (password_verify($password, $pass1)) {

        // Get the selected department IDs
        $departments = isset($_POST['departments']) ? $_POST['departments'] : [];
        
        // Get the group name

        // Fetch current records for the group name from the database
        $current_records_query = "SELECT * FROM group_members WHERE group_name = '$group_name'";
        $current_records_result = mysqli_query($conn, $current_records_query) or die(mysqli_error($conn));

        // Store existing department IDs in an array
        $existing_departments = [];
        while ($row = mysqli_fetch_assoc($current_records_result)) {
            $existing_departments[] = $row['department_id'];
        }

        // Determine the departments to add, remove, or keep unchanged
        $departments_to_add = array_diff($departments, $existing_departments);
        $departments_to_remove = array_diff($existing_departments, $departments);

        // Update existing records
        foreach ($departments_to_add as $department_id) {
            // Insert new records for added departments
            $insert_query = "INSERT INTO group_members (group_name, department_id) VALUES ('$group_name', '$department_id')";
            mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
        }

        foreach ($departments_to_remove as $department_id) {
            // Delete records for removed departments
            $delete_query = "DELETE FROM group_members WHERE group_name = '$group_name' AND department_id = '$department_id'";
            mysqli_query($conn, $delete_query) or die(mysqli_error($conn));
        }

        // Display success message or perform any other action
        echo "<script type = 'text/javascript'>alert('updated successfully');document.location='view_group_detail.php?group_name=" . urlencode($group_name) .  "'</script>";

        // header('location: view_group_detail.pphp');
        // header("Refresh:0");
    }else {
        echo "<script type = 'text/javascript'>alert('wrong password');document.location='view_group_detail.php'</script>";
  
      }
}

if(isset($_POST['delete_group'])) {
    // $user_id = $_SESSION["admin_user"];
    $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


              $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));

              $row = mysqli_fetch_array($r);

    $pass1=$row['admin_password'];

    $password = $_POST['current_password'];


    // Verify if the current password matches
    if (password_verify($password, $pass1)) {
        // Define the path to the user's folder
        $user_folder_path = "../uploads/group_files/" . $group_name;
    
        // Check if the user's folder exists
        if (file_exists($user_folder_path) && is_dir($user_folder_path)) {
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
            if (rename($user_folder_path, $new_folder_path)) {
                // If folder move is successful, delete the user account from the database
                mysqli_query($conn, "INSERT INTO archive_group_folder (folder_name, group_name) VALUES ('$new_folder_name', '$group_name')");
                mysqli_query($conn, "DELETE FROM group_names WHERE group_name='$group_name'");
                mysqli_query($conn, "DELETE FROM group_files WHERE group_name='$group_name'");
                mysqli_query($conn, "DELETE FROM group_members WHERE group_name='$group_name'");
                echo '<script>alert("Group folder archived successfully!"); window.location = "view_group.php";</script>';

                header('location: view_group.php');
                exit; // Add this line
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