<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx


$StudentID = $_SESSION['StudentID'];

if (isset($_POST['School'])) {
    $School = ucwords($_POST['School']);
    $Attainment = $_POST['EducAttainment'];
    $Course = $_POST['Course'];
    $txtCourse = $_POST['txtCourse'];
    $GraduatedYearFrom = $_POST['GraduatedYearFrom'];
    $GraduatedYearTo = $_POST['GraduatedYearTo'];
    $Graduation = $GraduatedYearFrom . " - " . $GraduatedYearTo;

    $a = $Attainment == "SSLC";
    $a = $a || $Attainment == "Plus Two";
    $a = $a || $Attainment == "UG";
    $a = $a || $Attainment == "PG";
    $a = $a || $Attainment == "Doctorate";

    if (!$a) {
        header("location: education.php?error");
        die();
    }

    if ($Attainment != "High School Diploma") {
        $course_valid = GSecureSQL::query(
            "SELECT COUNT(*) AS `Count` FROM `coursetbl` WHERE `CourseCode` = ?", TRUE, "s", $Course
        );

        if ($course_valid[0][0] == 0 && $Course != "other") {
            header("location: education.php?error");
            die();
        }
    }

    $a = FALSE;
    $b = FALSE;
    $date = Date("Y") + 15;
    while ($date != 1935) {
        $date--;
        $a = $a || $_POST['GraduatedYearFrom'] == $date;
        $b = $b || $_POST['GraduatedYearTo'] == $date;
    }

    if (!$a || !$b) {
        header("location: education.php?error");
        die();
    }

    if (strlen($_POST['School']) === 0) {
        header("location: education.php?error");
        die();
    }

    if ($Course == "other") {
        $Course = $txtCourse;
    }

    GSecureSQL::query(
        "INSERT INTO schooltbl (StudentID,School,Attainment,Course,Graduated,_Default) values  (?,?,?,?,?,?)",
        FALSE,
        "ssssss",
        $StudentID,
        $School,
        $Attainment,
        $Course,
        $Graduation,
        '0'
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET School = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: education.php?saved");

}

if (isset($_POST['Certification'])) {
    $Certification = ucwords($_POST['Certification']);
    $YearTaken = $_POST['YearTaken'];

    if (strlen($Certification) === 0) {
        header("Location: certifications.php?error");
        die();
    }

    $date = Date("Y") + 1;
    $a = FALSE;
    while ($date != 1935) {
        $date--;
        $a = $a || $date == $YearTaken;
    }

    if (!$a) {
        header("Location: certifications.php?error");
        die();
    }

    GSecureSQL::query(
        "INSERT INTO certificationtbl (StudentID,Certification,YearTaken) values  (?,?,?)",
        FALSE,
        "sss",
        $StudentID,
        $Certification,
        $YearTaken
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Certification = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: certifications.php?saved");

}


if (isset($_POST['Achievement'])) {
    $Achievement = ucwords($_POST['Achievement']);

    if (strlen($Achievement) === 0) {
        header('Location: achievements.php?error');
        die();
    }

    GSecureSQL::query(
        "INSERT INTO achievementstbl (StudentID,Achievements) values  (?,?)",
        FALSE,
        "ss",
        $StudentID,
        $Achievement
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Achievements = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: achievements.php?saved");

}
if (isset($_POST['Name'])) {
    $Name = ucwords($_POST['Name']);
    $Relationship = ucwords($_POST['Relationship']);
    $Company = ucwords($_POST['Company']);
    $Position = ucwords($_POST['Position']);
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Others = "off";
    if(isset($_POST['Other'])){
        $Others = $_POST['Other'];

    }

    /*
        $validation_config = array(
            'Email' => array(
                'pattern' => '/^[a-z0-9\.-_]+@[a-z0-9\.-_]+(\.com|\.org|\.net|\.int|\.edu|\.gov|\.mil|\.[a-z]{2})$/i',
                'errorMsg' => 'Invalid Email'
            ),
            'MobileNumber' => array(
                'pattern' => '/^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$/',
                'errorMsg' => 'Invalid Mobile Number'
            ),
            'HomeNumber' => array(
                'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
                'errorMsg' => 'Invalid Home Number'
            ),
            'WorkNumber' => array(
                'pattern' => '/(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/',
                'errorMsg' => 'Invalid Work Number'
            ),
            'Address' => array(
                'pattern' => '/^.+$/',
                'errorMsg' => 'Address cannot be empty'
            ),
            'City' => array(
                'pattern' => $common_functions->get_regex_of_cities(),
                'errorMsg' => 'Invalid City'
            ),

            'PostalCode' => array(
                'pattern' => '/^[0-9]+$/',
                'errorMsg' => 'Invalid Postal Code'
            )

        );

        $validation_return = $common_functions->validate($_GET, $validation_config);
        if($validation_return['hasError']){
            print_r($validation_return);
            die();
            header("location: references.php?error");

        }
    */
    GSecureSQL::query(
        "INSERT INTO referencetbl(StudentID, Name, Relationship, Company, Position, Phone, Email, Others) values (?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssss",
        $StudentID,
        $Name,
        $Relationship,
        $Company,
        $Position,
        $Phone,
        $Email,
        $Others
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET _References= 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );
    header("location: references.php?saved");
    die();

}
if (isset($_POST['Skill'])) {
    $YearsOfExperience = $_POST['YearsOfExperience'];
    $Proficiency = $_POST['rating'];
    $Skill = $_POST['Skill'];

    $a = is_numeric($YearsOfExperience) && $YearsOfExperience >= 0;
    if (!$a) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    if (strlen($Skill) === 0) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $Proficiency >= 1 && $Proficiency <= 5;
    if (!$a) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    GSecureSQL::query(
        "INSERT INTO specializationtbl (StudentID, YearOfExperience, Proficiency, Skills) values (?,?,?,?)",
        FALSE,
        "ssss",
        $StudentID,
        $YearsOfExperience,
        $Proficiency,
        $Skill
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Specialization = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: skills-and-languages.php?saved");

}

if (isset($_POST['Language'])) {
    $Language = ucwords($_POST['Language']);
    $WrittenProficiency = $_POST['WrittenProficiency'];
    $SpokenProficiency = $_POST['SpokenProficiency'];

    if (strlen($Language) === 0) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $WrittenProficiency >= 1 && $WrittenProficiency <= 5;
    if (!$a) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $SpokenProficiency >= 1 && $SpokenProficiency <= 5;
    if (!$a) {
        header('Location: skills-and-languages.php?error');
        die();
    }

    GSecureSQL::query(
        "INSERT INTO languagetbl (StudentID, `Language`, WrittenProf, SpokenProf) values (?,?,?,?)",
        FALSE,
        "ssss",
        $StudentID,
        $Language,
        $WrittenProficiency,
        $SpokenProficiency
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET Languages = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: skills-and-languages.php?saved");

}
if (isset($_POST['CompanyName'])) {
    $CompanyName = ucwords($_POST['CompanyName']);
    $CompanyAddress = $_POST['CompanyAddress'];
    $Industry = $_POST['Industry'];
    $DateFromMonth = $_POST['FromMonth'];
    $DateFromYear = $_POST['FromYear'];
    $DateToMonth = $_POST['ToMonth'];
    $DateToYear = $_POST['ToYear'];
    $PositionLevel = $_POST['PositionLevel'];
    $WorkSpecialization = $_POST['WorkSpecialization'];
    $MonthlySalary = $_POST['MonthlySalary'];
    $NatureOfWork = $_POST['NatureOfWork'];

    if (isset($_POST['Duration'])) {
        $Duration = $_POST['Duration'];
        if ($Duration == "on") {
            $DateToYear = "Current";
        }
    }

    $validation_config = array(
        'CompanyName' => array(
            'pattern' => '/^.+$/',
            'errorMsg' => 'Company name is required'
        ),
        'CompanyAddress' => array(
            'pattern' => '/(^$|^(http|https):\/\/.+\..+$)/i',
            'errorMsg' => 'Company address is required'
        ),
        'MonthlySalary' => array(
            'pattern' => $common_functions->get_regex_of_monthly_salary(),
            'errorMsg' => 'Invalid Money Salary'
        ),
        'FromMonth' => array(
            'pattern' => '/^(0[1-9]|1[0-2])$/',
            'errorMsg' => 'Invalid Month'
        ),
        'FromYear' => array(
            'pattern' => '/^(19(3[5-9]|[4-9][0-9])|2[0-9][0-9][0-9])$/',
            'errorMsg' => 'Invalid Year'
        ),
        'ToMonth' => array(
            'pattern' => '/^(0[1-9]|1[0-2])$/',
            'errorMsg' => 'Invalid Month'
        ),
        'ToYear' => array(
            'pattern' => '/^(19(3[5-9]|[4-9][0-9])|2[0-9][0-9][0-9])$/',
            'errorMsg' => 'Invalid Year'
        )
    );

    $validation_return = $common_functions->validate($_POST, $validation_config);
    if ($validation_return['hasError']) {
        header("location: work.php?error");
    }

    if ($DateToYear !== 'Current') {
        if ($_POST['ToYear'] === $_POST['FromYear']) {
            if ($_POST['FromMonth'] > $_POST['ToMonth']) {
                header("location: work.php?error");
                die('Invalid month.');
            }
        }
    }

    GSecureSQL::query(
        "INSERT INTO workexperiencetbl (StudentID, CompanyName, CompanyAddress, Industry, DateFromMonth, DateFromYear, DateToMonth, DateToYear, PositionLevel, Specialization, MonthlySalary, NatureOfWork) value (?,?,?,?,?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssssssss",
        $StudentID,
        $CompanyName,
        $CompanyAddress,
        $Industry,
        $DateFromMonth,
        $DateFromYear,
        $DateToMonth,
        $DateToYear,
        $PositionLevel,
        $WorkSpecialization,
        $MonthlySalary,
        $NatureOfWork
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET WorkXP = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: work.php?saved");

}
if (isset($_POST['txtURL'])) {
    $URL = $_POST['txtURL'];
    $Caption = $_POST['txtCaption'];


    $validation_config = array(
        'CompanyName' => array(
            'pattern' => '/^.+$/',
            'errorMsg' => 'Company name is required'
        ),
        'CompanyAddress' => array(
            'pattern' => '/(^$|^(http|https):\/\/.+\..+$)/i',
            'errorMsg' => 'Company address is required'
        ),
    );

    $validation_return = $common_functions->validate($_POST, $validation_config);
    if ($validation_return['hasError']) {
        header("location: portfolio.php?error");
    }

    GSecureSQL::query(
        "INSERT INTO urltbl (StudentID, URL, Caption) VALUES (?,?,?)",
        TRUE,
        "sss",
        $StudentID,
        $URL,
        $Caption
    );

    header("location: portfolio.php?saved");
}

if(isset($_POST['uploadtest'])){
    //start upload
    $Time = date('H:i:s');
    $fileToUpload = basename($_FILES["Document"]["name"]);
    $ext = pathinfo($_FILES["Document"]["name"]);
    $ext = $ext['extension'];
    $fileToUploadenc = encrypt_decrypt_plusTime("encrypt", $fileToUpload,$Time);
    $target_dir = "fileuploads/";
    $target_file = $target_dir . $fileToUploadenc . "." . $ext;
    $uploadOk = 1;
    $imageFileType = pathinfo($fileToUpload, PATHINFO_EXTENSION);

    $a = $imageFileType == "doc";
    $a = $a || $imageFileType == "docx";
    $a = $a || $imageFileType == "xls";
    $a = $a || $imageFileType == "xlsx";
    $a = $a || $imageFileType == "ppt";
    $a = $a || $imageFileType == "pptx";
    $a = $a || $imageFileType == "txt";
    $a = $a || $imageFileType == "pdf";

    if(!$a){
        header("location: portfolio.php?error");
        $uploadOk = 0;
        die();

    }

    if ($uploadOk == 0) {
        header("location: portfolio.php?error");
        die();

    } else {
        if (move_uploaded_file($_FILES["Document"]["tmp_name"], $target_file)) {

            GSecureSQL::query(
                "INSERT INTO filestbl (StudentID, Filename, EncryptedFile, _Time) VALUES (?,?,?,?)",
                FALSE,
                "ssss",
                $StudentID,
                $fileToUpload,
                $target_file,
                $Time
            );

            header("location: portfolio.php?saved");
            die();

        } else {
            header("location: portfolio.php?error");
            die();
        }
    }
    // end upload
}
if(isset($_GET['DocID'])){
    $DocID = $_GET['DocID'];
    $DocID = encrypt_decrypt("decrypt", $DocID);

    $qryfile =
        GSecureSQL::query(
            "SELECT Filename, EncryptedFile FROM filestbl WHERE id = ?",
            TRUE,
            "s",
            $DocID
        );
    $filename = $qryfile[0][0]; //filename
    $filepath = $qryfile[0][1];
    $name = substr($filepath, 12); //encrypted filename

    echo $filename . "<br>";
    echo $name. "<br>";
    echo $filepath. "<br>";


    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    ob_clean();
    flush();
    readfile($filepath);
    exit;
}

if(isset($_POST['uploadphoto'])){
    //start upload
    $Caption = $_POST['PhotoCaption'];

    $Time = date('H:i:s');
    $fileToUpload = basename($_FILES["_Photo"]["name"]);
    $ext = pathinfo($_FILES["_Photo"]["name"]);
    $ext = $ext['extension'];
    $fileToUploadenc = encrypt_decrypt_plusTime("encrypt", $fileToUpload,$Time);
    $target_dir = "imageuploads/";
    $target_file = $target_dir . $fileToUploadenc . "." . $ext;
    $uploadOk = 1;
    $imageFileType = pathinfo($fileToUpload, PATHINFO_EXTENSION);

    $a = $imageFileType == "jpg";
    $a = $a || $imageFileType == "jpeg";
    $a = $a || $imageFileType == "png";

    if(!$a){
        die();
        header("location: portfolio.php?error");
        $uploadOk = 0;


    }

    if ($uploadOk == 0) {
        header("location: portfolio.php?error");
        die();

    } else {
        if (move_uploaded_file($_FILES["_Photo"]["tmp_name"], $target_file)) {

            GSecureSQL::query(
                "INSERT INTO phototbl (StudentID, Filename, EncryptedName, Caption, _Time) VALUES (?,?,?,?,?)",
                FALSE,
                "sssss",
                $StudentID,
                $fileToUpload,
                $target_file,
                $Caption,
                $Time
            );

            header("location: portfolio.php?saved");
            die();

        } else {
            header("location: portfolio.php?error");
            die();
        }
    }
    // end upload
}