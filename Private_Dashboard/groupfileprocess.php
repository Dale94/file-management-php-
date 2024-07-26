<?php
require_once("include/connection.php");
session_start();
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file

                            // Original group_name


    $user = $_POST['email'];
    $department = $_POST['department'];

    $query_members = mysqli_query($conn, "SELECT * FROM group_names WHERE group_name = '$user'");
    if ($row = mysqli_fetch_assoc($query_members)) {
        $original_group_name = $row['group_name'];
        // Now you have the original group_name
        $group_name = $original_group_name;

        // Proceed with your logic using $group_name

        // Now you can use $group_name in your queries or other operations
    } else {
        // Handle the case where no matching group_name is found
        echo "Invalid group name!";
    }

    $original_group_name = $group_name;

    // Hash the group_name using md5 (you can use other hashing algorithms as well)
    $hashed_group_name = md5($original_group_name);

    // URL encode the hashed group_name
    $encoded_hashed_group_name = urlencode($hashed_group_name);

    // Create a folder for the user if it doesn't exist
    $user_folder = '../uploads/group_files/' . $user;
    if (!file_exists($user_folder)) {
        mkdir($user_folder, 0777, true); // Create the user folder recursively
    }

    $file_total = count($_FILES['myfile']['name']); 

    for($i=0; $i < $file_total; $i++)
    {
      $filename = $_FILES['myfile']['name'][$i];

    // $Admin = $_FILES['admin']['name'];
    // destination of the file on the server
    $destination = $user_folder . '/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'][$i];
    $size = $_FILES['myfile']['size'][$i];



    if (!in_array($extension, ['pdf', 'docx', 'doc', 'pptx', 'ppt', 'xlsx', 'xls', 'pdf', 'odt'])) {
        echo '<script type="text/javascript">
        alert("Your file extension must be: .pdf");
        window.location = "view_group_detail.php?group_name=' . $encoded_hashed_group_name . '";
    </script>';

    } elseif ($_FILES['myfile']['size'][$i] > 2000000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else{
      
        $query=mysqli_query($conn,"SELECT * FROM `group_files` WHERE `file_name` = '$filename' AND `group_name` = '$user'");
           $counter=mysqli_num_rows($query);
            
            if ($counter == 1) 
              { 
                $query_members = mysqli_query($conn, "SELECT * FROM group_names WHERE group_name = '$user'");

                $row = mysqli_fetch_assoc($query_members);

                    $creator = $row['creator'];

                    if($_SESSION['name'] == $creator)
                    {
                        echo '
                        <script type = "text/javascript">
                            alert("Files already taken");
                            window.location = "view_group_detail.php?group_name=' . $encoded_hashed_group_name . '";
                        </script>';
                    }else{
                        echo '
                        <script type = "text/javascript">
                            alert("Files already taken");
                            window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";
                        </script>';
                    }
              } else{

                date_default_timezone_set("asia/manila");
                $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));
                

                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO group_files (file_name, group_name, department_id, time) VALUES ('$filename', '$user', '$department', '$time')";
                    $row = mysqli_fetch_assoc($query_members);

                    $query_members = mysqli_query($conn, "SELECT * FROM group_names WHERE group_name = '$user'");
                    $row = mysqli_fetch_assoc($query_members);


                    $creator = $row['creator'];

                    if($_SESSION['name'] == $creator)
                    {
                        if (mysqli_query($conn, $sql)) {
                            echo '
                                <script type = "text/javascript">
                                alert("File Upload");
                                window.location = "view_group_detail.php?group_name=' . $encoded_hashed_group_name . '";
                            </script>';

                        }
                    }else{
                        if (mysqli_query($conn, $sql)) {
                            echo '
                                <script type = "text/javascript">
                                alert("File Upload");
                                window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";
                            </script>';

                        }
                    }
                    
                } else {
                    echo "Failed Upload files!";
                }
              }
      
        
    
  }
    }
    
}
?>