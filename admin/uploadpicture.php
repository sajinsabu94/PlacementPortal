<?php
include('../connection.php');
session_start();
$AdminID = $_SESSION['AdminID'];

$salt = hash('md4', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
$FileName = hash('sha512', $AdminID . $salt);

$fileToUpload = basename($_FILES["ProfilePicture"]["name"]);
$target_dir = "ProfileImage/";
$target_file = $target_dir . $FileName . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

} else {
    if (move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], $target_file)) {

        GSecureSQL::query(
            "UPDATE admineventtbl SET ProfileImage = ?, Salt = ? WHERE AdminID = ?",
            FALSE,
            "sss",
            $target_file,
            $AdminID,
            $Salt
        );
        header("location: admin-calendarcreateevent.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}