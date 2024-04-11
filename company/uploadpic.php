<?php
include('../connection.php');
session_start();
$CompanyID = $_SESSION['CompanyID'];

$fileToUpload = basename($_FILES["ProfilePicture"]["name"]);
$target_dir = "ProfileImage/";
$target_file = $target_dir . $CompanyID . ".jpg";
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
            "UPDATE companyinfotbl SET ProfileImage = ? WHERE CompanyID = ?",
            FALSE,
            "ss",
            $target_file,
            $CompanyID
        );
        header("location: company-settings.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}