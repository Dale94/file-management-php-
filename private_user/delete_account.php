<?php
session_start();
require_once("include/connection.php");

// Check if the user is logged in
if (!isset($_SESSION['email_address'])) {
    header("Location: home.php"); // Redirect to home.php if not logged in
    exit();
}

// Check if the form is submitted
if (isset($_POST['confirm_delete'])) {
    $id = $_SESSION['email_address'];
    $query = mysqli_query($conn, "SELECT * FROM login_user WHERE email_address = '$id'") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($query);

    $fname1 = $row['name'];

    $user_pass_delete = $_POST['user_password_delete'];

    // Verify if the current password matches
    if (password_verify($user_pass_delete, $pass1)) {
        // Define the path to the user's folder
        $user_folder_path = "../uploads/" . $fname1;

        // Check if the user's folder exists
        if (file_exists($user_folder_path) && is_dir($user_folder_path)) {
            // Define archive directory
            $archive_directory = "../archived/deleted_accounts";

            // Create archive directory if it doesn't exist
            if (!file_exists($archive_directory)) {
                mkdir($archive_directory, 0777, true);
            }

            // Define new folder name with datetime prefix
            $new_folder_name = date('Y-m-d_H-i-s') . "_" . $fname1;

            // New path for the archived folder
            $new_folder_path = $archive_directory . "/" . $new_folder_name;

            // Move the folder to the archive directory with the new name
            if (rename($user_folder_path, $new_folder_path)) {
                // If folder move is successful, insert archive folder info into the database
                mysqli_query($conn, "INSERT INTO archive_folder (folder_name, owner) VALUES ('$new_folder_name', '$fname1')");

                // Delete the user account from the database
                mysqli_query($conn, "DELETE FROM login_user WHERE name='$fname1'");

                // Delete related files from the database
                mysqli_query($conn, "DELETE FROM upload_files WHERE `EMAIL`='$fname1'");

                echo "<script>alert('User folder archived successfully!');</script>";
                echo "<script>window.location='../index.html';</script>";
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
