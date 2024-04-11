<?php
include('../connection.php');
include('../common-functions.php');

if(isset($_POST['FormSubmit'])){
    $CompanyName = ucwords($_POST['CompanyName']);
    $CompanyAddress = $_POST['CompanyAddress'];
    $City = $_POST['City'];
    $Website = $_POST['Website'];
    $ContactPerson = ucwords($_POST['ContactPerson']);
    $Designation = ucwords($_POST['Designation']);
    $Email = $_POST['Email'];
    $Phone1 = $_POST['Phone1'];
    $Phone2 = $_POST['Phone2'];
    $Phone3 = $_POST['Phone3'];
    $Phone3 = $_POST['Phone3'];
    $MobileNumber = $_POST['MobileNumber'];
    $FaxNumber = $_POST['FaxNumber'];
    $Industry = $_POST['Industry'];
    $Representative1 = ucwords($_POST['Representative1']);
    $Representative2 = ucwords($_POST['Representative2']);
    $MarketingMaterials = $_POST['MarketingMaterials'];

    $Others = "";
    $Extras = "";
    $OthersExtra = "";
    $RoomForExam = "";
    $DoorPrizes = "";

    $a = strlen($CompanyName) > 0;
    $a = $a && (strlen($CompanyAddress) > 0);
    $a = $a && (strlen($City) > 0);
    $a = $a && (strlen($Website) > 0);
    $a = $a && (strlen($ContactPerson) > 0);
    $a = $a && (strlen($Designation) > 0);
    $a = $a && (strlen($Email) > 0);
    $a = $a && (strlen($Phone1) > 0);
    $a = $a && (strlen($Industry) > 0);
    $a = $a && (strlen($Representative1) > 0);

    if($a === FALSE){
        header('Location: job-fair.php?error');
        die();
    }

    $validation_config = array(
        'ContactPerson' => array(
            'pattern' => '/^[a-z\s]+$/i',
            'errorMsg' => ''
        ),
        'Phone1' => array(
            'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
            'errorMsg' => ''
        ),
        'Phone2' => array(
            'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
            'errorMsg' => ''
        ),
        'Phone3' => array(
            'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
            'errorMsg' => ''
        ),
        'MobileNumber' => array(
            'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
            'errorMsg' => ''
        ),
        'FaxNumber' => array(
            'pattern' => '/^(([0-9]+[.]*)+$|^$)/i',
            'errorMsg' => ''
        ),
        'Representative1' => array(
            'pattern' => '/^[a-z\s]+$/i',
            'errorMsg' => ''
        ),
        'Representative2' => array(
            'pattern' => '/(^[a-z\s]+$|^$)/i',
            'errorMsg' => ''
        )
    );


    if(isset($_POST['OthersCB'])){
        $Others = ucwords($_POST['Others']);
    }

    if(isset($_POST['Extras'])){
        $Extras = $_POST['Extras'];
        $Extras = implode("- ", $Extras);
    }

    if(isset($_POST['OthersExtraCB'])){
        $OthersExtra = ucwords($_POST['OthersExtra']);
    }

    if(isset($_POST['RoomForExam'])){
        $RoomForExam = $_POST['RoomForExam'];
    }

    if(isset($_POST['DoorPrizes'])){
        $DoorPrizes = $_POST['DoorPrizes'];
    }

    $ItemDescription = ucwords($_POST['ItemDescription']);

    $Participate = $_POST['Participate'];
    $Requirements = $_POST['Requirements'];

    $MarketingMaterials = implode("- ", $MarketingMaterials);
    $Requirements = implode("- ", $Requirements);
    $Requirements = htmlentities($Requirements);


    $validation_return = $common_functions->validate($_POST, $validation_config);
    if($validation_return['hasError']){
        header("location: job-fair.php?error");
        die();
    }

    GSecureSQL::query(
        "INSERT INTO jobfairtbl
        (CompanyName,
        CompanyAddress,
        City,
        Website,
        ContactPerson,
        Designation,
        Email,
        Phone1,
        Phone2,
        Phone3,
        MobileNumber,
        FaxNumber,
        Industry,
        Representative1,
        Representative2,
        MarketingMaterials,
        Others,
        Extras,
        OthersExtra,
        RoomForExam,
        DoorPrizes,
        ItemDescription,
        Participate,
        Requirements)
        VALUES
        (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssssssssssssssssssss",
        $CompanyName,
        $CompanyAddress,
        $City,
        $Website,
        $ContactPerson,
        $Designation,
        $Email,
        $Phone1,
        $Phone2,
        $Phone3,
        $MobileNumber,
        $FaxNumber,
        $Industry,
        $Representative1,
        $Representative2,
        $MarketingMaterials,
        $Others,
        $Extras,
        $OthersExtra,
        $RoomForExam,
        $DoorPrizes,
        $ItemDescription,
        $Participate,
        $Requirements

    );

    header('location: job-fair.php?done');
}