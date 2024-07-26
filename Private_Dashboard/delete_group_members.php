<?php

 require_once("include/connection.php");
    session_start();
 if(isset($_POST['delete']))
 {
    $id = mysqli_real_escape_string($conn, $_POST['ID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    date_default_timezone_set("Asia/Manila"); // Corrected timezone identifier
    $time = date("M-d-Y h:i A");


    $query = mysqli_query($conn, "SELECT * FROM group_names WHERE group_name = '$name'");
    if ($row = mysqli_fetch_assoc($query)) {
        $original_group_name = $row['group_name'];
        // Now you have the original group_name
        $group_name = $original_group_name;

        // Proceed with your logic using $group_name

        // Now you can use $group_name in your queries or other operations
    } else {
        // Handle the case where no matching group_name is found
        echo "Invalid group name!";
    }


    // Original group_name
    $original_group_name = $group_name;

    // Hash the group_name using md5 (you can use other hashing algorithms as well)
    $hashed_group_name = md5($original_group_name);

    // URL encode the hashed group_name
    $encoded_hashed_group_name = urlencode($hashed_group_name);

    // $r = mysqli_query($conn, "SELECT * FROM login_user WHERE name = '$name'") or die(mysqli_error($conn));
    // $row = mysqli_fetch_array($r);
    // $depp = $row['department'];
    // $status = $row['user_status'];

    $multi_id = $_POST['checkbox'];
    $deparment = $_SESSION['department'];

    if (empty($multi_id)) {
        echo '<script>alert("Please select files to delete!"); "view_group_detail.php?group_name=' . $encoded_hashed_group_name . '"</script>';
        header('location: view_joingroup.php?group_name=' . $encoded_hashed_group_name);
        exit;
    }

    $archiveFolder = "../archived/group_files/" . $name . "/" . date("Y-m-d");

    if (!file_exists($archiveFolder)) {
        mkdir($archiveFolder, 0777, true);
    }

    foreach ($multi_id as $del_id) {
        $file_query = mysqli_query($conn, "SELECT `file_name` FROM group_files WHERE `id`='$del_id' AND `department_id` = '$deparment'");
        $file = mysqli_fetch_array($file_query);

        if ($file) {
            $file_name = $file['file_name'];
            $dir = "../uploads/group_files/" . $name;

            if (file_exists($dir . '/' . $file_name)) {
                $timestamp = time();
                $new_file_name = $timestamp . '_' . $file_name;

                if (rename($dir . '/' . $file_name, $archiveFolder . '/' . $new_file_name)) {
                    $conn->query("DELETE FROM `group_files` WHERE `ID` = '$del_id'");
                    $sql = "INSERT INTO archive_group_files (group_name, date_time, file_name) VALUES ('$name', '$time', '$new_file_name')"; // Fixed SQL query

                    if (mysqli_query($conn, $sql)) {
                            
                        echo '<script>alert("File archived successfully!"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>';
                    } else {
                        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>'; // Handle SQL insert error
                    }
                } else {
                    echo '<script>alert("Failed to move file to archive folder!"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>';
                }
            } else {
                echo '<script>alert("File ' . $file_name . ' not found in directory!"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>';
            }
        } else {
            echo '<script>alert("File record not found or Files not yours!"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>';
        }
    }

 }else if(isset($_POST['download']))
 {
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $query = mysqli_query($conn, "SELECT * FROM group_names WHERE group_name = '$name'");
    if ($row = mysqli_fetch_assoc($query)) {
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



    $zip = new ZipArchive;
    $zipname = 'selected_files.zip';
    $dir = "../uploads/group_files/" . $name;
    // date_default_timezone_set("asia/manila");
    // $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));


    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Cannot create zip file");
    }

    if (empty($_POST['checkbox'])) {
        echo '<script>alert("Please select files to download!"); window.location = "view_joingroup.php?group_name=' . $encoded_hashed_group_name . '";</script>';
        exit; // Stop further execution
    }

    // Loop through each selected ID
    foreach ($_POST['checkbox'] as $del_id) {
        // Sanitize the input to prevent SQL injection
        $del_id = mysqli_real_escape_string($conn, $del_id);

        // Fetch the file details from the database
        $sql = "SELECT * FROM group_files WHERE ID='$del_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful and file exists
        if ($result && mysqli_num_rows($result) > 0) {
            $file = mysqli_fetch_assoc($result);
            $filepath = $dir . '/' . $file['file_name'];

            // Check if the file exists
            if (file_exists($filepath)) {
                // Add the file to the zip archive
                $zip->addFile($filepath, basename($filepath));

                // Update download count in the database
                // $newCount = $file['DOWNLOAD'] + 1;
                // $updateQuery = "UPDATE group_files WHERE ID='$del_id'";
                // mysqli_query($conn);
            } else {
                echo "File not found: " . $name . '/' . $file['file_name'] . "<br>";
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
