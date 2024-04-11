<?php
include('connection.php');
include('common-functions.php');

if (isset($_POST['type'])) {
    $isAvailable = true;
    $StudentID = $_POST['StudentID'];
    $Result =
        GSecureSQL::query(
            "SELECT StudentID FROM studentinfotbl WHERE StudentID = ?",
            TRUE,
            "s",
            $StudentID
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
    $StudentID = $_POST['StudentID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Birthday = $_POST['Birthday'];
    $MobileNumber = $_POST['MobileNumber'];
    $Email = $_POST['Email'];
    $Password = $_POST['_Password'];
    $City = $_POST['City'];
    $Course = $_POST['Course'];
    $GraduatedMonth = $_POST['GraduatedMonth'];
    $GraduatedYear = $_POST['GraduatedYear'];

    $FirstName = ucwords(strtolower($FirstName));
    $LastName = ucwords(strtolower($LastName));

    /*
    $validation_config = array(
        'MobileNumber' => array(
            'pattern' => '/^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$/',
            'errorMsg' => 'Invalid Mobile Number'
        ),
        'Email' => array(
            'pattern' => '/^[a-z0-9\.-_]+@[a-z0-9\.-_]+(\.com|\.org|\.net|\.int|\.edu|\.gov|\.mil|\.[a-z]{2})$/i',
            'errorMsg' => 'Invalid Email'
        ),
        'City' => array(
            'pattern' => $common_functions->get_regex_of_cities(),
            'errorMsg' => 'Invalid City'
        )

    );

    $validation_return = $common_functions->validate($_GET, $validation_config);
    if($validation_return['hasError']){
        print_r($validation_return);
        die();
        header("location: registration.php?error");

    }

    */

    $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $Password = hash('sha512', $Password . $salt);
    $EducAttain = "Bachelor's/College Degree";
    $yeargraduated = $GraduatedMonth . " " . $GraduatedYear;

    GSecureSQL::query(
        "INSERT INTO studentinfotbl (StudentID,FirstName,LastName,Birthdate,Password,SaltedPassword,MajorCourse) values (?,?,?,?,?,?,?)",
        FALSE,
        "sssssss",
        $StudentID,
        $FirstName,
        $LastName,
        $Birthday,
        $Password,
        $salt,
        $Course
    );

    GSecureSQL::query(
        "INSERT INTO schooltbl (StudentID,School,Attainment,Course,Graduated,_Default) values (?,'STI College Caloocan',?,?,?,'1')",
        FALSE,
        "ssss",
        $StudentID,
        $EducAttain,
        $Course,
        $yeargraduated
    );

    GSecureSQL::query(
        "INSERT INTO studcontactstbl (StudentID,Email,MobileNumber,City) values (?,?,?,?)",
        FALSE,
        "ssss",
        $StudentID,
        $Email,
        $MobileNumber,
        $City
    );

    GSecureSQL::query(
        "INSERT INTO progresstbl (StudentID) values (?)",
        FALSE,
        "s",
        $StudentID
    );

    GSecureSQL::query(
        "INSERT INTO studnotificationtbl (StudentID, Message, _From, Seen) VALUES (?, 'No new notification.', 'PlacementCell', '1')",
        FALSE,
        "s",
        $StudentID
    );

    header("location: login-student.php");

}
?>