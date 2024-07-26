<?php
require_once("include/connection.php");

if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file

    $user = $_POST['email'];
    $department = $_POST['department'];

    // Create a folder for the user if it doesn't exist
    $user_folder = '../uploads/' . $user;
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
                echo '<script type = "text/javascript">
                            alert("You file extension must be:  .pdf");
                            window.location = "add_file.php";
                    </script>
                     ';
    } elseif ($_FILES['myfile']['size'][$i] > 2000000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else{
      
        $query=mysqli_query($conn,"SELECT * FROM `upload_files` WHERE `name` = '$filename' AND `email` = '$user'");
           $counter=mysqli_num_rows($query);
            
            if ($counter == 1) 
              { 
                   echo '
                <script type = "text/javascript">
                    alert("Files already taken");
                    window.location = "add_document.php";
                </script>


               ';
              } else{

                date_default_timezone_set("asia/manila");
                $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));
                

                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO upload_files (name, size, download, timers, admin_status, email, department, archived) VALUES ('$filename', $size, 0, '$time', 'Admin', '$user', '$department', 'No')";
                    if (mysqli_query($conn, $sql)) {
                        echo '
                            <script type = "text/javascript">
                            alert("File Upload");
                            window.location = "add_document.php";
                        </script>';

                    }
                } else {
                    echo "Failed Upload files!";
                }
              }
      
        
    
  }
    }
    
}
?>