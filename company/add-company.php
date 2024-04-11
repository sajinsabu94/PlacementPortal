<?php
include('../connection.php');
session_start();
$CompanyID = $_SESSION['CompanyID'];

// Create Position
if (isset($_GET['btnsave'])) {
    $DateFrom = $_GET['DateFrom'];
    $DateTo = $_GET['DateTo'];
    $PTitle = $_GET['PTitle'];
    $PLevel = $_GET['PLevel'];
    $JobDesc = $_GET['JobDesc'];
    $Specialization = $_GET['Specialization'];
    $EType = $_GET['EType'];
    $AvPosition = $_GET['AvPosition'];
    $Salary = $_GET['Salary'];
    $YExperience = $_GET['YExperience'];
    $DegreeLevel = $_GET['DegreeLevel'];
    $RequiredSkills = $_GET['knowledge'];
    $Language = $_GET['language'];

    $DegreeLevel = implode(", ", $DegreeLevel);
    $RequiredSkills = implode(", ", $RequiredSkills);
    $Language = implode(", ", $Language);

    GSecureSQL::query(
        "INSERT INTO comppositiontbl (CompanyID,PostingDateFrom,PostingDateTo,PositionTitle,PositionLevel,JobDescription,JSpecialization,EType,AvPosition,MonthlySalary,YExperience,DegreeLevel,Reqskills,Languages) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssssssssss",
        $CompanyID,
        $DateFrom,
        $DateTo,
        $PTitle,
        $PLevel,
        $JobDesc,
        $Specialization,
        $EType,
        $AvPosition,
        $Salary,
        $YExperience,
        $DegreeLevel,
        $RequiredSkills,
        $Language
    );
    header("location: company-positionlist.php?id=1");

}
// End of Create Position

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $RID = $_POST['rid'];
    $Message = $_POST['AcceptMsg'];
    $_Date = date("Y-m-d");

    if ($id == 1) {
        GSecureSQL::query(
            "UPDATE requesttocompanytbl SET Status = 'Accepted', Message = ?, _Date = ?  WHERE RID = ?",
            FALSE,
            "sss",
            $Message,
            $_Date,
            $RID
        );
        header("location: company-pendingapplicants.php?id=1");

    } elseif ($id == 2) {
        GSecureSQL::query(
            "UPDATE requesttocompanytbl SET Status = 'Rejected', Message = ?, _Date = ? WHERE RID = ?",
            FALSE,
            "sss",
            $Message,
            $_Date,
            $RID
        );

        header("location: company-pendingapplicants.php?id=2");
    }

}
if (isset($_POST['CourseCheckbox'])) {
    $Course = $_POST['CourseCheckbox'];
    $Course = implode(", ", $Course);
    $DateRequested = date("Y-m-d");

    GSecureSQL::query(
        "INSERT INTO logrequesttbl (CompanyID,Course,Status,DateRequested) values (?,?,'Pending',?)",
        FALSE,
        "sss",
        $CompanyID,
        $Course,
        $DateRequested
    );
    header("location: company.php?id=2");

}

// Update ng Info ng Company
if (isset($_POST['type'])) {
    $isAvailable = true;
    $aCompanyName = $_POST['CompanyName'];
    $Result =
        GSecureSQL::query(
            "SELECT CompanyName FROM companyinfotbl WHERE CompanyName = ?",
            TRUE,
            "s",
            $aCompanyName
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

if (isset($_GET['btnSaveSetting'])) {
    $CompanyName = $_GET['CompanyName'];
    $Description = $_GET['Description'];
    $Industry = $_GET['industry'];
    $Address = $_GET['Address'];
    $City = $_GET['City'];
    $Postal = $_GET['Postal'];
    $MobileNum = $_GET['MobileNum'];
    $PhoneNum = $_GET['TelNum'];
    $Fax = $_GET['Fax'];

    GSecureSQL::query(
        "UPDATE companyinfotbl SET CompanyName = ?, Description = ?, Industry = ?, Address = ?, City = ?, PostalCode = ?, MobileNum = ?, PhoneNum = ?, Fax = ? WHERE CompanyID = ?",
        FALSE,
        "ssssssssss",
        $CompanyName,
        $Description,
        $Industry,
        $Address,
        $City,
        $Postal,
        $MobileNum,
        $PhoneNum,
        $Fax,
        $CompanyID
    );
    header("location: company-settings.php?id=SettingEdit");
}

//Update ng info ng User ni Company
if (isset($_GET['btnsaveuser'])) {
    $FirstName = $_GET['FirstName'];
    $MiddleName = $_GET['MiddleName'];
    $LastName = $_GET['LastName'];
    $Position = $_GET['Position'];
    $Department = $_GET['Department'];

    GSecureSQL::query(
        "UPDATE companyinfotbl SET FirstName = ?, MiddleName = ?, LastName = ?, Position = ?, Department = ? WHERE CompanyID = ?",
        FALSE,
        "ssssss",
        $FirstName,
        $MiddleName,
        $LastName,
        $Position,
        $Department,
        $CompanyID
    );
    header("location: company-settingsaccount.php?id=AccountEdit");
}

// Update ng Available Position
if (isset($_GET['update_PositionID'])) {
    # code...
}

if (isset($_POST['btnRequestLOG'])) {

    $PositionTitle = $_POST['rPTitle'];

    $EmploymentType = $_POST['rEType']; //Checkbox array
    $EmploymentType = implode(", ", $EmploymentType);

    if (isset($_POST['other'])) {
        $OtherEType = $_POST['other']; //checkbox other
        $txtOtherEType = $_POST['txtOther']; //other field
    } else {
        $OtherEType = "off";
    }

    if (isset($_POST['pOther'])) {
        $pOther = $_POST['pOther']; //checkbox other
        $txtPOther = $_POST['txtPOther']; //other field
    } else {
        $pOther = "off";
    }


    $rPLevel = $_POST['rPLevel']; //Checkbox array
    $rPLevel = implode(", ", $rPLevel);


    $Description = $_POST['rDescription'];
    $Qualification = $_POST['rQualification'];
    $Location = $_POST['rLocation'];
    $SalaryRange = $_POST['rSalaryRange'];

    $Courses = $_POST['Course']; //Checkbox array
    $Courses = implode(", ", $Courses);


    $YearOfExperience = $_POST['rYOE'];
    $CFG = $_POST['CFG'];
    $DurationOfRequest = $_POST['rDOR']; //Radiobutton
    $txtDORother = $_POST['txtDORother']; //other field
    $MarketingMaterials = $_POST['MarketingMaterials'];
    $DateRequested = date("Y-m-d");

    if ($OtherEType == "on") {
        $EmploymentType = $EmploymentType . ", " . $txtOtherEType;
    }

    if ($pOther == "on") {
        $rPLevel = $rPLevel . ", " . $txtPOther;
    }

    if ($DurationOfRequest == "other") {
        $DurationOfRequest = $txtDORother;
    }

    GSecureSQL::query(
        "INSERT INTO logrequesttbl
        (CompanyID,
        Courses,
        Status,
        DateRequested,
        PositionTitle,
        EmployeeClassification,
        PositionLevel,
        Description,
        Qualifications,
        Location,
        SalaryRange,
        RequiredYOE,
        CFG,
        DurationOfRequest,
        MarketingMaterials)
        VALUES
        (?,?,'Pending',?,?,?,?,?,?,?,?,?,?,?,?)",
        FALSE,
        "ssssssssssssss",
        $CompanyID,
        $Courses,
        $DateRequested,
        $PositionTitle,
        $EmploymentType,
        $rPLevel,
        $Description,
        $Qualification,
        $Location,
        $SalaryRange,
        $YearOfExperience,
        $CFG,
        $DurationOfRequest,
        $MarketingMaterials
    );

    header("location: company.php");

}

//Update Available Position
if (isset($_POST['uAvPosition'])) {
    $aPositionID = $_POST['aPositionID'];
    $uAvPosition = $_POST['uAvPosition'];

    GSecureSQL::query(
        "UPDATE comppositiontbl SET AvPosition = ? WHERE PositionID = ?",
        FALSE,
        "ss",
        $uAvPosition,
        $aPositionID
    );

    header("location: company-positionlist.php?id=2");
}

//Change Company Username
if (isset($_POST['ModalNewUsername'])) {
    $Username = $_POST['ModalNewUsername'];

    GSecureSQL::query(
        "UPDATE companyinfotbl SET Email = ? WHERE CompanyID = ?",
        FALSE,
        "ss",
        $Username,
        $CompanyID
    );

    header("location: company-settingsaccount.php?id=1");

}

//Change Company Password
if (isset($_POST['ModalNewPassword'])) {
    $OldPassword = $_POST['ModalOldPassword'];
    $NewPassword = $_POST['ModalNewPassword'];

    $company_tbl =
        GSecureSQL::query(
            "SELECT
                `Password`,
                `SaltedPassword`
            FROM `companyinfotbl` WHERE `CompanyID` = ?",
            TRUE,
            "s",
            $CompanyID
        );

    if (count($company_tbl)) {
        if (hash('sha512', $OldPassword . $company_tbl[0][1]) == $company_tbl[0][0]) {

            $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
            $NewPassword = hash('sha512', $NewPassword . $salt);

            GSecureSQL::query(
                "UPDATE companyinfotbl SET Password = ? , SaltedPassword = ? WHERE CompanyID = ?",
                FALSE,
                "sss",
                $NewPassword,
                $salt,
                $CompanyID
            );

            header("location: company-settingsaccount.php?id=2");

        } else {
            echo "Wrong password";
        }
    } else {
        echo "Wrong password";
    }
}

if(isset($_POST['delete_applicant'])){
    $RID = $_POST['rid'];

    GSecureSQL::query(
        "UPDATE requesttocompanytbl SET Status = 'Deleted' WHERE RID = ?",
        FALSE,
        "s",
        $RID
    );

    header('location: company-acceptedapplicants.php?id=1');
}