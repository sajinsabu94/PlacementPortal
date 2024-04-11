<?php
include('../../../connection.php');
session_start();
include('../../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$fileToUpload = basename($_FILES["DocumentFile"]["name"]);
$target_dir = "Documents/";
$target_file = $target_dir . $fileToUpload;
$uploadOk = 1;


$salt = hash('sha512', mt_rand(0, PHP_INT_MAX));
$target_file = hash('sha512', $target_file . $salt);

echo $fileToUpload;
echo $target_file;
die();

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

} else {
    if (move_uploaded_file($_FILES["DocumentFile"]["tmp_name"], $target_file)) {

        GSecureSQL::query(
            "INSERT INTO documentstbl (StudentID, DocumentName, DocumentPath) VALUES (?,?,?)",
            FALSE,
            "sss",
            $StudentID,
            $fileToUpload,
            $target_file
        );
        header("location: portfolio.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}