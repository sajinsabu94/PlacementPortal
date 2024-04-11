<?php
include('../connection.php');
session_start();

if (isset($_SESSION['AdviserID'])) {
    $AdviserID = $_SESSION['AdviserID'];
} else {
    header("location: ../login-adviser.php");
}

if (isset($_POST['StudentID'])) {
    $StudentID = $_POST['StudentID'];
    $CompanyName = $_POST['Company'];
    $CompanyAddress = $_POST['CompanyAddress'];
    $Position = $_POST['Position'];
    $Supervisor = $_POST['Supervisor'];
    $Remarks = $_POST['Remarks'];
    $Hours = $_POST['Hours'];
    $Search = $_POST['Search'];
    $SearchBy = $_POST['SearchBy'];


    if (isset($_POST['Endorsement'])) {
        $Endorsement = $_POST['Endorsement'];
    } else {
        $Endorsement = $_POST['EndorsementHidden'];
    }

    if (isset($_POST['DTR'])) {
        $DTR = $_POST['DTR'];
    } else {
        $DTR = $_POST['DTRHidden'];
    }

    if (isset($_POST['Waiver'])) {
        $Waiver = $_POST['Waiver'];
    } else {
        $Waiver = $_POST['WaiverHidden'];
    }

    if (isset($_POST['TrainingPlan'])) {
        $TrainingPlan = $_POST['TrainingPlan'];
    } else {
        $TrainingPlan = $_POST['TrainingPlanHidden'];
    }

    if (isset($_POST['MOA'])) {
        $MOA = $_POST['MOA'];
    } else {
        $MOA = $_POST['MOAHidden'];
    }

    if (isset($_POST['Journal'])) {
        $Journal = $_POST['Journal'];
    } else {
        $Journal = $_POST['JournalHidden'];
    }

    if (isset($_POST['Integration'])) {
        $Integration = $_POST['Integration'];
    } else {
        $Integration = $_POST['IntegrationHidden'];
    }

    if (isset($_POST['PAF'])) {
        $PAF = $_POST['PAF'];
    } else {
        $PAF = $_POST['PAFHidden'];
    }

    if (isset($_POST['Certification'])) {
        $Certification = $_POST['Certification'];
    } else {
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

    header("location: ojt-adviser.php?id=1");
}

//Update ng info ng User ni Company
if (isset($_GET['btnsaveuser'])) {
    $FirstName = $_GET['FirstName'];
    $MiddleName = $_GET['MiddleName'];
    $LastName = $_GET['LastName'];
    $Position = $_GET['Position'];
    $Address = $_GET['Address'];
    $ContactNumber = $_GET['ContactNumber'];

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
        $AdviserID
    );
    header("location: ojt-account.php?id=3");
}


//Change Company Username
if (isset($_POST['ModalNewUsername'])) {
    $Username = $_POST['ModalNewUsername'];

    GSecureSQL::query(
        "UPDATE admintbl SET Username = ? WHERE AdminID = ?",
        FALSE,
        "ss",
        $Username,
        $AdviserID
    );

    header("location: ojt-account.php?id=1");

}

//Change Company Password
if (isset($_POST['ModalNewPassword'])) {
    $OldPassword = $_POST['ModalOldPassword'];
    $NewPassword = $_POST['ModalNewPassword'];

    $company_tbl =
        GSecureSQL::query(
            "SELECT
                Password,
                SaltedPassword
            FROM admintbl WHERE AdminID  = ?",
            TRUE,
            "s",
            $AdviserID
        );

    if (count($company_tbl)) {
        if (hash('sha512', $OldPassword . $company_tbl[0][1]) == $company_tbl[0][0]) {

            $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
            $NewPassword = hash('sha512', $NewPassword . $salt);

            GSecureSQL::query(
                "UPDATE admintbl SET Password = ? , SaltedPassword = ? WHERE AdminID = ?",
                FALSE,
                "sss",
                $NewPassword,
                $salt,
                $AdviserID
            );

            header("location: ojt-account.php?id=2");

        } else {
            echo "Wrong password";
        }
    } else {
        echo "Wrong password";
    }
}