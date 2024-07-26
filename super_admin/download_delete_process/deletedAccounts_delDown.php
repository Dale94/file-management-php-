<?php

 require_once("../include/connection.php");

 if (isset($_POST['delete'])) {

    // Function to delete folder recursively
    function deleteFolder($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? deleteFolder("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    // Check if any folders are selected
    if (empty($_POST['checkbox'])) {
        echo "<script>alert('Please select folders to delete!');</script>";
    } else {
        // Loop through each selected folder ID
        foreach ($_POST['checkbox'] as $folder_id) {
            // Fetch the folder details from the database
            $folder_id = mysqli_real_escape_string($conn, $folder_id);
            $query = mysqli_query($conn, "SELECT * FROM `archive_folder` WHERE id='$folder_id'");
            if ($query && mysqli_num_rows($query) > 0) {
                $folder = mysqli_fetch_assoc($query);
                $folder_name = $folder['folder_name'];
                $folder_path = "../../archived/deleted_accounts/" . $folder_name;

                // Check if the folder exists
                if (is_dir($folder_path)) {
                    // Remove the folder and its contents recursively
                    mysqli_query($conn, "DELETE FROM `archive_folder` WHERE id='$folder_id'");

                    deleteFolder($folder_path);
                    echo "<script>alert('the archived folder has been deleted'); window.location='../view_deleted_accounts.php';</script>";

                } else {
                    echo "Folder not found: " . $folder_name . "<br>";
                }
            } else {
                echo "Error fetching folder details.";
            }
        }
    }
}else if(isset($_POST['download'])) {
    // Initialize the ZipArchive object
    $zip = new ZipArchive;
    $zipname = 'selected_folders.zip';

    // Check if the zip file can be created
    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Cannot create zip file");
    }

    // Check if any folders are selected
    if (empty($_POST['checkbox'])) {
        echo "<script>alert('Please select folders to download!');</script>";
    } else {
        // Loop through each selected folder ID
        foreach ($_POST['checkbox'] as $folder_id) {
            // Fetch the folder details from the database
            $folder_id = mysqli_real_escape_string($conn, $folder_id);
            $query = mysqli_query($conn, "SELECT * FROM `archive_folder` WHERE id='$folder_id'");
            if ($query && mysqli_num_rows($query) > 0) {
                $folder = mysqli_fetch_assoc($query);
                $folder_name = $folder['folder_name'];
                $folder_path = "../../archived/deleted_accounts/" . $folder_name;

                // Check if the folder exists
                if (is_dir($folder_path)) {
                    // Add the folder and its contents to the zip archive
                    $zip->addEmptyDir($folder_name);
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder_path), RecursiveIteratorIterator::LEAVES_ONLY);
                    foreach ($files as $name => $file) {
                        if (!$file->isDir()) {
                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($folder_path) + 1);
                            $zip->addFile($filePath, $folder_name . '/' . $relativePath);
                        }
                    }
                } else {
                    echo "Folder not found: " . $folder_name . "<br>";
                }
            } else {
                echo "Error fetching folder details.";
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
}

?>
