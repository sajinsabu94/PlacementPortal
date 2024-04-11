<?php
include('connection.php');

if (isset($_POST['type'])) {
    $isAvailable = true;
    $CompanyName = $_POST['CompanyName'];
    $Result =
        GSecureSQL::query(
            "SELECT CompanyName FROM companyinfotbl WHERE CompanyName = ?",
            TRUE,
            "s",
            $CompanyName
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

if (isset($_POST['FirstName'])) {

    $CompanyName = $_POST['CompanyName'];
    $Industry = $_POST['Industry'];
    $City = $_POST['City'];
    $Email = $_POST['Email'];
    $Password = $_POST['cPassword'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $ContactNum = $_POST['Contact'];
    $Position = $_POST['Position'];
    $Department = $_POST['Department'];
    $Website = $_POST['Website'];

    $FirstName = ucwords(strtolower($FirstName));
    $MiddleName = ucwords(strtolower($MiddleName));
    $LastName = ucwords(strtolower($LastName));

    $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $Password = hash('sha512', $Password . $salt);

    GSecureSQL::query(
        "INSERT INTO companyinfotbl (CompanyName,Industry,City,Email,Password,SaltedPassword,FirstName,MiddleName,LastName,MobileNum,Position,Department,Status,Website) values (?,?,?,?,?,?,?,?,?,?,?,?,'Inactive',?)",
        FALSE,
        "sssssssssssss",
        $CompanyName,
        $Industry,
        $City,
        $Email,
        $Password,
        $salt,
        $FirstName,
        $MiddleName,
        $LastName,
        $ContactNum,
        $Position,
        $Department,
        $Website

    );

    header("location: login-company.php?id=1");
}
?>