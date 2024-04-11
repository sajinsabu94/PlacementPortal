<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID'];

if (isset($_POST['EditSchool'])) {
    $SchoolID = $_POST['EditSchoolID'];
    $SchoolID = encrypt_decrypt("decrypt", $SchoolID);
    $School = ucwords($_POST['EditSchool']);
    $Attainment = $_POST['EditEducAttainment'];
    $Course = $_POST['EditCourse'];
    $Graduation = $_POST['EditGraduatedYearFrom'] . " - " . $_POST['EditGraduatedYearTo'];

    if(isset($_POST['EdittxtCourse'])){
        $txtCourse = $_POST['EdittxtCourse'];
    }


    $a = $Attainment == "SSLC";
    $a = $a || $Attainment == "Plus Two";
    $a = $a || $Attainment == "UG";
    $a = $a || $Attainment == "PG";
    $a = $a || $Attainment == "Doctorate";

    if(!$a){
        header("location: education.php?error");
        die();

    }

    if($Attainment != "High School Diploma"){
        if($Course == "other"){
            $Course = $txtCourse;
            if($Course == ""){
                header("location: education.php?error");
                die();
            }
        }else{
            $course_valid = GSecureSQL::query(
                "SELECT COUNT(*) AS `Count` FROM `coursetbl` WHERE `CourseCode` = ?", TRUE, "s", $Course
            );

            if($course_valid[0][0] == 0){
                header("location: education.php?error");
                die();

            }
        }

    }

    $a = FALSE;
    $b = FALSE;
    $date = Date("Y") + 15;
    while ($date != 1935) {
        $date--;
        $a = $a || $_POST['EditGraduatedYearFrom'] == $date;
        $b = $b || $_POST['EditGraduatedYearTo'] == $date;
    }

    if(!$a || !$b){
        header("location: education.php?error");
        die();

    }

    if(strlen($_POST['EditSchool']) === 0){
        header("location: education.php?error");
        die();

    }

    GSecureSQL::query(
        "UPDATE schooltbl SET School = ?, Attainment =?, Course = ?, Graduated = ? WHERE SchoolID = ? AND StudentID = ?",
        FALSE,
        "ssssss",
        $School,
        $Attainment,
        $Course,
        $Graduation,
        $SchoolID,
        $StudentID
    );
    header("location: education.php?saved");
    die();

}

if (isset($_POST['EditCertification'])) {
    $CertificationID = $_POST['EditCertificationID'];
    $Certification = ucwords($_POST['EditCertification']);
    $YearTaken = $_POST['EditYearTaken'];

    $CertificationID = encrypt_decrypt("decrypt", $CertificationID);

    if(strlen($Certification) === 0){
        header("Location: certification.php?error");
        die();
    }

    $date = Date("Y") + 1;
    $a = FALSE;
    while($date != 1935){
        $date--;
        $a = $a || $date == $YearTaken;
    }

    if(!$a){
        header("Location: certification.php?error");
        die();
    }

    GSecureSQL::query(
        "UPDATE certificationtbl SET Certification = ?, YearTaken = ? WHERE CertificationID = ? AND StudentID = ?",
        FALSE,
        "ssss",
        $Certification,
        $YearTaken,
        $CertificationID,
        $StudentID
    );
    header("location: certifications.php?saved");

}

if (isset($_POST['EditAchievementID'])) {
    $AchievementID = $_POST['EditAchievementID'];
    $Achievement = ucwords($_POST['EditAchievement']);

    $AchievementID = encrypt_decrypt("decrypt", $AchievementID);
    if(strlen($Achievement) === 0){
        header('Location: achievements.php?error');
        die();
    }

    GSecureSQL::query(
        "UPDATE achievementstbl SET Achievements = ? WHERE AchievementID = ? AND StudentID = ?",
        FALSE,
        "sss",
        $Achievement,
        $AchievementID,
        $StudentID
    );
    header("location: achievements.php?saved");

}

if (isset($_POST['EditReferenceID'])) {
    $ReferenceID = $_POST['EditReferenceID'];
    $Name = ucwords($_POST['EditName']);
    $Relationship = ucwords($_POST['EditRelationship']);
    $Company = ucwords($_POST['EditCompany']);
    $Position = ucwords($_POST['EditPosition']);
    $Phone = $_POST['EditPhone'];
    $Email = $_POST['EditEmail'];

    $ReferenceID = encrypt_decrypt("decrypt", $ReferenceID);

    GSecureSQL::query(
        "UPDATE referencetbl SET Name = ?, Relationship = ?, Company = ?, Position = ?, Phone = ?, Email = ? WHERE ReferenceID = ? AND StudentID = ?",
        FALSE,
        "ssssssss",
        $Name,
        $Relationship,
        $Company,
        $Position,
        $Phone,
        $Email,
        $ReferenceID,
        $StudentID
    );
    header("location: references.php?saved");

}

if (isset($_POST['EditSkillID'])) {
    $SID = $_POST['EditSkillID'];
    $YearsOfExperience = $_POST['EditYearsOfExperience'];
    $Proficiency = $_POST['EditSkills'];
    $Skill = ucwords($_POST['EditSkill']);

    $SID = encrypt_decrypt("decrypt", $SID);

    $a = is_numeric($YearsOfExperience) && $YearsOfExperience >= 0;
    if(!$a){
        header('Location: skills-and-languages.php?error');
        die();
    }

    if(strlen($Skill) === 0){
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $Proficiency >= 1 && $Proficiency <= 5;
    if(!$a){
        header('Location: skills-and-languages.php?error');
        die();
    }

    GSecureSQL::query(
        "UPDATE specializationtbl SET Skills = ?, YearOfExperience = ?, Proficiency = ? WHERE SID = ? AND StudentID = ?",
        FALSE,
        "sssss",
        $Skill,
        $YearsOfExperience,
        $Proficiency,
        $SID,
        $StudentID
    );
    header("location: skills-and-languages.php?saved");
    die();
}

if (isset($_POST['EditLangID'])) {

    $LangID = $_POST['EditLangID'];
    $Language = ucwords($_POST['EditLanguage']);
    $WrittenProficiency = $_POST['EditWrittenProficiency'];
    $SpokenProficiency = $_POST['EditSpokenProficiency'];

    $LangID = encrypt_decrypt("decrypt", $LangID);

    if(strlen($Language) === 0){
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $WrittenProficiency >= 1 && $WrittenProficiency <= 5;
    if(!$a){
        header('Location: skills-and-languages.php?error');
        die();
    }

    $a = $SpokenProficiency >= 1 && $SpokenProficiency <= 5;
    if(!$a){
        header('Location: skills-and-languages.php?error');
        die();
    }

    GSecureSQL::query(
        "UPDATE languagetbl SET `Language` = ?, `WrittenProf` = ?, `SpokenProf` = ? WHERE LangID = ? AND StudentID = ?",
        FALSE,
        "sssss",
        $Language,
        $WrittenProficiency,
        $SpokenProficiency,
        $LangID,
        $StudentID
    );

    header("location: skills-and-languages.php?saved");

}

if (isset($_POST['EditCompanyName'])) {
    $WorkID = $_POST['EditWorkID'];
    $WorkID = encrypt_decrypt("decrypt", $WorkID);
    $CompanyName = ucwords($_POST['EditCompanyName']);
    $CompanyAddress = $_POST['EditCompanyAddress'];
    $Industry = $_POST['EditIndustry'];
    $DateFromMonth = $_POST['EditFromMonth'];
    $DateFromYear = $_POST['EditFromYear'];
    $DateToMonth = $_POST['EditToMonth'];
    $DateToYear = $_POST['EditToYear'];
    $PositionLevel = $_POST['EditPositionLevel'];
    $WorkSpecialization = $_POST['EditWorkSpecialization'];
    $MonthlySalary = $_POST['EditMonthlySalary'];
    $NatureOfWork = $_POST['EditNatureOfWork'];

    if (isset($_POST['EditDuration'])) {
        $Duration = $_POST['EditDuration'];
        if ($Duration == "on") {
            $DateToYear = "Current";
        }
    }

    $validation_config = array(
        'EditCompanyName' => array(
            'pattern' => '/^.+$/',
            'errorMsg' => 'Company name is required'
        ),
        'EditCompanyAddress' => array(
            'pattern' => '/(^$|^(http|https):\/\/.+\..+$)/i',
            'errorMsg' => 'Company address is required'
        ),
        'EditMonthlySalary' => array(
            'pattern' => $common_functions->get_regex_of_monthly_salary(),
            'errorMsg' => 'Invalid Money Salary'
        ),
        'EditFromMonth' => array(
            'pattern' => '/^(0[1-9]|1[0-2])$/',
            'errorMsg' => 'Invalid Month'
        ),
        'EditFromYear' => array(
            'pattern' => '/^(19(3[5-9]|[4-9][0-9])|2[0-9][0-9][0-9])$/',
            'errorMsg' => 'Invalid Year'
        ),
        'EditToMonth' => array(
            'pattern' => '/^(0[1-9]|1[0-2])$/',
            'errorMsg' => 'Invalid Month'
        ),
        'EditToYear' => array(
            'pattern' => '/^(19(3[5-9]|[4-9][0-9])|2[0-9][0-9][0-9])$/',
            'errorMsg' => 'Invalid Year'
        )
    );

    $validation_return = $common_functions->validate($_POST, $validation_config);
    if ($validation_return['hasError']) {

    }

    if ($DateToYear !== 'Current') {
        if ($_POST['EditToYear'] === $_POST['EditFromYear']) {
            if ($_POST['EditFromMonth'] > $_POST['EditToMonth']) {
                die('Invalid month.');
            }
        }
    }

    GSecureSQL::query(
        "UPDATE workexperiencetbl SET StudentID = ?, CompanyName = ?, CompanyAddress = ?, Industry = ?, DateFromMonth = ?, DateFromYear = ?, DateToMonth = ?, DateToYear = ?, PositionLevel = ?, Specialization = ?, MonthlySalary = ?, NatureOfWork = ? WHERE StudentID = ? AND WorkID = ?",
        FALSE,
        "ssssssssssssss",
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
        $NatureOfWork,
        $StudentID,
        $WorkID
    );

    GSecureSQL::query(
        "UPDATE progresstbl SET WorkXP = 'ok' WHERE StudentID = ?",
        FALSE,
        "s",
        $StudentID
    );

    header("location: work.php?saved");
}
if (isset($_POST['URLID'])) {
    $id = $_POST['URLID'];
    $URL = $_POST['EdittxtURL'];
    $Caption = $_POST['EdittxtCaption'];

    $id = encrypt_decrypt("decrypt", $id);

    $validation_config = array(
        'EdittxtCaption' => array(
            'pattern' => '/^.+$/',
            'errorMsg' => 'caption'
        ),
        'EdittxtURL' => array(
            'pattern' => '/(^$|^(http|https):\/\/.+\..+$)/i',
            'errorMsg' => 'url'
        ),
    );

    $validation_return = $common_functions->validate($_POST, $validation_config);
    if ($validation_return['hasError']) {
        header("location: portfolio.php?error");
        die();
    }

    GSecureSQL::query(
        "UPDATE urltbl SET URL = ?, Caption = ? WHERE StudentID = ? AND id = ?",
        FALSE,
        "ssss",
        $URL,
        $Caption,
        $StudentID,
        $id
    );

    header("location: portfolio.php?saved");
}