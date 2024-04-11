<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; 

$num = rand(0,9999);
$hashStudentID = encrypt_decrypt_plusTime('encrypt', $StudentID, $num);

if (isset($_SESSION['StudentID'])) {
    $StudentID = $_SESSION['StudentID'];
} else {
    header("location: ../../login-student.php");
}

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$FirstName = $infoquery[0][0];
$LastName = $infoquery[0][1];
$MajorCourse = $infoquery[0][2];
$StudentName = $FirstName . " " . $LastName;

$course_qry =
    GSecureSQL::query(
        "SELECT CourseTitle FROM coursetbl WHERE CourseCode = ?",
        TRUE,
        "s",
        $MajorCourse
    );
$MajorCourse = $course_qry[0][0];

$progress_tbl =
    GSecureSQL::query(
        "SELECT
        Pinfo,
        Cinfo,
        Objective,
        WorkXP,
        School,
        Certification,
        Achievements,
        Specialization,
        Languages,
        _References
        FROM progresstbl
        WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$nPinfo = "*";
$nCinfo = "*";
$nObjective = "*";
$nWorkXP = "*";
$nSchool = "*";
$nCertification = "*";
$nAchievements = "*";
$nSpecialization = "*";
$nLanguages = "*";
$nReferences = "*";

$Progress = 10;
$Pinfo = $progress_tbl[0][0];
$Cinfo = $progress_tbl[0][1];
$Objective = $progress_tbl[0][2];
$WorkXP = $progress_tbl[0][3];
$School = $progress_tbl[0][4];
$Certification = $progress_tbl[0][5];
$Achievements = $progress_tbl[0][6];
$Specialization = $progress_tbl[0][7];
$Languages = $progress_tbl[0][8];
$References = $progress_tbl[0][9];

if ($Pinfo == "ok") {
    $Progress = $Progress + 10;
    $nPinfo = "";
}
if ($Cinfo == "ok") {
    $Progress = $Progress + 10;
    $nCinfo = "";
}
if ($Objective == "ok") {
    $Progress = $Progress + 15;
    $nWorkXP = "";
}
if ($School == "ok") {
    $Progress = $Progress + 5;
    $nSchool = "";
}
if ($Certification == "ok") {
    $Progress = $Progress + 10;
    $nCertification = "";
}
if ($Achievements == "ok") {
    $Progress = $Progress + 10;
    $nAchievements = "";
}
if ($Specialization == "ok") {
    $Progress = $Progress + 10;
    if ($Languages == "ok" && $Specialization == "ok") {
        $nSpecialization = "";
    }
}
if ($Languages == "ok") {
    $Progress = $Progress + 5;
    if ($Languages == "ok" && $Specialization == "ok") {
        $nSpecialization = "";
    }

}
if ($References == "ok") {
    $Progress = $Progress + 10;
    $nReferences = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Education</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="PlacementCell">

    <link rel="shortcut icon" href="../../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../../css/bootstrapValidator.min.css" rel="stylesheet"/>
    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

    <!-- BootstrapValidator -->
    <script src="../../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/animate.css" media="screen">

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

    <!-- Notification -->
    <link rel="stylesheet" href="../../css/notif.css"/>

    <?php
    $Countnotification =
        GSecureSQL::query(
            "SELECT COUNT(*) FROM studnotificationtbl WHERE StudentID = ? AND Seen = 0",
            TRUE,
            "s",
            $StudentID
        );

    $Notif_Count = $Countnotification[0][0];
    if ($Notif_Count == 0) {
        ?>
        <script type="text/javascript">
            $(window).load(function () {
                $("#notification_count").hide();
            });
        </script>
        <?php
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#notificationLink").click(function () {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                return false;
            });

            $("#notif").click(function () {
                $.ajax({
                    type: "POST",
                    url: 'function_notif.php'
                });
            });

            //Document Click
            $(document).click(function () {
                $("#notificationContainer").hide();
            });
            //Popup Click
            $("#notificationContainer").click(function () {
                return false
            });
        });
    </script>
</head>

<body>
<div id="container">
    <!-- Start Header Section -->
    <div class="hidden-header"></div>
    <header class="clearfix">
        <!-- Start Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- Start Contact Info -->
                        <ul class="profile-name">
                            <li>Course: </i> <b><?php echo $MajorCourse; ?></b></li>
                        </ul>
                        <!-- End Contact Info -->
                    </div>
                    <!-- .col-md-6 -->
                    <div class="col-md-5">
                        <!-- Start Social Links -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown icon-border" id="notificationLink">
                                <span id="notification_count"><?php echo $Notif_Count; ?></span>
                                <a id="notif" href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i class="fa fa-bell"></i></a>
                                <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                    <li class="dropdown-header"><label>Notification</label></li>
                                    <?php
                                    $NotificationContent =
                                        GSecureSQL::query(
                                            "SELECT Message,_From,_Date FROM studnotificationtbl WHERE StudentID = ? ORDER BY Time ASC LIMIT 10",
                                            TRUE,
                                            "s",
                                            $StudentID
                                        );
                                    foreach ($NotificationContent as $value) {
                                        $Message = $value[0];
                                        $From = $value[1];
                                        $Date = $value[2];
                                        ?>
                                        <li><a tabindex="-1"><b><?php echo $From; ?>: </b><?php echo $Message; ?></a></li>
                                        <?php
                                    }
                                    ?>

                                    <li class="divider"></li>
                                    <li><a href="wala pa to e" tabindex="-1">See All</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b> Welcome, <b><?php echo $StudentName; ?> </b><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a href="../../student-profile.php?id=<?php echo $hashStudentID; ?>&n=<?php echo $num; ?>">Profile <b class="fa fa-user" style="float:right;"></b></a></li> -->
                                    <li><a href="../settings/settings.php">Settings <b class="fa fa-cog" style="float:right;"></b></a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b class="fa fa-sign-out" style="float:right;"></b></a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- End Social Links -->
                    </div>
                    <!-- .col-md-6 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- .top-bar -->
        <!-- End Top Bar -->

        <!-- Modal -->
        <div class="modal fade" id="Logout" role="dialog">
            <div class="modal-dialog" style="padding:100px">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sign Out</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-15 fieldcol">
                            <label>Do you want to sign out?</label>
                        </div>
                        <div class="modal-footer">
                            <a href="../logout.php"
                               class="btn btn-primary">Sign Out</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start  Logo & Naviagtion  -->
        <div class="navbar navbar-default navbar-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- End Toggle Nav Link For Mobiles -->
                    <a class="navbar-brand">
                        <img src="../../images/PlacementCell.png">
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Start Navigation List -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="active" href="personal-info.php">My Info</a>
                            <ul class="dropdown">
                                <li><a href="personal-info.php"><?php echo $nPinfo; ?> Personal Info</a></li>
                                <li><a href="contacts-info.php"><?php echo $nCinfo; ?> Contacts Info</a></li>
                                <li><a href="work.php"><?php echo $nWorkXP; ?> Work</a></li>
                                <li><a class="active" href="education.php"><?php echo $nSchool; ?> Education</a></li>
                                <li><a href="certifications.php"><?php echo $nCertification; ?> Certifications</a></li>
                                <li><a href="achievements.php"><?php echo $nAchievements; ?> Achievements</a></li>
                                <li><a href="skills-and-languages.php"><?php echo $nSpecialization; ?> Skills & Languages</a></li>
                                <li><a href="references.php"><?php echo $nReferences; ?> References</a></li>
                                <li><a href="portfolio.php">Portfolio</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../resume/print.php">Print</a>
                        </li>
                        <li>
                            <a href="../applications/applications.php">Applications</a>
                        </li>
                        <li>
                            <a href="../search-job/jobs.php">Jobs</a>
                        </li>
                    </ul>
                    <!-- End Navigation List -->
                </div>
            </div>
            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">
                <li>
                    <a class="active" href="personal-info.php">My Info</a>
                    <ul class="dropdown">
                        <li><a href="personal-info.php">Personal Info</a></li>
                        <li><a href="contacts-info.php">Contacts Info</a></li>
                        <li><a href="work.php">Work</a></li>
                        <li><a class="active" href="education.php">Education</a></li>
                        <li><a href="certifications.php">Certifications</a></li>
                        <li><a href="achievements.php">Achievements</a></li>
                        <li><a href="skills-and-languages.php">Skills & Languages</a></li>
                        <li><a href="references.php">References</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../resume/resume.php">Resumé</a>
                    <ul class="dropdown">
                        <li><a href="../resume/resume.php">Resumé</a></li>
                        <li><a href="../resume/background.php">Background</a></li>
                        <li><a href="../resume/print.php">Print</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../applications/applications.php">Applications</a>
                </li>
                <li>
                    <a href="../search-job/jobs.php">Jobs</a>
                </li>
            </ul>
            <!-- Mobile Menu End -->
        </div>
    </header>

    <div class="page-banner no-subtitle">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Education</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <?php
            if (isset($_GET['saved'])) {
                echo '
                        <div class="alert alert-success fade in" id="success-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-info-circle"></span> Information successfully updated.</strong>
                        </div>
                        ';
            }
            if (isset($_GET['error'])) {
                echo '
                        <div class="alert alert-danger fade in" id="danger-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-warning"></span> Some errors occured, Please try again.</strong>
                        </div>
                        ';
            }
            ?>
            <script type="text/javascript">
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function () {
                    $("#success-alert").alert('close');
                });
            </script>

            <label><span class="fa fa-check-circle"></span> Your information progress..</label>
            <div class="skill-shortcode">
                <div class="skill">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" data-percentage="<?php echo $Progress; ?>" style="width: <?php echo $Progress; ?>%;">
                            <span class="progress-bar-span"><?php echo $Progress; ?>%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row sidebar-page">
                <!-- Page Content -->
                <div class="col-md-12 page-content">
                    <div class="classic-testimonials">
                        <!-- Single Testimonial -->
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Schools<span class="head-line"></span></h4>
                            </div>
                            <div class="col-md-6">
                                <a class="main-button" style="float:right;cursor:pointer;" data-toggle="modal" data-target="#AddSchool">
                                    <span>Add School</span>
                                </a>
                            </div>
                        </div>

                        <!-- ADD School Modal -->
                        <form id="FormAdd" name="FormAdd" autocomplete="off" action="myinfoadd.php" method="POST">
                            <div class="modal fade" id="AddSchool" role="dialog">
                                <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add School</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>School <span>(*)</span></label>
                                                        <input type="text" class="form-control" id="School" name="School" style="height:34px;" autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Educational Attainment <span>(*)</span></label>
                                                        <select id="EducAttainment" name="EducAttainment" class="form-control" style="width:100%; height:34px;">
                                                            <option value="">- Please select one -</option>
                                                            <option value="SSLC">Diploma</option>
                                                            <option value="Plus Two">Plus Two</option>
                                                            <option value="UG">U.G</option>
                                                            <option value="PG">P.G</option>
                                                            <option value="Doctorate">Doctorate Degree</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label id="lblCourse">Course <span>(*)</span></label>
                                                        <select id="Course" name="Course" class="form-control" style="width:100%; height:34px;">
                                                            <option value="">- Course -</option>
                                                            <?php
                                                            $course_tbl =
                                                                GSecureSQL::query(
                                                                    "SELECT * FROM coursetbl",
                                                                    TRUE
                                                                );
                                                            foreach ($course_tbl as $value) {
                                                                $CourseCode = $value[2];
                                                                $CourseTitle = $value[1];
                                                                ?>
                                                                <option value="<?php echo $CourseCode; ?>"><?php echo $CourseTitle; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <option value="other">others</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" class="form-control" id="txtCourse" name="txtCourse" style="height:34px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Year Covered <span>(*)</span>:</label>
                                                </div>
                                                <div class="col-md-6">&nbsp;</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <select id="GraduatedYearFrom" name="GraduatedYearFrom" class="form-control" style="width:100%; height:34px;">
                                                            <option value="">- Year -</option>
                                                            <?php
                                                            $date = Date("Y") + 1;
                                                            while ($date != 1935) {
                                                                $date--;
                                                                ?>
                                                                <option value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>To</label>
                                                        <select id="GraduatedYearTo" name="GraduatedYearTo" class="form-control" style="width:100%; height:34px;">
                                                            <option value="">- Year -</option>
                                                            <?php
                                                            $date = Date("Y") + 1;
                                                            while ($date != 1935) {
                                                                $date--;
                                                                ?>
                                                                <option value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn-system btn-large">Add</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end Add Modal -->

                        <div class="hr2" style="margin-top:35px;"></div>
                        <table class="table segment table-hover">
                            <thead>
                            <tr>
                                <th>School</th>
                                <th>Attainment</th>
                                <th>Course</th>
                                <th width="15%">Year Covered</th>
                                <th width="15%">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $school_tbl =
                                GSecureSQL::query(
                                    "SELECT * FROM schooltbl WHERE StudentID = ? AND _Default = 1",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );
                            foreach ($school_tbl as $value) {
                                $SchoolID = $value[0];
                                $School = $value[2];
                                $Attainment = $value[3];
                                $Course = $value[4];
                                $Graduated = $value[5];

                                $_month = substr($Graduated, 0,2);

                                if($_month == 01){
                                    $Graduated = "January" . substr($Graduated, 2);
                                }elseif($_month == 02){
                                    $Graduated = "February" . substr($Graduated, 2);
                                }elseif($_month == 03){
                                    $Graduated = "March" . substr($Graduated, 2);
                                }elseif($_month == 04){
                                    $Graduated = "April" . substr($Graduated, 2);
                                }elseif($_month == 05){
                                    $Graduated = "May" . substr($Graduated, 2);
                                }elseif($_month == 06){
                                    $Graduated = "June" . substr($Graduated, 2);
                                }elseif($_month == 07){
                                    $Graduated = "July" . substr($Graduated, 2);
                                }elseif($_month == 08){
                                    $Graduated = "August" . substr($Graduated, 2);
                                }elseif($_month == 09){
                                    $Graduated = "September" . substr($Graduated, 2);
                                }elseif($_month == 10){
                                    $Graduated = "October" . substr($Graduated, 2);
                                }elseif($_month == 11){
                                    $Graduated = "November" . substr($Graduated, 2);
                                }elseif($_month == 12){
                                    $Graduated = "December" . substr($Graduated, 2);
                                }

                                $course_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM coursetbl WHERE CourseID = ?",
                                        TRUE,
                                        "s",
                                        $Course
                                    );
                                foreach ($course_tbl as $value1) {
                                    $CourseTitle = $value1[1];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $School; ?></td>
                                    <td><?php echo $Attainment; ?></td>
                                    <td><?php echo htmlspecialchars($Course); ?></td>
                                    <td><?php echo $Graduated; ?></td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <?php
                            $_school_tbl =
                                GSecureSQL::query(
                                    "SELECT * FROM schooltbl WHERE StudentID = ? AND _Default = 0",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );
                            foreach ($_school_tbl as $_value) {
                                $_SchoolID = $_value[0];
                                $_School = $_value[2];
                                $_Attainment = $_value[3];
                                $_Course = $_value[4];
                                $_Graduated = $_value[5];

                                $_SchoolIDenc = encrypt_decrypt("encrypt", $_SchoolID);

                                $_course_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM coursetbl WHERE CourseID = ?",
                                        TRUE,
                                        "s",
                                        $_Course
                                    );
                                foreach ($_course_tbl as $_value1) {
                                    $_CourseTitle = $_value1[1];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $_School; ?></td>
                                    <td><?php echo $_Attainment; ?></td>
                                    <td><?php echo htmlspecialchars($_Course); ?></td>
                                    <td><?php echo $_Graduated; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-default" data-toggle="modal"
                                                data-target="#EditSchoolModal<?php echo $_SchoolID; ?>">
                                            <i class="fa fa-pencil-square-o fa-1x"></i>
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#DeleteSchool<?php echo $_SchoolID; ?>">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                </tr>

                                <!-- Edit School Modal -->
                                <form id="EditSchool<?php echo $_SchoolID; ?>" name="EditSchool<?php echo $_SchoolID; ?>" autocomplete="off" action="myinfoedit.php" method="POST">
                                    <div class="modal fade" id="EditSchoolModal<?php echo $_SchoolID; ?>" role="dialog">
                                        <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit School</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>School <span>(*)</span></label>
                                                                <input type="hidden" name="EditSchoolID" value="<?php echo $_SchoolIDenc; ?>">
                                                                <input type="text" class="form-control" id="EditSchool" name="EditSchool" style="height:34px;" value="<?php echo $_School; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Educational Attainment <span>(*)</span></label>
                                                                <select id="EditEducAttainment<?php echo $_SchoolID; ?>" name="EditEducAttainment" class="form-control" style="width:100%; height:34px;">
                                                                    <option value="">- Please select one -</option>
                                                                    <option <?php if ($_Attainment == "High School Diploma") echo "selected='selected'"; ?> value="High School Diploma">High School Diploma</option>
                                                                    <option <?php if ($_Attainment == "Technical Vocational/Certificate") echo "selected='selected'"; ?>value="Technical Vocational/Certificate">Technical Vocational/Certificate</option>
                                                                    <option <?php if ($_Attainment == "Bachelor's/College Degree") echo "selected='selected'"; ?>value="Bachelor's/College Degree">Bachelor's/College Degree</option>
                                                                    <option <?php if ($_Attainment == "Post Graduate Diploma/Master's Degree") echo "selected='selected'"; ?>value="Post Graduate Diploma/Master's Degree">Post Graduate Diploma/Master's Degree</option>
                                                                    <option <?php if ($_Attainment == "Professional License (Passed Board/Bar/Professional License Exam)") echo "selected='selected'"; ?>value="Professional License (Passed Board/Bar/Professional License Exam)">Professional License
                                                                        (Passed Board/Bar/Professional License Exam
                                                                    </option>
                                                                    <option <?php if ($_Attainment == "Doctorate Degree") echo "selected='selected'"; ?>value="Doctorate Degree">Doctorate Degree</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label id="EditlblCourse<?php echo $_SchoolID; ?>">Course <span>(*)</span></label>
                                                                <select id="EditCourse<?php echo $_SchoolID; ?>" name="EditCourse" class="form-control" style="width:100%; height:34px;">
                                                                    <option value="">- Course -</option>
                                                                    <?php
                                                                    $course_tbl =
                                                                        GSecureSQL::query(
                                                                            "SELECT * FROM coursetbl",
                                                                            TRUE
                                                                        );
                                                                    $BCourse = "false";
                                                                    foreach ($course_tbl as $value) {
                                                                        $CourseCode = $value[2];
                                                                        $CourseTitle = $value[1];
                                                                        if ($_Course == $CourseCode) {
                                                                            $BCourse = "true";
                                                                        }
                                                                        ?>
                                                                        <option <?php if ($_Course == $CourseCode) echo "selected='selected'"; ?> value="<?php echo $CourseCode; ?>"><?php echo $CourseTitle; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <option <?php if ($BCourse == "false") echo "selected='selected'"; ?> value="other">others</option>
                                                                </select>
                                                                <br>
                                                                <input type="text" class="form-control" id="EdittxtCourse<?php echo $_SchoolID; ?>" name="EdittxtCourse" style="height:34px;" value="<?php echo htmlspecialchars($_Course); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Year Covered <span>(*)</span>:</label>
                                                        </div>
                                                        <div class="col-md-6">&nbsp;</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <select id="EditGraduatedYearFrom" name="EditGraduatedYearFrom" class="form-control" style="width:100%; height:34px;">
                                                                    <option value="">- Year -</option>
                                                                    <?php
                                                                    $YearFrom = substr($_Graduated, 0, 4);
                                                                    $date = Date("Y") + 1;
                                                                    while ($date != 1935) {
                                                                        $date--;
                                                                        ?>
                                                                        <option <?php if ($YearFrom == $date) echo "selected='selected'"; ?> value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>To</label>
                                                                <select id="EditGraduatedYearTo" name="EditGraduatedYearTo" class="form-control" style="width:100%; height:34px;">
                                                                    <option value="">- Year -</option>
                                                                    <?php
                                                                    $YearTo = substr($_Graduated, 7, 4);
                                                                    $date = Date("Y") + 1;
                                                                    while ($date != 1935) {
                                                                        $date--;
                                                                        ?>
                                                                        <option <?php if ($YearTo == $date) echo "selected='selected'"; ?> value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn-system btn-large">Save</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#EditEducAttainment<?php echo $_SchoolID;?>").change(function () {
                                            $(this).find("option:selected").each(function () {
                                                if ($(this).attr("value") == "High School Diploma") {
                                                    $("#EditCourse<?php echo $_SchoolID;?>").val("");
                                                    $("#EditCourse<?php echo $_SchoolID;?>").hide();
                                                    $("#EdittxtCourse<?php echo $_SchoolID;?>").hide();
                                                    $("#EditlblCourse<?php echo $_SchoolID;?>").hide();
                                                } else {
                                                    $("#EditCourse<?php echo $_SchoolID;?>").show();
                                                    $("#EditlblCourse<?php echo $_SchoolID;?>").show();
                                                }
                                            });
                                        }).change();
                                    });

                                    $(document).ready(function () {
                                        $("#EditCourse<?php echo $_SchoolID;?>").change(function () {
                                            $(this).find("option:selected").each(function () {
                                                if ($(this).attr("value") == "other") {
                                                    $("#EdittxtCourse<?php echo $_SchoolID;?>").show();
                                                } else {
                                                    $("#EdittxtCourse<?php echo $_SchoolID;?>").hide();
                                                }
                                            });
                                        }).change();
                                    });


                                    $(document).ready(function () {
                                        var validator = $("#EditSchoolModal<?php echo $_SchoolID; ?>").bootstrapValidator({
                                            feedbackIcons: {
                                                valid: "glyphicon glyphicon-ok",
                                                invalid: "glyphicon glyphicon-remove",
                                                validating: "glyphicon glyphicon-refresh"
                                            },
                                            excluded: [':disabled', ':hidden', ':not(:visible)', '#container'],
                                            fields: {
                                                EditSchool: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "School is required."
                                                        }
                                                    }
                                                },
                                                EditEducAttainment: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "Educational Attainment is required."
                                                        }
                                                    }
                                                },
                                                EditCourse: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "Course is required."
                                                        }
                                                    }
                                                },
                                                EdittxtCourse: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "Course is required."
                                                        }
                                                    }
                                                },
                                                EditGraduatedYearFrom: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "Month graduated is required."
                                                        }
                                                    }
                                                },
                                                EditGraduatedYearTo: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: "Year graduated is required."
                                                        },
                                                        greaterThan: {
                                                            value: "EditGraduatedYearFrom",
                                                            message: "Invalid date."
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <!-- end Edit Modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="DeleteSchool<?php echo $_SchoolID; ?>" role="dialog">
                                    <div class="modal-dialog" style="padding:100px">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Delete School information?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-15">
                                                    <label = "usr" class = "control-label">Do you want to delete this
                                                    information? This cannot be undone.</label>
                                                    <div class="form-group">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="delete.php?delete_SchoolID=<?php echo $_SchoolID; ?>"
                                                       class="btn btn-danger">Delete</a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>                
                    </div>
                </div>
                <!-- End Page Content -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        $("#EducAttainment").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "SSLC" || $(this).attr("value") == "PLUS TWO"||$(this).attr("value") == "Doctorate") {
                    $("#Course").val("");
                    $("#Course").hide();
                    $("#txtCourse").hide();
                    $("#lblCourse").hide();
                } else {
                    $("#Course").show();
                    $("#lblCourse").show();
                }
            });
        }).change();
    });

    $(document).ready(function () {
        $("#Course").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "other") {
                    $("#txtCourse").val("");
                    $("#txtCourse").show();
                } else {
                    $("#txtCourse").hide();
                }
            });
        }).change();
    });


    $(document).ready(function () {
        var validator = $("#FormAdd").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            excluded: [':disabled', ':hidden', ':not(:visible)', '#container'],
            fields: {
                School: {
                    validators: {
                        notEmpty: {
                            message: "School is required."
                        }
                    }
                },
                EducAttainment: {
                    validators: {
                        notEmpty: {
                            message: "Educational Attainment is required."
                        }
                    }
                },
                Course: {
                    validators: {
                        notEmpty: {
                            message: "Course is required."
                        }
                    }
                },
                txtCourse: {
                    validators: {
                        notEmpty: {
                            message: "Course is required."
                        }
                    }
                },
                GraduatedYearFrom: {
                    validators: {
                        notEmpty: {
                            message: "Month graduated is required."
                        }
                    }
                },
                GraduatedYearTo: {
                    validators: {
                        notEmpty: {
                            message: "Year graduated is required."
                        },
                        greaterThan: {
                            value: "GraduatedYearFrom",
                            message: "Invalid date."
                        }
                    }
                }
            }
        });
    }); 
</script>