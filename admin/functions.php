<?php
include('../connection.php');
session_start();
$AdminID = $_SESSION['AdminID'];

if (isset($_GET['coursetitle'])) {
    $CourseTitle = $_GET['coursetitle'];
    $CourseCode = $_GET['coursecode'];
    $CourseDesc = $_GET['coursedesc'];


    GSecureSQL::query(
        "INSERT INTO coursetbl (CourseTitle,CourseCode,CourseDescription) values (?,?,?)",
        FALSE,
        "sss",
        $CourseTitle,
        $CourseCode,
        $CourseDesc
    );

    header("location: admin-maintenance.php?id=1");

}

if (isset($_POST['CourseID'])) {
    $CourseID = $_POST['CourseID'];
    $CourseTitle = $_POST['coursetitle'];
    $CourseCode = $_POST['coursecode'];
    $CourseDesc = $_POST['coursedesc'];


    GSecureSQL::query(
        "UPDATE coursetbl SET CourseTitle = ?, CourseCode = ?, CourseDescription = ? WHERE CourseID = ?",
        FALSE,
        "ssss",
        $CourseTitle,
        $CourseCode,
        $CourseDesc,
        $CourseID
    );

    header("location: admin-maintenance.php?id=2");

}

if (isset($_POST['ModalNewUsername'])) {
    $Username = $_POST['ModalNewUsername'];

    GSecureSQL::query(
        "UPDATE admintbl SET Username = ? WHERE AdminID = ?",
        FALSE,
        "ss",
        $Username,
        $AdminID
    );

    header("location: admin-account.php?saved");

}

if (isset($_POST['ModalNewPassword'])) {
    $OldPassword = $_POST['ModalOldPassword'];
    $NewPassword = $_POST['ModalNewPassword'];

    $admin_tbl =
        GSecureSQL::query(
            "SELECT
                `Password`,
                `SaltedPassword`
            FROM `admintbl` WHERE `AdminID` = ?",
            TRUE,
            "s",
            $AdminID
        );

    if (count($admin_tbl)) {
        if (hash('sha512', $OldPassword . $admin_tbl[0][1]) == $admin_tbl[0][0]) {

            $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
            $NewPassword = hash('sha512', $NewPassword . $salt);

            GSecureSQL::query(
                "UPDATE admintbl SET Password = ? , SaltedPassword = ? WHERE AdminID = ?",
                FALSE,
                "sss",
                $NewPassword,
                $salt,
                $AdminID
            );

            header("location: admin-account.php?saved");

        } else {
            header("location: admin-account.php?error1");
        }
    } else {
        header("location: admin-account.php?error1");
    }
}

if (isset($_POST['FirstName'])) {
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $Position = $_POST['Position'];
    $Address = $_POST['Address'];
    $ContactNumber = $_POST['ContactNumber'];


    GSecureSQL::query(
        "UPDATE admintbl SET FirstName = ?, MiddleName = ?, LastName = ?, Position = ?, Address = ?, ContactNumber = ? WHERE AdminID = ?",
        FALSE,
        "sssssss",
        $FirstName,
        $MiddleName,
        $LastName,
        $Position,
        $Address,
        $ContactNumber,
        $AdminID

    );

    header("location: admin-account.php?saved");

}

if (isset($_GET['DeleteID'])) {
    $DeleteID = $_GET['DeleteID'];

    GSecureSQL::query(
        "DELETE FROM coursetbl WHERE CourseID = ?",
        FALSE,
        "s",
        $DeleteID
    );

    header("location: admin-maintenance.php?id=3");

}
// accept company
if (isset($_GET['id']) && isset($_GET['cid'])) {
    $id = $_GET['id'];
    $cid = $_GET['cid'];

    if ($id == 1) {
        GSecureSQL::query(
            "UPDATE companyinfotbl SET Status = 'Active' WHERE CompanyID = ?",
            FALSE,
            "i",
            $cid
        );
        echo "
            <script type='text/javascript'>
            location.href='admin-company_pending.php?id=1';
            </script>";
    } elseif ($id == 2) {
        GSecureSQL::query(
            "DELETE FROM companyinfotbl WHERE CompanyID = ?",
            FALSE,
            "i",
            $cid
        );

        header("location: admin-company_pending.php?id=2");

    }
}
//end

if (isset($_POST['lid'])) {
    $LID = $_POST['lid'];
    $DateFrom = date("Y-m-d");
    $DateTo = $_POST['DateTo'];


    GSecureSQL::query(
        "UPDATE logrequesttbl SET DateFrom = ?, DateTo = ?, Status = 'Accepted' WHERE LID = ?",
        FALSE,
        "sss",
        $DateFrom,
        $DateTo,
        $LID
        
    );
    header("location: admin-requested.php?id=1");

}

// Add User
if (isset($_POST['type'])) {
    $isAvailable = true;
    $aUsername = $_POST['aUsername'];
    $Result =
        GSecureSQL::query(
            "SELECT Username FROM admintbl WHERE Username = ?",
            TRUE,
            "s",
            $aUsername
        );

    if (count($Result) == 0) {
        $isAvailable = true;
    } else {
        $isAvailable = false;
    }
    echo json_encode(array(
        'valid' => $isAvailable,
    ));
}

// admin add user
if (isset($_POST['aFirstName'])) {
    $aUsername = $_POST['aUsername'];
    $aFirstName = $_POST['aFirstName'];
    $aMiddleName = $_POST['aMiddleName'];
    $aLastName = $_POST['aLastName'];
    $aPosition = $_POST['aPosition'];
    $aAddress = $_POST['aAddress'];
    $aContactNumber = $_POST['aContactNumber'];
    $Usertype = "Adviser";

    $aPassword = "user";
    $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $aPassword = hash('sha512', $aPassword . $salt);

    GSecureSQL::query(
        "INSERT INTO admintbl (Username,Password,SaltedPassword,FirstName,MiddleName,LastName,Position,Address,ContactNumber,Usertype) values (?,?,?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssssss",
        $aUsername,
        $aPassword,
        $salt,
        $aFirstName,
        $aMiddleName,
        $aLastName,
        $aPosition,
        $aAddress,
        $aContactNumber,
        $Usertype

    );

    header("location: admin-users.php?id=1");

}
// End of Add User

//Create Calendar-Event
if (isset($_POST['BtnCalendarsave'])) {

    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $eventtitle = $_POST['eventtitle'];
    $location = $_POST['location'];
    $descrip = $_POST['descrip'];

    $FileName = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));

    if(isset($_FILES["ProfilePicture"])){
        if($_FILES["ProfilePicture"]["error"] === 0){
            $ext = explode('.', $_FILES["ProfilePicture"]["name"]);
            $ext = $ext[count($ext) - 1];
            $fileToUpload = basename($_FILES["ProfilePicture"]["name"]);

            $target_dir = "ProfileImage/";
            $target_file = $target_dir . $FileName . '.' . $ext;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "bmp" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG, BMP, or GIF files are allowed. ";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";

            } else {
                if (move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], $target_file)) {
                GSecureSQL::query(
                        "INSERT INTO admineventtbl (AdminID,EventTitle,EventDatef,EventDatet,Location,Description,ProfileImage) values (?,?,?,?,?,?,?)",
                        FALSE,
                        "sssssss",
                        $AdminID,
                        $eventtitle,
                        $datefrom,
                        $dateto,
                        $location,
                        $descrip,
                        $target_file
                    );
                header("location: admin-calendar.php?id=EventAdd");
                   
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    print_r($_FILES["ProfilePicture"]);die();

}
// End of Create Calendar-Event

//Update Event
if (isset($_POST['EventID'])) {
    $EventID = $_POST['EventID'];
    $eEventTitle = $_POST['eEventTitle'];
    $eLocation = $_POST['eLocation'];
    $eDescription = $_POST['eDescription'];

    GSecureSQL::query(
        "UPDATE admineventtbl SET EventTitle = ?, Location = ?, Description = ? WHERE EventID = ?",
        FALSE,
        "ssss",
        $eEventTitle,
        $eLocation,
        $eDescription,
        $EventID

    );

    header("location: admin-calendar.php?id=updateevent");

}
//End

//Create News
if (isset($_POST['BtnNewssave'])) {

    $newsdate = $_POST['newsdate'];
    $newstitle = $_POST['newstitle'];
    $newslocation = $_POST['newslocation'];
    $newscaption = $_POST['newscaption'];

    $FileName = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));

    if(isset($_FILES["ProfilePictures"])){
        if($_FILES["ProfilePictures"]["error"] === 0){
            $ext = explode('.', $_FILES["ProfilePictures"]["name"]);
            $ext = $ext[count($ext) - 1];
            $fileToUpload = basename($_FILES["ProfilePictures"]["name"]);

            $target_dir = "ProfileImages/";
            $target_file = $target_dir . $FileName . '.' . $ext;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "bmp" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG, BMP, or GIF files are allowed. ";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";

            } else {
                if (move_uploaded_file($_FILES["ProfilePictures"]["tmp_name"], $target_file)) {
                GSecureSQL::query(
                        "INSERT INTO adminnewstbl (AdminID,NewsDate,NewsTitle,NewsLocation,NewsCaption,ProfileImages) values (?,?,?,?,?,?)",
                        FALSE,
                        "ssssss",
                        $AdminID,
                        $newsdate,
                        $newstitle,
                        $newslocation,
                        $newscaption,
                        $target_file
                    );
                header("location: admin-news.php?id=addnews");
                   
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

}
// End of Create News

//Update News
if (isset($_POST['NewsID'])) {
    $NewsID = $_POST['NewsID'];
    $NewsTitle = $_POST['NewsTitle'];
    $NewsLocation = $_POST['NewsLocation'];
    $NewsCaption = $_POST['NewsCaption'];

    GSecureSQL::query(
        "UPDATE adminnewstbl SET NewsTitle = ?, NewsLocation = ?, NewsCaption = ? WHERE NewsID = ?",
        FALSE,
        "ssss",
        $NewsTitle,
        $NewsLocation,
        $NewsCaption,
        $NewsID

    );

    header("location: admin-news.php?id=updatenews");

}
//End

//Create Contact
if (isset($_POST['BtnContactsave'])) {

    $telnumber = $_POST['telnumber'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    
        GSecureSQL::query(
        "UPDATE contacttbl SET telnumber = ?, address = ?, phonenumber = ?, email = ?, website = ? WHERE ContactID = '1'",
        FALSE,
        "sssss",
        $telnumber,
        $address,
        $phonenumber,
        $email,
        $website
    );
    header("location: admin-contact.php");
            

}
// End 

//OJT report update
if (isset($_POST['StudentID'])) {
    $StudentID = $_POST['StudentID'];
    $CompanyName = $_POST['Company'];
    $CompanyAddress = $_POST['CompanyAddress'];
    $Position = $_POST['Position'];
    $Supervisor = $_POST['Supervisor'];
    $Remarks = $_POST['Remarks'];
    $Hours = $_POST['Hours'];

    if(isset($_POST['Endorsement'])){
        $Endorsement = $_POST['Endorsement'];
    }else{
        $Endorsement = $_POST['EndorsementHidden'];
    }

    if(isset($_POST['DTR'])){
        $DTR = $_POST['DTR'];
    }else{
        $DTR = $_POST['DTRHidden'];
    }

    if(isset($_POST['Waiver'])){
        $Waiver = $_POST['Waiver'];
    }else{
        $Waiver = $_POST['WaiverHidden'];
    }

    if(isset($_POST['TrainingPlan'])){
        $TrainingPlan = $_POST['TrainingPlan'];
    }else{
        $TrainingPlan = $_POST['TrainingPlanHidden'];
    }

    if(isset($_POST['MOA'])){
        $MOA = $_POST['MOA'];
    }else{
        $MOA = $_POST['MOAHidden'];
    }

    if(isset($_POST['Journal'])){
        $Journal = $_POST['Journal'];
    }else{
        $Journal = $_POST['JournalHidden'];
    }

    if(isset($_POST['Integration'])){
        $Integration = $_POST['Integration'];
    }else{
        $Integration = $_POST['IntegrationHidden'];
    }

    if(isset($_POST['PAF'])){
        $PAF = $_POST['PAF'];
    }else{
        $PAF = $_POST['PAFHidden'];
    }

    if(isset($_POST['Certification'])){
        $Certification = $_POST['Certification'];
    }else{
        $Certification = $_POST['CertificationHidden'];
    }

    GSecureSQL::query(
        "UPDATE ojttbl SET
        CompanyName = ?,
        CompanyAddress = ?,
        Supervisor = ?,
        Position = ?,
        Remarks = ?,
        Hours = ?,
        Endorsement = ?,
        DTR = ?,
        Waiver = ?,
        TrainingPlan = ?,
        MOA = ?,
        Journal = ?,
        Integration = ?,
        PAF = ?,
        Certificate = ?
        WHERE StudentID = ?",
        FALSE,
        "ssssssssssssssss",
        $CompanyName,
        $CompanyAddress,
        $Supervisor,
        $Position,
        $Remarks,
        $Hours,
        $Endorsement,
        $DTR,
        $Waiver,
        $TrainingPlan,
        $MOA,
        $Journal,
        $Integration,
        $PAF,
        $Certification,
        $StudentID
    );

    if(isset($_REQUEST["destination"])){
        header("Location: {$_REQUEST["destination"]}");
    }else if(isset($_SERVER["HTTP_REFERER"])){
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    }

    header("location: admin-ojtreports.php?id=1");

}
// end

// admin update user
if (isset($_POST['eFirstName'])) {
    $aUsername = $_POST['eUsername'];
    $aFirstName = $_POST['eFirstName'];
    $aMiddleName = $_POST['eMiddleName'];
    $aLastName = $_POST['eLastName'];
    $aPosition = $_POST['ePosition'];
    $aAddress = $_POST['eAddress'];
    $aContactNumber = $_POST['eContactNumber'];


    GSecureSQL::query(
        "UPDATE admintbl
        SET Username = ?,
        FirstName = ?,
        MiddleName = ?,
        LastName = ?,
        Position = ?,
        Address = ?,
        ContactNumber = ?",
        FALSE,
        "sssssss",
        $aUsername,
        $aFirstName,
        $aMiddleName,
        $aLastName,
        $aPosition,
        $aAddress,
        $aContactNumber

    );

    header("location: admin-users.php?id=2");

}
if(isset($_GET['deletePID'])){
    $DeleteID = $_GET['deletePID'];

    GSecureSQL::query(
        "DELETE FROM jobfairtbl WHERE id = ?",
        FALSE,
        "s",
        $DeleteID
    );

    header("location: job-fair.php?deleted");
}

