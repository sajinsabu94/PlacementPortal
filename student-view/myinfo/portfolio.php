<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$num = rand(0, 9999);
$hashStudentID = encrypt_decrypt_plusTime('encrypt', $StudentID, $num);

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
    <title>PlacementCell | Portfolio</title>

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

    <!--  CSS Styles  -->
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

    <script type="text/javascript" src="../../semantic-ui/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/semantic.min.css"></link>

    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/card.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/dimmer.css">

    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/container.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/grid.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/header.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/image.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/button.css">
    <link rel="stylesheet" type="text/css" href="../../semantic-ui/components/icon.css">

    <script type="text/javascript" src="../../semantic-ui/components/dimmer.js"></script>

    <!-- fileupload -->
    <link href="../../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="../../js/fileinput.min.js" type="text/javascript"></script>

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
                                <li><a href="education.php"><?php echo $nSchool; ?> Education</a></li>
                                <li><a href="certifications.php"><?php echo $nCertification; ?> Certifications</a></li>
                                <li><a href="achievements.php"><?php echo $nAchievements; ?> Achievements</a></li>
                                <li><a href="skills-and-languages.php"><?php echo $nSpecialization; ?> Skills & Languages</a></li>
                                <li><a href="references.php"><?php echo $nReferences; ?> References</a></li>
                                <li><a class="active" href="portfolio.php">Portfolio</a></li>
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
                        <li><a class="active" href="personal-info.php">Personal Info</a></li>
                        <li><a href="contacts-info.php">Contacts Info</a></li>
                        <li><a href="work.php">Work</a></li>
                        <li><a href="education.php">Education</a></li>
                        <li><a href="certifications.php">Certifications</a></li>
                        <li><a href="achievements.php">Achievements</a></li>
                        <li><a href="skills-and-languages.php">Skills & Languages</a></li>
                        <li><a href="references.php">References</a></li>
                        <li><a class="active" href="portfolio.php">Portfolio</a></li>
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
                    <h2>Portfolio</h2>
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

            <div class="row sidebar-page">
                <!-- Page Content -->
                <div class="col-md-12 page-content">
                    <div class="hr1" style="margin-top:20px;margin-bottom:20px;"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Documents<span="head-line"></span="head-line"></h4>
                        </div>
                        <div class="col-md-6">
                            <a class="main-button" style="float:right;cursor:pointer;" data-toggle="modal" data-target="#AddDocument">
                                <span>Add Document</span>
                            </a>
                        </div>
                    </div>

                    <!-- ADD Document Modal -->
                    <form id="UploadDocument" name="UploadDocument" method="POST" action="myinfoadd.php" enctype="multipart/form-data">
                        <div class="modal fade" id="AddDocument" role="dialog">
                            <div class="modal-dialog modal-lg" style="padding:160px;">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Document</h4>
                                    </div>
                                    <div class="modal-body">
                                        <label style="float:left;">* Select File
                                            <div>(10MB maximum file size)</div>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="uploadtest" value="test">
                                                    <input id="Document" name="Document" type="file" class="file file-loading" data-allowed-file-extensions='["doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt", "pdf"]'>
                                                </div>
                                                <script>
                                                    $("#Document").fileinput({
                                                        showUpload: false
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-system btn-large">Upload</button>
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
                            <th>File</th>
                            <th width="15%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $documents_tbl =
                            GSecureSQL::query(
                                "SELECT * FROM filestbl WHERE StudentID = ?",
                                TRUE,
                                "s",
                                $StudentID
                            );
                        foreach ($documents_tbl as $value) {
                            $FileID = $value[0];
                            $DocumentName = $value[2];

                            $FileIDenc = encrypt_decrypt("encrypt", $FileID);

                            ?>
                            <tr>
                                <td><a href="myinfoadd.php?DocID=<?php echo $FileIDenc; ?>"><?php echo $DocumentName; ?></a></td>
                                <td class="text-center">
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#DeleteDocument<?php echo $FileIDenc; ?>">
                                        <i class="fa fa-trash fa-1x"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="DeleteDocument<?php echo $FileIDenc; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete Document?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15">
                                                <label>Do you want to delete this
                                                Document? This cannot be undone.</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="delete.php?Delete_DocID=<?php echo $FileIDenc; ?>"
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

                    <div class="hr4" style="margin-top:40px;margin-bottom:40px;"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Links<span="head-line"></span="head-line"></h4>
                        </div>
                        <div class="col-md-6">
                            <a class="main-button" style="float:right;cursor:pointer;" data-toggle="modal" data-target="#AddLink">
                                <span>Add Link</h6></span>
                            </a>
                        </div>
                    </div>

                    <!-- ADD Link Modal -->
                    <form id="FormAddUrl" name="FormAddUrl" autocomplete="off" action="myinfoadd.php" method="POST">
                        <div class="modal fade" id="AddLink" role="dialog">
                            <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Link</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 fieldcol">
                                                <div class="form-group">
                                                    <label>URL <span>(*)</span></label>
                                                    <input type="url" class="form-control" id="txtURL" name="txtURL" value="http://" placeholder="http://">
                                                </div>
                                            </div>
                                            <div class="col-md-12 fieldcol">
                                                <div class="form-group">
                                                    <label>Name/Title/Caption <span>(*)</span></label>
                                                    <input type="text" class="form-control" id="txtCaption" name="txtCaption" value="">
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
                    <!-- end modal-->

                    <div class="hr2" style="margin-top:35px;"></div>
                    <table class="table segment table-hover">
                        <thead>
                        <tr>
                            <th>URL</th>
                            <th>Caption</th>
                            <th width="15%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $urltbl =
                            GSecureSQL::query(
                                "SELECT * FROM urltbl WHERE StudentID = ?",
                                TRUE,
                                "s",
                                $StudentID
                            );
                        foreach ($urltbl as $value) {
                            $id = $value[0];
                            $Link = $value[2];
                            $Caption = $value[3];
                            $idenc = encrypt_decrypt("encrypt", $id);
                            ?>
                            <tr>
                                <td><?php echo $Link; ?></td>
                                <td><?php echo $Caption; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-default" data-toggle="modal"
                                            data-target="#Edit<?php echo $id; ?>">
                                        <i class="fa fa-pencil-square-o fa-1x"></i>
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#Delete<?php echo $id; ?>">
                                        <i class="fa fa-trash fa-1x"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- EDIT Link Modal -->
                            <form id="FormEditUrl" name="FormEditUrl<?php echo $id; ?>" autocomplete="off" action="myinfoedit.php" method="POST">
                                <div class="modal fade" id="Edit<?php echo $id; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg" style="padding:160px;width:100%;">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Link</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 fieldcol">
                                                        <div class="form-group">
                                                            <label>URL <span>(*)</span></label>
                                                            <input type="url" class="form-control" id="EdittxtURL" name="EdittxtURL" value="<?php echo $Link; ?>" placeholder="http://">
                                                            <input type="hidden" name="URLID" value="<?php echo $idenc; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 fieldcol">
                                                        <div class="form-group">
                                                            <label>Name/Title/Caption <span>(*)</span></label>
                                                            <input type="text" class="form-control" id="EdittxtCaption" name="EdittxtCaption" value="<?php echo $Caption; ?>">
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
                                    var validator = $("#Edit<?php echo $id; ?>").bootstrapValidator({
                                        feedbackIcons: {
                                            valid: "glyphicon glyphicon-ok",
                                            invalid: "glyphicon glyphicon-remove",
                                            validating: "glyphicon glyphicon-refresh"
                                        },
                                        fields: {
                                            EdittxtURL: {
                                                validators: {
                                                    notEmpty: {
                                                        message: "This field is required."
                                                    }
                                                }
                                            },
                                            EdittxtCaption: {
                                                validators: {
                                                    notEmpty: {
                                                        message: "This field is required."
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>

                            <!-- Modal -->
                            <div class="modal fade" id="Delete<?php echo $id; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete URL?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15">
                                                <label>Do you want to delete this
                                                information? This cannot be undone.</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="delete.php?delete_URLID=<?php echo $idenc; ?>"
                                                   class="btn btn-danger">Delete</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
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
        var validator = $("#FormAddUrl").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                txtURL: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                txtCaption: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                }
            }
        });
    });

    $(document).ready(function () {
        var validator = $("#UploadDocument").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                Document: {
                    validators: {
                        notEmpty: {
                            message: "No file selected."
                        }
                    }
                }
            }
        });
    });


</script>


