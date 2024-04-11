<?php
include('../../connection.php');
session_start();
include('../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; 


$studentinfo_tbl =
    GSecureSQL::query(
        "SELECT
        FirstName,
        MiddleName,
        LastName,
        ProfileImage,
        Objectives
        FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );
$FirstName = $studentinfo_tbl[0][0];
$MiddleName = $studentinfo_tbl[0][1];
$LastName = $studentinfo_tbl[0][2];
$ProfileImage = $studentinfo_tbl[0][3];
$Objectives = $studentinfo_tbl[0][4];

$studcontacts_tbl =
    GSecureSQL::query(
        "SELECT Address, MobileNumber, HomeNumber, Email  FROM studcontactstbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );
$Address = $studcontacts_tbl[0][0];
$MobileNumber = $studcontacts_tbl[0][1];
$HomeNumber = $studcontacts_tbl[0][2];
$Email = $studcontacts_tbl[0][3];

if (empty($HomeNumber)) {
    $ContactNumber = $MobileNumber;
} elseif (empty($MobileNumber)) {
    $ContactNumber = $HomeNumber;
} else {
    $ContactNumber = $MobileNumber . ", " . $HomeNumber;
}


$school_tbl =
    GSecureSQL::query(
        "SELECT School, Attainment, Graduated FROM schooltbl WHERE StudentID = ? AND _DEFAULT = 0",
        TRUE,
        "s",
        $StudentID
    );
$hsschool_tbl =
    GSecureSQL::query(
        "SELECT School, Attainment, Graduated FROM schooltbl WHERE StudentID = ? AND Attainment = 'PG'",
        TRUE,
        "s",
        $StudentID
    );
$School = $school_tbl[0][0];
$Attainment = $school_tbl[0][1];
$Graduated = $school_tbl[0][2];

$hSchool = $hsschool_tbl[0][0];
$hAttainment = $hsschool_tbl[0][1];
$hGraduated = $hsschool_tbl[0][2];
?>
<!doctype html>
<html lang="en">
<head>

    <!-- Basic -->
    <title>PlacementCell | Print Resumé</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="Margo - Responsive HTML5 Template">
    <meta name="author" content="iThemesLab">

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../../css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script src="../../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../../css/slicknav.css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/animate.css" media="screen">

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="../../css/PlacementCell-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="../../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../../js/modernizrr.js"></script>
    <script type="text/javascript" src="../../js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.appear.js"></script>
    <script type="text/javascript" src="../../js/count-to.js"></script>
    <script type="text/javascript" src="../../js/jquery.textillate.js"></script>
    <script type="text/javascript" src="../../js/jquery.lettering.js"></script>
    <script type="text/javascript" src="../../js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.parallax.js"></script>
    <script type="text/javascript" src="../../js/jquery.slicknav.js"></script>
</head>
<style type="text/css">
.padding {
    border: 1px solid black;
    background-color: #fff;
    padding-top: auto;
    padding-right: auto;
    padding-bottom: auto;
}
</style>

<body>
<div class="container">
    <div class="hr4" style="margin-top:20px;margin-bottom:30px;"></div>
    <div class="text-center">
        <button name="b_print" type="button" class="fa fa-print btn-system btn-mini border-btn"
                onClick="printdiv('div_print');" value=" Print " style="height:50px;"> Print this ResumÉ
        </button>
    </div>
    <div class="hr1" style="margin-top:20px;margin-bottom:20px;"></div>

    <div class="padding">
        <div id="div_print">
            <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>
            <div class="resume-container">
                <div class="row">
                    <div class="col-xs-8">
                        <p><label>Name:</label> <?php echo $FirstName . " " . $LastName; ?></p>
                        <p><label>Address:</label> <?php echo $Address; ?></p>
                        <p><label>Contact No.:</label> <?php echo $ContactNumber; ?></p>
                        <p><label>Email Address:</label> <?php echo $Email; ?></p>
                    </div>
                    <div class="col-xs-4">
                        <div class="resume-image-border" style="float:right;">
                            <img src="../myinfo/<?php echo $ProfileImage; ?>" class="img-responsive" style="width:200px; height:200px;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label>Objective:</label>
                        <p style="text-indent:50px;"><?php echo $Objectives; ?><p>
                    </div>
                </div>

                <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>

                <div class="row">
                    <div class="col-xs-12">
                        <label>Education:</label>
                        <div class="row">
                            <div class="col-xs-4">
                                <p><?php echo $Graduated; ?></p>
                                <p><?php echo $hGraduated; ?></p>
                            </div>
                            <div class="col-xs-4">
                                <p><label><?php echo $School; ?></label></p>
                                <p><label><?php echo $hSchool; ?></label></p>

                            </div>
                            <div class="col-xs-4">
                                <p><label><?php echo $Attainment; ?></label></p>
                                <p><label><?php echo $hAttainment; ?></label></p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>

                <div class="row">
                    <div class="col-xs-12">
                        <label>Work Experience:</label>
                        <?php
                        $workexperience_tbl =
                            GSecureSQL::query(
                                "SELECT
                                        CompanyName,
                                        DateFromMonth,
                                        DateFromYear,
                                        DateToMonth,
                                        DateToYear,
                                        PositionTitle,
                                        CompanyAddress
                                        FROM workexperiencetbl
                                        WHERE StudentID = ?
                                        ORDER BY DateToYear DESC
                                        LIMIT 2",
                                TRUE,
                                "s",
                                $StudentID
                            );

                        foreach ($workexperience_tbl as $value) {
                            $CompanyName = $value[0];
                            $DateFromMonth = $value[1];
                            $DateFromYear = $value[2];
                            $DateToMonth = $value[3];
                            $DateToYear = $value[4];
                            $PositionTitle = $value[5];
                            $CompanyAddress = $value[6];

                            if ($DateFromMonth == 1) {
                                $DateFromMonth = 'January';
                            }
                            if ($DateFromMonth == 2) {
                                $DateFromMonth = 'February';
                            }
                            if ($DateFromMonth == 3) {
                                $DateFromMonth = 'March';
                            }
                            if ($DateFromMonth == 4) {
                                $DateFromMonth = 'April';
                            }
                            if ($DateFromMonth == 5) {
                                $DateFromMonth = 'May';
                            }
                            if ($DateFromMonth == 6) {
                                $DateFromMonth = 'June';
                            }
                            if ($DateFromMonth == 7) {
                                $DateFromMonth = 'July';
                            }
                            if ($DateFromMonth == 8) {
                                $DateFromMonth = 'August';
                            }
                            if ($DateFromMonth == 9) {
                                $DateFromMonth = 'September';
                            }
                            if ($DateFromMonth == 10) {
                                $DateFromMonth = 'October';
                            }
                            if ($DateFromMonth == 11) {
                                $DateFromMonth = 'November';
                            }
                            if ($DateFromMonth == 12) {
                                $DateFromMonth = 'December';
                            }

                            /* Year */
                            if ($DateToMonth == 1) {
                                $DateToMonth = 'January';
                            }
                            if ($DateToMonth == 2) {
                                $DateToMonth = 'February';
                            }
                            if ($DateToMonth == 3) {
                                $DateToMonth = 'March';
                            }
                            if ($DateToMonth == 4) {
                                $DateToMonth = 'April';
                            }
                            if ($DateToMonth == 5) {
                                $DateToMonth = 'May';
                            }
                            if ($DateToMonth == 6) {
                                $DateToMonth = 'June';
                            }
                            if ($DateToMonth == 7) {
                                $DateToMonth = 'July';
                            }
                            if ($DateToMonth == 8) {
                                $DateToMonth = 'August';
                            }
                            if ($DateToMonth == 9) {
                                $DateToMonth = 'September';
                            }
                            if ($DateToMonth == 10) {
                                $DateToMonth = 'October';
                            }
                            if ($DateToMonth == 11) {
                                $DateToMonth = 'November';
                            }
                            if ($DateToMonth == 12) {
                                $DateToMonth = 'December';
                            }
                            $Date = $DateFromMonth . " " . $DateFromYear . " - " . $DateToMonth . " " . $DateToYear;
                            ?>

                            <div class="row">
                                <div class="col-xs-3">
                                    <p><?php echo $Date; ?></p>
                                </div>
                                <div class="col-xs-2">
                                    <p><?php echo $CompanyName; ?></p>
                                </div>
                                <div class="col-xs-3">
                                    <p><?php echo $PositionTitle; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <p><?php echo $CompanyAddress; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>

                <div class="row">
                    <div class="col-xs-12">
                        <label>Skills:</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <ul>
                                    <?php
                                    $skill_tbl =
                                        GSecureSQL::query(
                                            "SELECT Skills FROM specializationtbl WHERE StudentID = ? LIMIT 3",
                                            TRUE,
                                            "s",
                                            $StudentID
                                        );
                                    foreach ($skill_tbl as $value1) {
                                        $Skill = $value1[0];
                                        ?>
                                        <li><?php echo $Skill; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>             

                <div class="row">
                    <div class="col-xs-12">
                        <label>References:</label>
                        <div class="row" style="margin-left:20px; margin-right:20px;">
                            <?php
                            $reference_tbl =
                                GSecureSQL::query(
                                    "SELECT Name, Phone, Relationship, Email, Others FROM referencetbl WHERE StudentID = ? LIMIT 3",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );
                            foreach ($reference_tbl as $value) {
                                $Name = $value[0];
                                $PhoneNum = $value[1];
                                $Relationship = $value[2];
                                $Email = $value[3];
                                $Others = $value[4];
                                if($Others == "on"){
                                    ?>
                                    <div class="col-xs-4">
                                        <p>Available upon request.</p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="col-xs-4">
                                        <p><?php echo $Name; ?></p>
                                        <p><?php echo $Relationship; ?></p>
                                        <p><?php echo $PhoneNum; ?></p>
                                        <p><?php echo $Email; ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>
        </div>
        <!-- End of Print -->
    </div>

    <div class="hr4" style="margin-top:20px;margin-bottom:30px;"></div>
</div>
<!-- End Content -->
<script type="text/javascript" src="../../js/script.js"></script>
<script language="javascript">
    function printdiv(printpage) {
        var headstr = "<html><head><title></title></head><body>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr + newstr + footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }
</script>
</body>
</html>