<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx
if (isset($_POST['btnSaveInfo'])) {
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $Gender = $_POST['Gender'];
    $Birthdate = $_POST['Birthdate'];
    $Nationality = $_POST['Nationality'];
    $CivilStatus = $_POST['CivilStatus'];
    $FBLink = $_POST['FBLink'];

    $FBLink = "http://www.facebook.com/" . $FBLink;


    $validation_config = array(
        'FirstName' => array(
            'pattern' => '/^([a-zA-Z]+[ ]*)+$/',
            'errorMsg' => 'Invalid First name'
        ),
        'LastName' => array(
            'pattern' => '/^([a-zA-Z]+[ ]*)+$/',
            'errorMsg' => 'Invalid Last name'
        ),
        'Gender' => array(
            'pattern' => '/^(Male|Female)$/',
            'errorMsg' => 'Invalid Gender'
        ),
        'Nationality' => array(
            'pattern' => $common_functions->get_regex_of_nationalities(),
            'errorMsg' => 'Invalid Nationality'
        ),
        'CivilStatus' => array(
            'pattern' => '/^(Single|Married|Separated|Widowed)$/',
            'errorMsg' => 'Invalid Civil Status'
        )
    );


    $validation_return = $common_functions->validate($_POST, $validation_config);
    if($validation_return['hasError']){
        header("location: personal-info.php?error");
        die();
    }

    if(!$common_functions->date_validator($_POST['Birthdate'])){
        header("location: personal-info.php?error");
        die();
    }

    GSecureSQL::query(
        "UPDATE studentinfotbl SET FirstName = ?, MiddleName = ?, LastName = ?, Gender = ?, Birthdate = ?, Nationality = ?, CivilStatus = ?, FBLink = ? WHERE StudentID = ?",
        FALSE,
        "sssssssss",
        $FirstName,
        $MiddleName,
        $LastName,
        $Gender,
        $Birthdate,
        $Nationality,
        $CivilStatus,
        $FBLink,
        $StudentID
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Pinfo = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    $Picturetbl =
        GSecureSQL::query(
            "SELECT ProfileImage FROM studentinfotbl WHERE StudentID = ?",
            TRUE,
            "s",
            $StudentID
        );
    $Picture = $Picturetbl[0][0];

    //start upload
    $fileToUpload = basename($_FILES["ProfilePicture"]["name"]);
    if($fileToUpload != ""){
        $Time = date('H:i:s');
        $target_dir = "ProfileImages/";
        $ext = pathinfo($_FILES["ProfilePicture"]["name"]);
        $ext = $ext['extension'];
        $fileToUploadenc = encrypt_decrypt_plusTime("encrypt", $fileToUpload,$Time);
        $target_file = $target_dir . $fileToUploadenc . "." . $ext;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            header("location: personal-info.php?error");
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            header("location: personal-info.php?error");

        } else {
            if (move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], $target_file)) {

                $ProfileImage =
                    GSecureSQL::query(
                        "SELECT ProfileImage FROM studentinfotbl WHERE StudentID = ?",
                        TRUE,
                        "s",
                        $StudentID
                    );
                $picturepath = $ProfileImage[0][0];

                if($picturepath != ""){
                    unlink($Picture);
                }

                GSecureSQL::query(
                    "UPDATE studentinfotbl SET ProfileImage = ? WHERE StudentID = ?",
                    FALSE,
                    "ss",
                    $target_file,
                    $StudentID
                );


                header("location: personal-info.php?saved");

            } else {
                header("location: personal-info.php?error");
            }
        }
    }else{
        header("location: personal-info.php?saved");
    }

    // end upload
}

if (isset($_GET['btnSaveContactInfo'])) {
    $Email = $_GET['Email'];
    $MobileNumber = $_GET['MobileNumber'];
    $HomeNumber = $_GET['HomeNumber'];
    $WorkNumber = $_GET['WorkNumber'];
    $Address = $_GET['Address'];
    $City = $_GET['City'];
    $PostalCode = $_GET['PostalCode'];


    $validation_config = array(
        'Email' => array(
            'pattern' => '/^[a-z0-9\.-_]+@[a-z0-9\.-_]+(\.com|\.org|\.net|\.int|\.edu|\.gov|\.mil|\.[a-z]{2})$/i',
            'errorMsg' => 'Invalid Email'
        ),
        'MobileNumber' => array(
            'pattern' => '/^[789]\d{9}$/',
            'errorMsg' => 'Invalid Mobile Number'
        ),
        'Address' => array(
            'pattern' => '/^.+$/',
            'errorMsg' => 'Address cannot be empty'
        ),

    );

    $validation_return = $common_functions->validate($_GET, $validation_config);
    if($validation_return['hasError']){
        die();
        header("location: contacts-info.php?error");
    }

    GSecureSQL::query(
        "UPDATE studcontactstbl SET Email = ?, MobileNumber = ?, HomeNumber = ?, WorkNumber = ?, Address = ?, City = ?, PostalCode = ? WHERE StudentID = ?",
        FALSE,
        "ssssssss",
        $Email,
        $MobileNumber,
        $HomeNumber,
        $WorkNumber,
        $Address,
        $City,
        $PostalCode,
        $StudentID

    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Cinfo = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: contacts-info.php?saved");

}


if(isset($_POST['Objective'])){
    $Objective = $_POST['Objective'];

    GSecureSQL::query(
        "UPDATE studentinfotbl SET Objectives = ? WHERE StudentID = ?",
        FALSE,
        "ss",
        $Objective,
        $StudentID
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Objective = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: work.php");
}