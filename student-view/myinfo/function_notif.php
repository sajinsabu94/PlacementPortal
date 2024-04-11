<?php
include('../../connection.php');
session_start();
include('../../common-functions.php');
$common_functions->student_login_check();

$StudentID = $_SESSION['StudentID'];

GSecureSQL::query(
    "UPDATE studnotificationtbl SET Seen = 1 WHERE StudentID = ? AND Seen = 0",
    FALSE,
    "s",
    $StudentID
);