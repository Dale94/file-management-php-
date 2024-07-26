<?php

require_once("../include/connection.php");

if (isset($_POST['download'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $zip = new ZipArchive;
    $zipname = 'selected_files.zip';

    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Cannot create zip file");
    }

    if (empty($_POST['checkbox'])) {
        echo "<script>alert('Please select files to download!'); window.location='../show_group_files.php?group_name=" . $name . "';</script>";
        exit; // Stop further execution
    }

    foreach ($_POST['checkbox'] as $del_id) {
        $del_id = mysqli_real_escape_string($conn, $del_id);

        $sql = "SELECT * FROM group_files WHERE id='$del_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $file = mysqli_fetch_assoc($result);
            $dir = "../../uploads/group_files/" . $name;
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
