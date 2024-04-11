<?php
include('../../connection.php');
session_start();
include('../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

if (isset($_POST['id'])) {
    $PositionID = $_POST['id'];
    $CompanyID = $_POST['cid'];
    $DateSubmitted = date("Y-m-d");
    GSecureSQL::query(
        "INSERT INTO requesttocompanytbl (CompanyID, StudentID, PositionID, Status, DateSubmitted) values (?,?,?,'Pending',?)",
        FALSE,
        "ssss",
        $CompanyID,
        $StudentID,
        $PositionID,
        $DateSubmitted
    );

    if(isset($_REQUEST["destination"])){
        header("Location: {$_REQUEST["destination"]}");
    }else if(isset($_SERVER["HTTP_REFERER"])){
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    }
}

if(isset($_POST['delete_request'])){
    $RID = $_POST['RID'];

    GSecureSQL::query(
        "DELETE FROM requesttocompanytbl WHERE RID = ?",
        FALSE,
        "s",
        $RID
    );

    header('location: ../applications/applications.php?id=1');
}
?>