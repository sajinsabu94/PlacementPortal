<?php
include('../connection.php');

//Delete compantlist
if (isset($_GET['delete_CompanyID'])) {
    $Z = $_GET['delete_CompanyID'];

    GSecureSQL::query(
        "DELETE FROM companyinfotbl WHERE CompanyID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: admin-companylist.php?id=deletecompany");

}
//END

//Delete event
if (isset($_GET['delete_EventID'])) {
    $Z = $_GET['delete_EventID'];

    GSecureSQL::query(
        "DELETE FROM admineventtbl WHERE EventID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: admin-calendar.php?id=deleteevent");

}
//END

//Delete News
if (isset($_GET['delete_NewsID'])) {
    $Z = $_GET['delete_NewsID'];

    GSecureSQL::query(
        "DELETE FROM adminnewstbl WHERE NewsID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: admin-news.php?id=deletenews");

}
//END


if (isset($_GET['delete_userID'])) {
    $Z = $_GET['delete_userID'];

    GSecureSQL::query(
        "DELETE FROM admintbl WHERE AdminID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: admin-users.php?id=3");

}
?>