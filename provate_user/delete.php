<?php

 require_once("include/connection.php");

 if(isset($_POST['delete']))
 {
    $id = mysqli_real_escape_string($conn, $_POST['ID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    date_default_timezone_set("Asia/Manila"); // Corrected timezone identifier
    $time = date("M-d-Y h:i A");

    $r = mysqli_query($conn, "SELECT * FROM login_user WHERE name = '$name'") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($r);
    $depp = $row['department'];
    $status = $row['user_status'];

    $multi_id = $_POST['checkbox'];

    if (empty($multi_id)) {
        echo "<script>alert('Please select files to delete!'); window.location='home.php';</script>";
        exit;
    }

    $archiveFolder = "../archived/" . $name . "/" . date("Y-m-d");

    if (!file_exists($archiveFolder)) {
        mkdir($archiveFolder, 0777, true);
    }

    foreach ($multi_id as $del_id) {
        $file_query = mysqli_query($conn, "SELECT `NAME` FROM upload_files WHERE `ID`='$del_id' AND `EMAIL` = '$name'");
        $file = mysqli_fetch_array($file_query);

        if ($file) {
            $file_name = $file['NAME'];
            $dir = "../uploads/" . $name;

            if (file_exists($dir . '/' . $file_name)) {
                $timestamp = time();
                $new_file_name = $timestamp . '_' . $file_name;

                if (rename($dir . '/' . $file_name, $archiveFolder . '/' . $new_file_name)) {
                    $conn->query("DELETE FROM `upload_files` WHERE `ID` = '$del_id'");
                    $sql = "INSERT INTO archived_files (name, date_time, file_name, department, admin_status) VALUES ('$name', '$time', '$new_file_name', '$depp', '$status')"; // Fixed SQL query

                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("File archived successfully!"); window.location="home.php";</script>';
                    } else {
                        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location="home.php";</script>'; // Handle SQL insert error
                    }
                } else {
                    echo '<script>alert("Failed to move file to archive folder!"); window.location="home.php";</script>';
                }
            } else {
                echo '<script>alert("File ' . $file_name . ' not found in directory!"); window.location="home.php";</script>';
            }
        } else {
            echo '<script>alert("File record not found or Files not yours!"); window.location="home.php";</script>';
        }
    }

 }else if(isset($_POST['download']))
 {
    $name = mysqli_real_escape_string($conn,$_POST['name']);


    $zip = new ZipArchive;
    $zipname = 'selected_files.zip';
    $dir = "../uploads/" . $name;
    // date_default_timezone_set("asia/manila");
    // $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));


    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Cannot create zip file");
    }

    if (empty($_POST['checkbox'])) {
        echo "<script>alert('Please select files to download!'); window.location='add_document.php';</script>";
        exit; // Stop further execution
    }

    // Loop through each selected ID
    foreach ($_POST['checkbox'] as $del_id) {
        // Sanitize the input to prevent SQL injection
        $del_id = mysqli_real_escape_string($conn, $del_id);

        // Fetch the file details from the database
        $sql = "SELECT * FROM upload_files WHERE ID='$del_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful and file exists
        if ($result && mysqli_num_rows($result) > 0) {
            $file = mysqli_fetch_assoc($result);
            $filepath = $dir . '/' . $file['NAME'];

            // Check if the file exists
            if (file_exists($filepath)) {
                // Add the file to the zip archive
                $zip->addFile($filepath, basename($filepath));

                // Update download count in the database
                $newCount = $file['DOWNLOAD'] + 1;
                $updateQuery = "UPDATE upload_files SET DOWNLOAD=$newCount WHERE ID='$del_id'";
                mysqli_query($conn, $updateQuery);
            } else {
                echo "File not found: " . $name . '/' . $file['NAME'] . "<br>";
            }
        } else {
            echo "Error fetching file details.";
        }
    }

    // Close the zip archive
    $zip->close();

    // Download the zip file
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);

    // Delete the zip file after downloading
    unlink($zipname);
 }

?>
