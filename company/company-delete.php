<?php
include('../connection.php');

//Delete Position
if (isset($_GET['delete_PositionID'])) {
    $Z = $_GET['delete_PositionID'];

    GSecureSQL::query(
        "DELETE FROM comppositiontbl WHERE PositionID=?",
        FALSE,
        "s",
        $Z
    );
    header("location: company-positionlist.php?id=3");

}
//END
?>