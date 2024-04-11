<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

if (isset($_GET['delete_SchoolID'])) {
    $Z = $_GET['delete_SchoolID'];

    GSecureSQL::query(
        "DELETE FROM schooltbl WHERE SchoolID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: education.php?id=3");

}

if (isset($_GET['delete_CertificationID'])) {
    $Z = $_GET['delete_CertificationID'];

    GSecureSQL::query(
        "DELETE FROM certificationtbl WHERE CertificationID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: certifications.php?id=3");

}

if (isset($_GET['delete_AchievementID'])) {
    $Z = $_GET['delete_AchievementID'];

    GSecureSQL::query(
        "DELETE FROM achievementstbl WHERE AchievementID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: achievements.php?id=3");

}

if (isset($_GET['delete_ReferenceID'])) {
    $Z = $_GET['delete_ReferenceID'];

    GSecureSQL::query(
        "DELETE FROM referencetbl WHERE ReferenceID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: references.php?id=3");

}

if (isset($_GET['delete_SID'])) {
    $id = $_GET['delete_SID'];

    GSecureSQL::query(
        "DELETE FROM specializationtbl WHERE SID = ?",
        FALSE,
        "s",
        $id
    );
    header("location: skills-and-languages.php?id=3");

}

if (isset($_GET['delete_LangID'])) {
    $id = $_GET['delete_LangID'];

    GSecureSQL::query(
        "DELETE FROM languagetbl WHERE LangID = ?",
        FALSE,
        "s",
        $id
    );
    header("location: skills-and-languages.php?id=6");

}
if (isset($_GET['Delete_DocID'])){
    $id = $_GET['Delete_DocID'];
    $id = encrypt_decrypt("decrypt", $id);

    $filename =
        GSecureSQL::query(
        "SELECT EncryptedFile FROM filestbl WHERE id = ?",
            TRUE,
            "s",
            $id
    );
    $Filename = $filename[0][0];

    GSecureSQL::query(
        "DELETE FROM filestbl WHERE id = ?",
        FALSE,
        "s",
        $id
    );

    unlink($Filename);
    header("location: portfolio.php?saved");
}

//Delete Work
if (isset($_GET['Delete_WorkID'])) {
    $DeleteID = $_GET['Delete_WorkID'];

    $DeleteID = encrypt_decrypt('decrypt',$DeleteID);

    GSecureSQL::query(
        "DELETE FROM workexperiencetbl WHERE WorkID=?",
        FALSE,
        "s",
        $DeleteID
    );

    header("location: work.php?saved");

}
//end

if(isset($_GET['delete_URLID'])){
    $DeleteID = $_GET['delete_URLID'];

    $DeleteID = encrypt_decrypt('decrypt', $DeleteID);

    GSecureSQL::query(
        "DELETE FROM urltbl WHERE id = ? AND StudentID = ?",
        FALSE,
        "ss",
        $DeleteID,
        $StudentID
    );

    header("location: portfolio.php?saved");
}