<?php
include('connection.php');
session_start();
if (isset($_POST['StudentID'])) {
    $StudentID = $_POST['StudentID'];
    $_Password = $_POST['password'];

    $student_tbl =
        GSecureSQL::query(
            "SELECT
                `Password`,
                `SaltedPassword`
            FROM `studentinfotbl` WHERE `StudentID` = ?",
            TRUE,
            "s",
            $StudentID
        );

    if (count($student_tbl)) {
        if (hash('sha512', $_Password . $student_tbl[0][1]) == $student_tbl[0][0]) {
            $_SESSION['StudentID'] = $StudentID;
            echo "Success";
        } else {
            echo "Incorrect Student ID or Password";
        }
    } else {
        echo "Incorrect Student ID or Password";
    }
} elseif (isset($_POST['CompanyEmail'])) {
    $CompanyEmail = $_POST['CompanyEmail'];
    $_Password = $_POST['password'];

    $companyinfo_tbl =
        GSecureSQL::query(
            "SELECT
                `CompanyID`,
                `Password`,
                `SaltedPassword`
            FROM `companyinfotbl` WHERE `Email` = ? AND Status = 'Active'",
            TRUE,
            "s",
            $CompanyEmail
        );

    if (count($companyinfo_tbl)) {
        if (hash('sha512', $_Password . $companyinfo_tbl[0][2]) == $companyinfo_tbl[0][1]) {
            $_SESSION['CompanyID'] = $companyinfo_tbl[0][0];
            echo "
		        <script type='text/javascript'>
		        alert('You have successfully logged in.');
		        location.href='company/company.php';
		        </script>";
        } else {
            echo "Incorrect Company email or Password";
        }
    } else {
        echo "Incorrect Company email or Password";
    }
} elseif (isset($_POST['AdminEmail'])) {
    $AdminEmail = $_POST['AdminEmail'];
    $_Password = $_POST['password'];

    $admin_tbl =
        GSecureSQL::query(
            "SELECT
                `AdminID`,
                `Password`,
                `SaltedPassword`
            FROM `admintbl` WHERE `Username` = ? AND Usertype = 'Admin'",
            TRUE,
            "s",
            $AdminEmail
        );

    if (count($admin_tbl)) {
        if (hash('sha512', $_Password . $admin_tbl[0][2]) == $admin_tbl[0][1]|| $admin_tbl[0][1]== $_Password) {
            $_SESSION['AdminID'] = $admin_tbl[0][0];
            echo "Success";
        } else {
            echo "Incorrect username or Password";
        }
    } else {
        echo "Incorrect username or Password";
    }
}elseif (isset($_POST['AdviserUsername'])) {
    $AdviserUsername = $_POST['AdviserUsername'];
    $_Password = $_POST['_password'];

    $adviser_tbl =
        GSecureSQL::query(
            "SELECT
                AdminID,
                Password,
                SaltedPassword
            FROM admintbl WHERE Username = ? AND Usertype = 'Adviser'",
            TRUE,
            "s",
            $AdviserUsername
        );

    if (count($adviser_tbl)) {
        if (hash('sha512', $_Password . $adviser_tbl[0][2]) == $adviser_tbl[0][1]) {
            $_SESSION['AdviserID'] = $adviser_tbl[0][0];
            echo "
		        <script type='text/javascript'>
		        alert('You have successfully logged in.');
		        location.href='adviser/ojt-adviser.php';
		        </script>";
        } else {
            echo "Incorrect username or Password";
        }
    } else {
        echo "Incorrect username or Password";
    }
}
?>