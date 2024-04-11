<?php
session_start();
include('../../connection.php');
include('../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

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
    <title>PlacementCell | Applications</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b>
                                        Welcome, <b><?php echo $StudentName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a href="../../student-profile.php">Profile <b class="fa fa-user" style="float:right;"></b></a></li> -->
                                        <li><a href="../settings/settings.php">Settings <b class="fa fa-cog" style="float:right;"></b></a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b
                                                    class="fa fa-sign-out" style="float:right;"></b></a></li>
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
                        <a class="navbar-brand" href="">
                            <img src="../../images/PlacementCell.png">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="../myinfo/personal-info.php">My Info</a>
                                <ul class="dropdown">
                                    <li><a href="../myinfo/personal-info.php"><?php echo $nPinfo; ?> Personal Info</a></li>
                                    <li><a href="../myinfo/contacts-info.php"><?php echo $nCinfo; ?> Contacts Info</a></li>
                                    <li><a href="../myinfo/work.php"><?php echo $nWorkXP; ?> Work</a></li>
                                    <li><a href="../myinfo/education.php"><?php echo $nSchool; ?> Education</a></li>
                                    <li><a href="../myinfo/certifications.php"><?php echo $nCertification; ?>
                                            Certifications</a></li>
                                    <li><a href="../myinfo/achievements.php"><?php echo $nAchievements; ?> Achievements</a>
                                    </li>
                                    <li><a href="../myinfo/skills-and-languages.php"><?php echo $nSpecialization; ?> Skills
                                            & Languages</a></li>
                                    <li><a href="../myinfo/references.php"><?php echo $nReferences; ?> References</a></li>
                                    <li><a href="../myinfo/portfolio.php">Portfolio</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="../resume/print.php">Print</a>
                            </li>
                            <li>
                                <a class="active" href="applications.php">Applications</a>
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
                        <a href="../myinfo/personal-info.php">My Info</a>
                        <ul class="dropdown">
                            <li><a href="../myinfo/personal-info.php"><?php echo $nPinfo; ?> Personal Info</a></li>
                            <li><a href="../myinfo/contacts-info.php"><?php echo $nCinfo; ?> Contacts Info</a></li>
                            <li><a href="../myinfo/work.php"><?php echo $nWorkXP; ?> Work</a></li>
                            <li><a href="../myinfo/education.php"><?php echo $nSchool; ?> Education</a></li>
                            <li><a href="../myinfo/certifications.php"><?php echo $nCertification; ?> Certifications</a>
                            </li>
                            <li><a href="../myinfo/achievements.php"><?php echo $nAchievements; ?> Achievements</a></li>
                            <li><a href="../myinfo/skills-and-languages.php"><?php echo $nSpecialization; ?> Skills &
                                    Languages</a></li>
                            <li><a href="../myinfo/references.php"><?php echo $nReferences; ?> References</a></li>
                            <li><a href="../myinfo/portfolio.php">Portfolio</a></li>
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
                        <a class="active" href="applications.php">Applications</a>
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
                        <h2>Applications</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        if ($id == 1) {
                            echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> Applications successfully deleted.</strong>
                            </div>
                            ';
                        } 
                    }
                ?>
                <div class="hr2"></div>
                <table class="table segment table-hover">
                    <thead>
                        <tr>
                            <th width="20%">Position</th>
                            <th width="20%">Company</th>
                            <th width="20%">Location</th>
                            <th width="10%">Status</th>
                            <th width="15%">Date Submitted</th>
                            <th width="10%">Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $application_tbl =
                        GSecureSQL::query(
                            "SELECT * FROM requesttocompanytbl WHERE StudentID = ?",
                            TRUE,
                            "s",
                            $StudentID
                        );
                    foreach ($application_tbl as $value) {
                        $RID = $value[0];
                        $CompanyID = $value[1];
                        $PositionID = $value[3];
                        $Status = $value[4];
                        $DateSubmitted = $value[5];
                        $_Date = $value[6];

                        $company_tbl =
                            GSecureSQL::query(
                                "SELECT CompanyName, City FROM companyinfotbl WHERE CompanyID = ?",
                                TRUE,
                                "s",
                                $CompanyID
                            );
                        foreach ($company_tbl as $value1) {
                            $CompanyName = $value1[0];
                            $City = $value1[1];
                        }

                        $positiontbl =
                            GSecureSQL::query(
                                "SELECT PositionTitle FROM comppositiontbl WHERE PositionID = ?",
                                TRUE,
                                "s",
                                $PositionID
                            );
                        foreach ($positiontbl as $value2) {
                            $PositionTitle = $value2[0];
                        }
                        ?>
                        <tbody>
                        <tr>
                            <td width="20%"><?php echo $PositionTitle; ?></td>
                            <td width="20%"><?php echo $CompanyName; ?></td>
                            <td width="20%"><?php echo $City; ?></td>
                            <td width="10%"><?php echo $Status; ?></td>
                            <td width="15%"><?php echo $DateSubmitted; ?></td>
                            <td width="15%">
                                <button class='btn btn-danger' data-toggle='modal'
                                        data-target='#Delete<?php echo $RID; ?>'><i
                                        class='fa fa-trash fa-1x'></i></button>
                            </td>
                        </tr>
                        </tbody>
                        <!-- Modal -->
                        <form name="form_Delete" id="form_Delete"
                              action="../search-job/function.php" autocomplete="off" method="POST">
                            <div class="modal fade" id="Delete<?php echo $RID; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Do you want to delete
                                                your application to this company?</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <input type="hidden" name="delete_request">
                                            <input type="hidden" name="RID" value="<?php echo $RID; ?>">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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