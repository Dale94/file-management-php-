<?php

 if(isset($_POST['download']))
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
        $sql = "SELECT * FROM archiived_files WHERE id='$del_id'";
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
                // $newCount = $file['DOWNLOAD'] + 1;
                // $updateQuery = "UPDATE upload_files SET DOWNLOAD=$newCount WHERE ID='$del_id'";
                // mysqli_query($conn, $updateQuery);
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
