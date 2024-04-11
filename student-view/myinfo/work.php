<?php
include('../../connection.php');
session_start();
include('../../common-functions.php');
include('../../encryption.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$num = rand(0, 9999);
$hashStudentID = encrypt_decrypt_plusTime('encrypt', $StudentID, $num);

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse, Objectives FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$FirstName = $infoquery[0][0];
$LastName = $infoquery[0][1];
$MajorCourse = $infoquery[0][2];
$StudentName = $FirstName . " " . $LastName;
$Objectives = $infoquery[0][3];

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
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Work</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content=" - Responsive HTML5 Template">

    <link rel="shortcut icon" href="../../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="../../css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script type="text/javascript" src="../../js/bootstrapValidator.min.js"></script>

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

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../../css/checkbox.css" media="screen"/>

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
                            <li>Course: <b><?php echo $MajorCourse; ?></b></li>
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
                        <div class="col-md-15">
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
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
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
                                <li><a class="active" href="work.php"><?php echo $nWorkXP; ?> Work</a></li>
                                <li><a href="education.php"><?php echo $nSchool; ?> Education</a></li>
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
                        <li><a class="active" href="work.php">Work</a></li>
                        <li><a href="education.php">Education</a></li>
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
                    <h2>Work</h2>
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
                <form method="POST" action="addfunction.php" autocomplete="off">
                    <div class="col-md-9 page-content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Single Testimonial -->
                                <div class="classic-testimonials">
                                    <div class="testimonial-content">
                                        <label>Objectives <span>(*)</span></label>
                                        <textarea class="form-control" id="Objective" name="Objective" rows="7" maxlength="300" required><?php echo htmlspecialchars($Objectives); ?></textarea>
                                        <div id="textarea_feedback"></div>
                                    </div>
                                    <div class="testimonial-author">
                                        <button type="submit" class="btn-system btn-large" name="btnSave" style="float:right;">Save</button>
                                    </div>
                                </div>
                                <!-- End Single Testimonial -->
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Page Content -->

                <!--Sidebar-->
                <div class="col-md-3 sidebar right-sidebar">
                    <!-- Search Widget -->
                    <div class="call-action call-action-boxed call-action-style2 clearfix">
                        <label><span>TIP:</span> A resume <span class="accent-color">objective</span> is a short, targeted statement that clearly outlines your career direction while simultaneously positioning you as someone who fits what the employer is looking for exactly. Your objective is
                            carefully researched and tailored to fit the job you’re applying for.</label>
                    </div>
                </div>
                <!--End sidebar-->
            </div>
            <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Work Experiences<span class="head-line"></span></h4>
                </div>
                <div class="col-md-6">
                    <a class="main-button" style="float:right;cursor:pointer;" data-toggle="modal"
                       data-target="#AddWork">
                        <span class=""> Add Work Experience</span>
                    </a>
                </div>
            </div>

            <!-- ADD Work Ex Modal -->
            <form id="FormAdd" name="FormAdd" autocomplete="off" action="myinfoadd.php" method="POST">
                <div class="modal fade" id="AddWork" role="dialog">
                    <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Work Experience</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Name <span>(*)</span></label>
                                            <input type="text" class="form-control" id="CompanyName" name="CompanyName">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address <span>(*)</span></label>
                                            <input type="text" class="form-control" id="CompanyAddress" name="CompanyAddress">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry <span>(*)</span></label>
                                            <select id="Industry" name="Industry" class="form-control"
                                                    style="width:100%; height:34px;">
                                                <option value="">- Please select one -</option>
                                                <?php
                                                $industry_tbl =
                                                    GSecureSQL::query(
                                                        "SELECT * FROM listofindustrytbl",
                                                        TRUE
                                                    );
                                                foreach ($industry_tbl as $value) {
                                                    $IndustryID = $value[0];
                                                    $Industry = $value[1];
                                                    ?>
                                                    <option value="<?php echo $Industry; ?>"><?php echo $Industry; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Duration</label><br>
                                            <label><input type="checkbox" name="Duration" id="Duration" checked="checked"> Currently Work Here</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>From <span>(*)</span></label>
                                            <select id="FromMonth" name="FromMonth" class="form-control"
                                                    style="width:100%; height:34px;">
                                                <option value="">- Select Month -</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select id="FromYear" name="FromYear" class="form-control"
                                                    style="width:100%; height:34px;">
                                                <option value="">- Select Year -</option>
                                                <?php
                                                $date = Date("Y") + 1;
                                                while ($date != 1935) {
                                                    $date--;
                                                    echo "<option value=\"$date\"> $date</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="ToDuration">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To <span>(*)</span></label>
                                                <select id="ToMonth" name="ToMonth" class="form-control" style="width:100%; height:34px;">
                                                    <option value="">- Select Month -</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <select id="ToYear" name="ToYear" class="form-control"
                                                        style="width:100%; height:34px;">
                                                    <option value="">- Select Year -</option>
                                                    <?php
                                                    $date = Date("Y") + 1;
                                                    while ($date != 1935) {
                                                        $date--;
                                                        echo "<option value='$date'> $date</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Position Level <span>(*)</span></label>
                                            <select id="PositionLevel" name="PositionLevel" class="form-control">
                                                <option value="">- Select Position Level -</option>
                                                <?php
                                                $position_tbl =
                                                    GSecureSQL::query(
                                                        "SELECT * FROM listofpositiontbl",
                                                        TRUE
                                                    );
                                                foreach ($position_tbl as $value) {
                                                    $PositionID = $value[0];
                                                    $Position = $value[1];
                                                    ?>
                                                    <option value="<?php echo $Position; ?>"><?php echo $Position; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Specialization <span>(*)</span></label>
                                            <select id="WorkSpecialization" name="WorkSpecialization" class="form-control"
                                                    style="width:100%; height:34px;">
                                                <option value="">- Select Specialization -</option>
                                                <?php
                                                $specialization_tbl =
                                                    GSecureSQL::query(
                                                        "SELECT * FROM listofspecializationtbl",
                                                        TRUE
                                                    );
                                                $count = 0;
                                                foreach ($specialization_tbl as $value) {
                                                    $SpecializationID = $value[0];
                                                    $Specialization = $value[1];
                                                    $count++;
                                                    ?>
                                                    <option
                                                        value="<?php echo $Specialization; ?>"><?php echo $Specialization; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Monthly Salary <span>(*)</span></label><br>
                                            <select id="MonthlySalary" name="MonthlySalary" class="form-control"
                                                    style="width:100%; height:34px;">
                                                <option value="">- Select Monthly Salary -</option>
                                                <?php
                                                $salaryrange_tbl =
                                                    GSecureSQL::query(
                                                        "SELECT * FROM listofsalaryrangetbl",
                                                        TRUE
                                                    );
                                                foreach ($salaryrange_tbl as $value) {
                                                    $SalaryID = $value[0];
                                                    $Salary = $value[1];
                                                    ?>
                                                    <option value="<?php echo $Salary; ?>"><?php echo $Salary; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nature of Work</label><br>
                                        <textarea class="form-control" id="NatureOfWork" name="NatureOfWork"
                                                  rows="5" maxlength="150"></textarea>
                                            <div id="textarea_feedback"></div>
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

            <div class="hr2" style="margin-top:35px;"></div>
            <table class="table segment table-hover">
                <thead>
                <tr>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Industry</th>
                    <th>Specialization</th>
                    <th>From - To</th>
                    <th width="15%">&nbsp;</th>
                </tr>
                </thead>
                <?php
                $workexperience_tbl =
                    GSecureSQL::query(
                        "SELECT * FROM workexperiencetbl WHERE StudentID = ? ORDER BY DateToYear DESC",
                        TRUE,
                        "s",
                        $StudentID
                    );
                foreach ($workexperience_tbl as $value) {
                    $WorkID = $value[0];
                    $CompanyName = $value[2];
                    $CompanyWebsite = $value[3];
                    $CompanyIndustry = $value[4];
                    $WorkSpecialization = $value[5];
                    $DateFromMonth = $value[6];
                    $DateFromYear = $value[7];
                    $DateToMonth = $value[8];
                    $DateToYear = $value[9];
                    $PositionLevel = $value[11];
                    $MonthlySalary = $value[12];
                    $NatureOfWork = $value[10];
                    $CompanyAddress = $value[14];

                    $WorkIDenc = encrypt_decrypt('encrypt', $WorkID);

                    $specialization_tbl =
                        GSecureSQL::query(
                            "SELECT Specialization FROM listofspecializationtbl WHERE id = ?",
                            TRUE,
                            "s",
                            $WorkSpecialization
                        );
                    $FromMonth = $DateFromMonth;
                    $ToMonth = $DateToMonth;

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
                    $Duration = $DateFromMonth . " " . $DateFromYear . " - " . $DateToMonth . " " . $DateToYear;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $CompanyName; ?></td>
                        <td><?php echo $PositionLevel; ?></td>
                        <td><?php echo $CompanyIndustry; ?></td>
                        <td><?php echo $WorkSpecialization; ?></td>
                        <td><?php echo $Duration; ?></td>
                        <td class="text-center">
                            <button class="btn btn-default" data-toggle="modal"
                                    data-target="#EditWork<?php echo $WorkID; ?>">
                                <i class="fa fa-pencil-square-o fa-1x"></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#DeleteWork<?php echo $WorkID; ?>">
                                <i class="fa fa-trash fa-1x"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- EDIT Work Ex Modal -->
                    <form id="FormEdit<?php echo $WorkID; ?>" name="FormEdit<?php echo $WorkID; ?>" autocomplete="off" action="myinfoedit.php" method="POST">
                        <div class="modal fade" id="EditWork<?php echo $WorkID; ?>" role="dialog">
                            <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Work Experience</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Name <span>(*)</span></label>
                                                    <input type="text" class="form-control" id="EditCompanyName" name="EditCompanyName" value="<?php echo $CompanyName; ?>">
                                                    <input type="hidden" name="EditWorkID" value="<?php echo $WorkIDenc; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" id="EditCompanyAddress" name="EditCompanyAddress" value="<?php echo $CompanyAddress; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Industry <span>(*)</span></label>
                                                    <select id="EditIndustry" name="EditIndustry" class="form-control"
                                                            style="width:100%; height:34px;">
                                                        <option value="">- Please select one -</option>
                                                        <?php
                                                        $industry_tbl =
                                                            GSecureSQL::query(
                                                                "SELECT * FROM listofindustrytbl",
                                                                TRUE
                                                            );
                                                        foreach ($industry_tbl as $value0) {
                                                            $IndustryID = $value0[0];
                                                            $Industry = $value0[1];
                                                            ?>
                                                            <option <?php if ($Industry == $CompanyIndustry) echo "selected='selected'"; ?> value="<?php echo $Industry; ?>"><?php echo $Industry; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Duration</label><br>
                                                    <label><input type="checkbox" name="EditDuration" id="EditDuration<?php echo $WorkID; ?>" <?php if ($DateToYear == "Current") { echo "checked='checked'"; } ?>> Currently Work Here</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>From <span>(*)</span></label>
                                                    <select id="EditFromMonth" name="EditFromMonth" class="form-control"
                                                            style="width:100%; height:34px;">
                                                        <option value="">- Select Month -</option>
                                                        <option <?php if ($FromMonth == "01") echo "selected='selected'"; ?> value="01">January</option>
                                                        <option <?php if ($FromMonth == "02") echo "selected='selected'"; ?> value="02">February</option>
                                                        <option <?php if ($FromMonth == "03") echo "selected='selected'"; ?> value="03">March</option>
                                                        <option <?php if ($FromMonth == "04") echo "selected='selected'"; ?> value="04">April</option>
                                                        <option <?php if ($FromMonth == "05") echo "selected='selected'"; ?> value="05">May</option>
                                                        <option <?php if ($FromMonth == "06") echo "selected='selected'"; ?> value="06">June</option>
                                                        <option <?php if ($FromMonth == "07") echo "selected='selected'"; ?> value="07">July</option>
                                                        <option <?php if ($FromMonth == "08") echo "selected='selected'"; ?> value="08">August</option>
                                                        <option <?php if ($FromMonth == "09") echo "selected='selected'"; ?> value="09">September</option>
                                                        <option <?php if ($FromMonth == "10") echo "selected='selected'"; ?> value="10">October</option>
                                                        <option <?php if ($FromMonth == "11") echo "selected='selected'"; ?> value="11">November</option>
                                                        <option <?php if ($FromMonth == "12") echo "selected='selected'"; ?> value="12">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <select id="EditFromYear" name="EditFromYear" class="form-control"
                                                            style="width:100%; height:34px;">
                                                        <option value="">- Select Year -</option>
                                                        <?php
                                                        $date = Date("Y") + 1;
                                                        while ($date != 1935) {
                                                            $date--;
                                                            ?>
                                                            <option <?php if ($DateFromYear == $date) echo "selected='selected'"; ?> value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="EditToDuration<?php echo $WorkID; ?>">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>To <span>(*)</span></label>
                                                        <select id="EditToMonth<?php echo $WorkID; ?>" name="EditToMonth" class="form-control" style="width:100%; height:34px;">
                                                            <option value="">- Select Month -</option>
                                                            <option <?php if ($ToMonth == "01") echo "selected='selected'"; ?> value="01">January</option>
                                                            <option <?php if ($ToMonth == "02") echo "selected='selected'"; ?> value="02">February</option>
                                                            <option <?php if ($ToMonth == "03") echo "selected='selected'"; ?> value="03">March</option>
                                                            <option <?php if ($ToMonth == "04") echo "selected='selected'"; ?> value="04">April</option>
                                                            <option <?php if ($ToMonth == "05") echo "selected='selected'"; ?> value="05">May</option>
                                                            <option <?php if ($ToMonth == "06") echo "selected='selected'"; ?> value="06">June</option>
                                                            <option <?php if ($ToMonth == "07") echo "selected='selected'"; ?> value="07">July</option>
                                                            <option <?php if ($ToMonth == "08") echo "selected='selected'"; ?> value="08">August</option>
                                                            <option <?php if ($ToMonth == "09") echo "selected='selected'"; ?> value="09">September</option>
                                                            <option <?php if ($ToMonth == "10") echo "selected='selected'"; ?> value="10">October</option>
                                                            <option <?php if ($ToMonth == "11") echo "selected='selected'"; ?> value="11">November</option>
                                                            <option <?php if ($ToMonth == "12") echo "selected='selected'"; ?> value="12">December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <select id="EditToYear<?php echo $WorkID; ?>" name="EditToYear" class="form-control"
                                                                style="width:100%; height:34px;">
                                                            <option value="">- Select Year -</option>
                                                            <?php
                                                            $date = Date("Y") + 1;
                                                            while ($date != 1935) {
                                                                $date--;
                                                                ?>
                                                                <option <?php if ($DateToYear == $date) echo "selected='selected'"; ?> value="<?php echo $date; ?>"> <?php echo $date; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Position Level <span>(*)</span></label>
                                                    <select id="EditPositionLevel" name="EditPositionLevel" class="form-control">
                                                        <option value="">- Select Position Level -</option>
                                                        <?php
                                                        $position_tbl =
                                                            GSecureSQL::query(
                                                                "SELECT * FROM listofpositiontbl",
                                                                TRUE
                                                            );
                                                        foreach ($position_tbl as $value1) {
                                                            $PositionID = $value1[0];
                                                            $Position = $value1[1];
                                                            ?>
                                                            <option <?php if ($PositionLevel == $Position) echo "selected='selected'"; ?> value="<?php echo $Position; ?>"><?php echo $Position; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Specialization <span>(*)</span></label>
                                                    <select id="EditWorkSpecialization" name="EditWorkSpecialization" class="form-control"
                                                            style="width:100%; height:34px;">
                                                        <option value="">- Select Specialization -</option>
                                                        <?php
                                                        $specialization_tbl =
                                                            GSecureSQL::query(
                                                                "SELECT * FROM listofspecializationtbl",
                                                                TRUE
                                                            );
                                                        $count = 0;
                                                        foreach ($specialization_tbl as $value2) {
                                                            $SpecializationID = $value2[0];
                                                            $Specialization = $value2[1];
                                                            $count++;
                                                            ?>
                                                            <option <?php if ($WorkSpecialization == $Specialization) echo "selected='selected'"; ?> value="<?php echo $Specialization; ?>"><?php echo $Specialization; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Monthly Salary</label><br>
                                                    <select id="EditMonthlySalary" name="EditMonthlySalary" class="form-control"
                                                            style="width:100%; height:34px;">
                                                        <option value="">- Select Monthly Salary -</option>
                                                        <?php
                                                        $salaryrange_tbl =
                                                            GSecureSQL::query(
                                                                "SELECT * FROM listofsalaryrangetbl",
                                                                TRUE
                                                            );
                                                        foreach ($salaryrange_tbl as $value4) {
                                                            $SalaryID = $value4[0];
                                                            $Salary = $value4[1];
                                                            ?>
                                                            <option <?php if ($MonthlySalary == $Salary) echo "selected='selected'"; ?> value="<?php echo $Salary; ?>"><?php echo $Salary; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nature of Work</label><br>
                                                    <textarea class="form-control" id="EditNatureOfWork" name="EditNatureOfWork" rows="5" maxlength="150" placeholder="Description of your work."><?php echo $NatureOfWork; ?></textarea>
                                                    <div id="textarea_feedback"></div>
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
                    <!-- End edit modal -->

                    <script type="text/javascript">
                        $(document).ready(function () {
                            var validator = $("#EditWork<?php echo $WorkID; ?>").bootstrapValidator({
                                feedbackIcons: {
                                    valid: "glyphicon glyphicon-ok",
                                    invalid: "glyphicon glyphicon-remove",
                                    validating: "glyphicon glyphicon-refresh"
                                },
                                fields: {
                                    EditCompanyName: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditCompanyAddress: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditIndustry: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditFromMonth: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditFromYear: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditToMonth: {

                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditToYear: {

                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            },
                                            greaterThan: {
                                                value: "EditFromYear",
                                                message: "Invalid date."
                                            }
                                        }
                                    },
                                    EditPositionLevel: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditWorkSpecialization: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    },
                                    EditMonthlySalary: {
                                        validators: {
                                            notEmpty: {
                                                message: "This is required."
                                            }
                                        }
                                    }
                                }
                            });
                            $('#EditDuration<?php echo $WorkID; ?>').click(function () {
                                $("#EditToMonth<?php echo $WorkID; ?>").val("");
                                $("#EditToYear<?php echo $WorkID; ?>").val("");
                                if ($(this).is(':checked')) {
                                    $('#EditToDuration<?php echo $WorkID; ?>').hide();
                                } else {
                                    $('#EditToDuration<?php echo $WorkID; ?>').show();
                                }
                            });

                            if ($('#EditDuration<?php echo $WorkID; ?>').is(':checked')) {
                                $('#EditToDuration<?php echo $WorkID; ?>').hide();
                            } else {
                                $('#EditToDuration<?php echo $WorkID; ?>').show();
                            }

                            $("#EditFromYear<?php echo $WorkID; ?>").change(function () {
                                var from_year = $("#EditFromYear<?php echo $WorkID; ?>").val();
                                var to_year = $("#EditToYear<?php echo $WorkID; ?>").val();

                                if (from_year > to_year) {
                                    $("#EditToYear<?php echo $WorkID; ?>").val(from_year);
                                    $("#EditToYear<?php echo $WorkID; ?>").parent().removeClass("has-error");
                                    $("#EditToYear<?php echo $WorkID; ?>").parent().addClass("has-success");
                                    $($("#EditToYear<?php echo $WorkID; ?>").parent().find(".form-control-feedback")).removeClass("glyphicon-remove");
                                    $($("#EditToYear<?php echo $WorkID; ?>").parent().find(".form-control-feedback")).addClass("glyphicon-ok");
                                    $($("#EditToYear<?php echo $WorkID; ?>").parent().find(".help-block")).css("display", "none");
                                }
                            });
                        });
                    </script>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="DeleteWork<?php echo $WorkID; ?>" role="dialog">
                        <div class="modal-dialog" style="padding:100px">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete?</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-15">
                                        <label = "usr" class = "control-label">Do you want to delete
                                        this information? This cannot be undone.</label>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="delete.php?Delete_WorkID=<?php echo $WorkIDenc; ?>"
                                           class="btn btn-danger">Delete</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    </tbody>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- End Content -->
<script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var text_max = 300;
        $(window).load(function () {
            var text_length = $('#Objective').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining.');
        });

        $('#textarea_feedback').html(text_max + ' characters remaining.');

        $('#Objective').keyup(function () {
            var text_length = $('#Objective').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining.');
        });
    });


    $('#Duration').click(function () {
        $("#ToMonth").val("");
        $("#ToYear").val("");
        if ($(this).is(':checked')) {
            $('#ToDuration').hide();
        } else {
            $('#ToDuration').show();
        }
    });

    if ($('#Duration').is(':checked')) {
        $('#ToDuration').hide();
    } else {
        $('#ToDuration').show();
    }


    $('#AddWork').on('shown.bs.modal', function () {
        $('#CompanyName').focus();
    });

    $(document).ready(function () {
        var text_max = 150;
        $('#textarea_feedback').html(text_max + ' characters remaining.');

        $('#NatureOfWork').keyup(function () {
            var text_length = $('#NatureOfWork').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining.');
        });
    });


    //Add Validator
    $(document).ready(function () {
        var validator = $("#FormAdd").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                CompanyName: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                CompanyAddress: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                Industry: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                FromMonth: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                FromYear: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                ToMonth: {
                    required: "#Duration:checked",
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                ToYear: {
                    required: "#Duration:checked",
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        },
                        greaterThan: {
                            value: "FromYear",
                            message: "Invalid date."
                        }
                    }
                },
                PositionLevel: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                WorkSpecialization: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                MonthlySalary: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                }
            }
        });
        $("#FromYear").change(function () {
            var from_year = $("#FromYear").val();
            var to_year = $("#ToYear").val();

            if (from_year > to_year) {
                $("#ToYear").val(from_year);
                $("#ToYear").parent().removeClass("has-error");
                $("#ToYear").parent().addClass("has-success");
                $($("#ToYear").parent().find(".form-control-feedback")).removeClass("glyphicon-remove");
                $($("#ToYear").parent().find(".form-control-feedback")).addClass("glyphicon-ok");
                $($("#ToYear").parent().find(".help-block")).css("display", "none");
            }
        });
    });
</script>