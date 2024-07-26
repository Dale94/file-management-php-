<?php

require_once("../include/connection.php");

if (isset($_POST['delete'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $multi_id = $_POST['checkbox'];

    foreach ($multi_id as $del_id) {
        $file_query = mysqli_query($conn, "SELECT `file_name`, `date_time` FROM archive_group_files WHERE `id`='$del_id' AND `group_name` = '$name'");
        $file = mysqli_fetch_array($file_query);

        if ($file) {
            $file_name = $file['file_name'];
            $dateObject = date_create_from_format("M-d-Y h:i A", $file['date_time']);
            $formattedDate = $dateObject->format("Y-m-d");

            $archiveFolder = "../../archived/group_files/" . $name . "/" . $formattedDate;
            $file_path = $archiveFolder . '/' . $file_name;

            echo $file_path;

            if (file_exists($file_path)) {
                // Delete the file
                mysqli_query($conn, "DELETE FROM archive_group_files WHERE `id`='$del_id' AND `group_name` = '$name'");
                echo "<script>alert('All files from archive deleted successfully!'); window.location='../show_group_archive.php?group_name=" . $name . "';</script>";
                
                if (!unlink($file_path)) {
                    echo "<script>alert('Failed to delete file: " . $file_name . "'); window.location='../show_group_archive.php?group_name=" . $name . "';</script>";
                    exit;
                }
                echo $file_path;
            } else {
                echo "<script>alert('File " . $file_name . " not found in directory!'); window.location='../show_group_archive.php?group_name=" . $name . "';</script>";
                exit;
            }
        } else {
            echo "<script>alert('File record not found or files do not belong to you!'); window.location='../show_group_archive.php?group_name=" . $name . "';</script>";
            exit;
        }
    }

} else if (isset($_POST['download'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $zip = new ZipArchive;
    $zipname = 'selected_files.zip';

    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Cannot create zip file");
    }

    if (empty($_POST['checkbox'])) {
        echo "<script>alert('Please select files to download!'); window.location='../show_group_archive.php?group_name=" . $name . "';</script>";
        exit; // Stop further execution
    }

    foreach ($_POST['checkbox'] as $del_id) {
        $del_id = mysqli_real_escape_string($conn, $del_id);

        $sql = "SELECT * FROM archive_group_files WHERE id='$del_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $file = mysqli_fetch_assoc($result);
            $date = mysqli_real_escape_string($conn, $file['date_time']);
            $dateObject = date_create_from_format("M-d-Y h:i A", $date);
            $formattedDate = $dateObject->format("Y-m-d");
            $dir = "../../archived/group_files/" . $name . "/" . $formattedDate;
            $filepath = $dir . '/' . $file['file_name'];

            // echo $filepath;

            if (file_exists($filepath)) {
                $zip->addFile($filepath, basename($filepath));
            // echo $filepath;

            } else {
                echo "File not found: " . $name . '/' . $file['file_name'] . "<br>";
            }
        } else {
            echo "Error fetching file details.";
        }
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);

    unlink($zipname);
}

?>
