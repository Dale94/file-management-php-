<?php
// connect to the database
require_once("include/connection.php");

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file

   $user = $_POST['email'];

    $filename = $_FILES['myfile']['name'];

    // $Admin = $_FILES['admin']['name'];
    // destination of the file on the server
    $destination = '../uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];


    if (!in_array($extension, ['pdf'])) {
        echo '<script type = "text/javascript">
                    alert("You file extension must be:  .pdf");
                    window.location = "add_file.php";
                </script>
';
        // echo "<h6 style='color:red'>You file extension must be  .docx .doc .pptx .ppt .xlsx .xls .pdf .odt</h6>";

    } elseif ($_FILES['myfile']['size'] > 2000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else{


  $query=mysqli_query($conn,"SELECT * FROM `upload_files` WHERE `name` = '$filename'")or die(mysqli_error($conn));
           $counter=mysqli_num_rows($query);
            
            if ($counter == 1) 
              { 
                   echo '
                <script type = "text/javascript">
                    alert("Files already taken");
                    window.location = "home.php";
                </script>


               ';
              } 



// session_start();


//          $query2=mysqli_query($conn,"SELECT * FROM `login_user` WHERE `email_address` = 'email_address'")or die(mysqli_error($conn));
//            $rows=mysqli_num_rows($query2);
//            $user = $_SESSION['email_address'];

        date_default_timezone_set("asia/manila");
         $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));

        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO upload_files (name, size, download, timers, admin_status, email) VALUES ('$filename', $size, 0, '$time', 'Employee', '$user')";
            if (mysqli_query($conn, $sql)) {
                   echo '
                     <script type = "text/javascript">
                    alert("File Upload");
                    window.location = "home.php";
                </script>';

            }
        } else {
             echo "Failed Upload files!";
        }
    
  }
}
