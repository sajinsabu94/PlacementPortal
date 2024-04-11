<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID'];

$n = rand(0,9999);
$hashStudentID = encrypt_decrypt_plusTime('encrypt', $StudentID, $n);

$PLevel_Default = isset($_GET['PLevel']) ? $_GET['PLevel'] : '';
$EType_Default = isset($_GET['EType']) ? $_GET['EType'] : '';
$Search_Default = isset($_GET['Search']) ? $_GET['Search'] : '';


$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$specialization_tbl =
    GSecureSQL::query(
        "SELECT Specialization FROM specializationtbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$Specialization = array_reduce($specialization_tbl, 'array_merge', array());
$Specialization = implode("', '", $Specialization);

$FirstName = $infoquery[0][0];
$LastName = $infoquery[0][1];
$CourseCode = $infoquery[0][2];
$StudentName = $FirstName . " " . $LastName;

$coursetbl =
    GSecureSQL::query(
        "SELECT CourseTitle FROM coursetbl WHERE CourseCode = ?",
        TRUE,
        "s",
        $CourseCode
    );
$MajorCourse = $coursetbl[0][0];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Basic -->
        <title>PlacementCell | Jobs</title>

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

        <!-- CSS Styles  -->
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b
                                            class="fa fa-user"></b>
                                        Welcome, <b><?php echo $StudentName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a href="../../student-profile.php?id=<?php echo $hashStudentID; ?>&n=<?php echo $n; ?>">Profile <b class="fa fa-user" style="float:right;"></b></a></li> -->
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
                                   class="btn btn-primary">Sign out</a>
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
                        <a class="navbar-brand" href="">
                            <img src="../../images/PlacementCell.png">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Find the job that suits your passion</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="../myinfo/personal-info.php">Fill out your information</a></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div class="middle-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="mid-list">
                            &nbsp;
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($id == 1) {
                echo '<div class="alert alert-success">
                <span class="glyphicon glyphicon-info-sign"></span>
                Resume Submitted.
            </div>';
            }
        }
        ?>

        <!-- Start Content -->
        <form method="GET">
            <div id="content">
                <div class="container">
                    <div class="row blog-page">
                        <!--Sidebar-->
                        <div class="col-md-3 sidebar left-sidebar">


                            <div>
                                <label><i class="fa fa-bookmark"></i> Bookmarked Jobs: <a
                                        href="bookmarked-jobs.php">(0)</a>&nbsp;
                                </label>
                            </div>
                            <div>
                                <label><i class="fa fa-search"></i> Search:
                                </label>
                                <input type="text" name="Search" class="form-control" value="<?php echo $Search_Default; ?>">
                            </div>

                            <div>
                                <label>Position Level</label>
                                <select id="PLevel" name="PLevel" class="form-control">
                                    <option value="">- Select one -</option>
                                    <?php
                                    $listofposition_tbl =
                                        GSecureSQL::query(
                                            "SELECT Position FROM listofpositiontbl",
                                            TRUE
                                        );
                                    foreach ($listofposition_tbl as $value) {
                                        $cPosition = $value[0];
                                        ?>
                                        <option
                                            value="<?php echo $cPosition; ?>" <?php if ($PLevel_Default == $cPosition) {
                                            echo "selected='selected'";
                                        } ?>><?php echo $cPosition; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div>
                                <label>Employment Type:</label>
                                <select id="EType" name="EType" class="form-control">
                                    <option value="">- Select one -</option>
                                    <option value="Full Time" <?php if ($EType_Default == "Full Time") {
                                        echo "selected='selected'";
                                    } ?>>Full Time
                                    </option>
                                    <option value="Part Time" <?php if ($EType_Default == "Part Time") {
                                        echo "selected='selected'";
                                    } ?>>Part Time
                                    </option>
                                    <option value="Contract" <?php if ($EType_Default == "Contract") {
                                        echo "selected='selected'";
                                    } ?>>Contract
                                    </option>
                                    <option value="Temporary" <?php if ($EType_Default == "Temporary") {
                                        echo "selected='selected'";
                                    } ?>>Temporary
                                    </option>
                                </select>
                            </div>
                            <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>
                            <div class="text-center">
                                <button type="submit" name="btnFilter" class="btn-system btn-large btn-black">Apply Filter
                                </button>
                            </div>

                            <div class="hr4" style="margin-top:40px;margin-bottom:40px;"></div>                            
                        </div>
                        <!--End sidebar-->

                        <!-- Start Blog Posts -->
                        <div class="col-md-9 blog-box">
                            <h4 class="classic-title"><span>Jobs</span></h4>
                            <?php
                            if (isset($_GET['btnFilter'])) {
                                $isEmpty = 0;
                                $PLevel = $_GET['PLevel'];
                                $EType = $_GET['EType'];
                                $Search = $_GET['Search'];

                                if($Search == "programmer" OR $Search == "programming"){
                                    $Search = "prog";
                                }

                                if (empty($PLevel) && empty($EType)) {
                                    $compposition_tbl =
                                        GSecureSQL::query(
                                            "SELECT
                                            comppositiontbl.PositionID,
                                            comppositiontbl.CompanyID,
                                            comppositiontbl.PostingDateFrom,
                                            comppositiontbl.PostingDateTo,
                                            comppositiontbl.PositionTitle,
                                            comppositiontbl.JobDescription,
                                            comppositiontbl.YExperience,
                                            listofspecializationtbl.RelatedCourses,
                                            comppositiontbl.ReqSkills,
                                            comppositiontbl.JSpecialization
                                            FROM listofspecializationtbl
                                            INNER JOIN comppositiontbl ON listofspecializationtbl.Specialization = comppositiontbl.JSpecialization
                                            WHERE PositionTitle LIKE '%$Search%'
                                            ORDER BY PositionTitle ASC",
                                            TRUE
                                        );
                                } elseif (empty($EType)) {
                                    $compposition_tbl =
                                        GSecureSQL::query(
                                            "SELECT
                                            comppositiontbl.PositionID,
                                            comppositiontbl.CompanyID,
                                            comppositiontbl.PostingDateFrom,
                                            comppositiontbl.PostingDateTo,
                                            comppositiontbl.PositionTitle,
                                            comppositiontbl.JobDescription,
                                            comppositiontbl.YExperience,
                                            listofspecializationtbl.RelatedCourses,
                                            comppositiontbl.ReqSkills,
                                            comppositiontbl.JSpecialization
                                            FROM listofspecializationtbl
                                            INNER JOIN comppositiontbl ON listofspecializationtbl.Specialization = comppositiontbl.JSpecialization
                                            WHERE comppositiontbl.PositionLevel = ? AND comppositiontbl.PositionTitle LIKE '%$Search%'
                                            ORDER BY PositionTitle ASC",
                                            TRUE,
                                            "s",
                                            $PLevel
                                        );
                                } elseif (empty($PLevel)) {
                                    $compposition_tbl =
                                        GSecureSQL::query(
                                            "SELECT
                                            comppositiontbl.PositionID,
                                            comppositiontbl.CompanyID,
                                            comppositiontbl.PostingDateFrom,
                                            comppositiontbl.PostingDateTo,
                                            comppositiontbl.PositionTitle,
                                            comppositiontbl.JobDescription,
                                            comppositiontbl.YExperience,
                                            listofspecializationtbl.RelatedCourses,
                                            comppositiontbl.ReqSkills,
                                            comppositiontbl.JSpecialization
                                            FROM listofspecializationtbl
                                            INNER JOIN comppositiontbl ON listofspecializationtbl.Specialization = comppositiontbl.JSpecialization
                                            WHERE comppositiontbl.EType = ? AND comppositiontbl.PositionTitle LIKE '%$Search%'
                                            ORDER BY PositionTitle ASC",
                                            TRUE,
                                            "s",
                                            $EType
                                        );
                                } else {
                                    $compposition_tbl =
                                        GSecureSQL::query(
                                            "SELECT
                                            comppositiontbl.PositionID,
                                            comppositiontbl.CompanyID,
                                            comppositiontbl.PostingDateFrom,
                                            comppositiontbl.PostingDateTo,
                                            comppositiontbl.PositionTitle,
                                            comppositiontbl.JobDescription,
                                            comppositiontbl.YExperience,
                                            listofspecializationtbl.RelatedCourses,
                                            comppositiontbl.ReqSkills,
                                            comppositiontbl.JSpecialization
                                            FROM listofspecializationtbl
                                            INNER JOIN comppositiontbl ON listofspecializationtbl.Specialization = comppositiontbl.JSpecialization
                                            WHERE comppositiontbl.EType = ? AND comppositiontbl.PositionLevel = ? AND comppositiontbl.PositionTitle LIKE '%$Search%'
                                            ORDER BY PositionTitle ASC",
                                            TRUE,
                                            "ss",
                                            $EType,
                                            $PLevel
                                        );
                                }
                                $aCount = 0;
                                foreach ($compposition_tbl as $value) {
                                    $PositionID = $value[0];
                                    $CompanyID = $value[1];
                                    $PostingDateFrom = $value[2];
                                    $PostingDateTo = $value[3];
                                    $PositionTitle = $value[4];
                                    $PositionDescription = $value[5];
                                    $YearExperience = $value[6];
                                    $RelatedCourses = $value[7];
                                    $RelatedCourses = explode(", ", $RelatedCourses);
                                    $RequiredSkills = $value[8];
                                    $RequiredSkills = explode(", ", $RequiredSkills);
                                    $num = $StudentID;
                                    $hashPID = encrypt_decrypt_plusTime("encrypt",$PositionID,$num);
                                    foreach ($RelatedCourses as $value3) {
                                        $rCourse = $value3;
                                        if ($rCourse == $MajorCourse) {
                                            $company_tbl =
                                                GSecureSQL::query(
                                                    "SELECT * FROM companyinfotbl WHERE CompanyID = ?",
                                                    TRUE,
                                                    "s",
                                                    $CompanyID
                                                );
                                            foreach ($company_tbl as $value1) {
                                                $CompanyName = $value1[1];
                                                $Location = $value1[5];

                                                $diff_from = date_diff(new DateTime(), new DateTime($PostingDateFrom));
                                                $diff_to = date_diff(new DateTime(), new DateTime($PostingDateTo));

                                                if ($diff_to->d == 0) {
                                                    $diff_to->invert = 0;
                                                }

                                                $a = $diff_from->y >= 0 &&
                                                    $diff_from->m >= 0 &&
                                                    $diff_from->d >= 0 &&
                                                    $diff_from->invert == 1;

                                                $b = $diff_to->y >= 0 &&
                                                    $diff_to->m >= 0 &&
                                                    $diff_to->d >= 0 &&
                                                    $diff_to->invert == 0;

                                                if ($a && $b) {
                                                    $aCount++;
                                                    ?>
                                                    <div class='blog-post standard-post'>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <!-- Post Content -->
                                                                <div class='post-content'>
                                                                    <div class='post-type'><i
                                                                            class='fa fa-picture-o'></i>
                                                                    </div>
                                                                    <h2><a href='#'><?php echo $PositionTitle; ?></a>
                                                                    </h2>
                                                                    <h1><p><?php echo $CompanyName; ?></p></h1>
                                                                    <ul class='icons-list'>
                                                                        <?php
                                                                        foreach ($RequiredSkills as $value2) {
                                                                            $count = 0;
                                                                            $RequiredSkill = $value2;
                                                                            if ($count < 3) {
                                                                                $count++;
                                                                                ?>
                                                                                <li>
                                                                                    <i class='fa fa-check-circle'></i> <?php echo $RequiredSkill; ?>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <div class='hr1' style='margin-bottom:14px;'></div>
                                                                    <ul class='post-meta'>
                                                                        <li><?php echo $YearExperience; ?> year(s)
                                                                            experience
                                                                        </li>
                                                                        <li><?php echo $Location; ?></li>
                                                                    </ul>
                                                                    <a class='main-button'
                                                                       href='view-details.php?id=<?php echo $hashPID; ?>&n=<?php echo $num; ?>'>View
                                                                        Details <i class='fa fa-angle-right'></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <B class="accent-color">Description: </B><?php echo $PositionDescription; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($aCount == 0) {
                                    echo
                                    "
                                            <div class='blog-post standard-post'>
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <label>No results found.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                                }
                            }
                            else {
                                $isEmpty = 0;
                                $compposition_tbl =
                                    GSecureSQL::query(
                                        "SELECT
                                            comppositiontbl.PositionID,
                                            comppositiontbl.CompanyID,
                                            comppositiontbl.PostingDateFrom,
                                            comppositiontbl.PostingDateTo,
                                            comppositiontbl.PositionTitle,
                                            comppositiontbl.JobDescription,
                                            comppositiontbl.YExperience,
                                            listofspecializationtbl.RelatedCourses,
                                            comppositiontbl.ReqSkills,
                                            comppositiontbl.JSpecialization
                                            FROM listofspecializationtbl
                                            INNER JOIN comppositiontbl ON listofspecializationtbl.Specialization = comppositiontbl.JSpecialization
                                            ORDER BY PositionTitle ASC",
                                        TRUE
                                    );
                                $sCount = 0;
                                foreach ($compposition_tbl as $value) {
                                    $PositionID = $value[0];
                                    $CompanyID = $value[1];
                                    $PostingDateFrom = $value[2];
                                    $PostingDateTo = $value[3];
                                    $PositionTitle = $value[4];
                                    $PositionDescription = $value[5];
                                    $YearExperience = $value[6];
                                    $RelatedCourses = $value[7];
                                    $RelatedCourses = explode(", ", $RelatedCourses);
                                    $RequiredSkills = $value[8];
                                    $RequiredSkills = explode(", ", $RequiredSkills);
                                    $num = rand(0,9999);
                                    $num = $StudentID . $num;
                                    $hashPID = encrypt_decrypt_plusTime("encrypt",$PositionID,$num);
                                    foreach ($RelatedCourses as $value3) {
                                        $rCourse = $value3;
                                        if ($rCourse == $CourseCode) {
                                            $company_tbl =
                                                GSecureSQL::query(
                                                    "SELECT * FROM companyinfotbl WHERE CompanyID = ?",
                                                    TRUE,
                                                    "s",
                                                    $CompanyID
                                                );
                                            foreach ($company_tbl as $value1) {
                                                $CompanyName = $value1[1];
                                                $Location = $value1[5];

                                                $diff_from = date_diff(new DateTime(), new DateTime($PostingDateFrom));
                                                $diff_to = date_diff(new DateTime(), new DateTime($PostingDateTo));

                                                if ($diff_to->d == 0) {
                                                    $diff_to->invert = 0;
                                                }

                                                $a = $diff_from->y >= 0 &&
                                                    $diff_from->m >= 0 &&
                                                    $diff_from->d >= 0 &&
                                                    $diff_from->invert == 1;

                                                $b = $diff_to->y >= 0 &&
                                                    $diff_to->m >= 0 &&
                                                    $diff_to->d >= 0 &&
                                                    $diff_to->invert == 0;

                                                if ($a && $b) {
                                                    $sCount++;
                                                    ?>
                                                    <div class='blog-post standard-post'>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <!-- Post Content -->
                                                                <div class='post-content'>
                                                                    <div class='post-type'><i
                                                                            class='fa fa-star'></i>
                                                                    </div>
                                                                    <h2><a href='#'><?php echo $PositionTitle; ?></a>
                                                                    </h2>
                                                                    <h1><p><?php echo $CompanyName; ?></p></h1>
                                                                    <ul class='icons-list'>
                                                                        <?php
                                                                        foreach ($RequiredSkills as $value2) {
                                                                            $count = 0;
                                                                            $RequiredSkill = $value2;
                                                                            if ($count < 3) {
                                                                                $count++;
                                                                                ?>
                                                                                <li>
                                                                                    <i class='fa fa-check-circle'></i> <?php echo $RequiredSkill; ?>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <div class='hr1' style='margin-bottom:14px;'></div>
                                                                    <ul class='post-meta'>
                                                                        <li><?php echo $YearExperience; ?> year(s)
                                                                            experience
                                                                        </li>
                                                                        <li><?php echo $Location; ?></li>
                                                                    </ul>
                                                                    <a class='main-button'
                                                                       href='view-details.php?id=<?php echo $hashPID; ?>&n=<?php echo $num;?>'>View
                                                                        Details <i class='fa fa-angle-right'></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <B class="accent-color">Description: </B><?php echo $PositionDescription; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($sCount == 0) {
                                    echo
                                    "
                                    <div class='blog-post standard-post'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label>No results found.</label>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Content -->
    <script type="text/javascript" src="../../js/script.js"></script>


    <!-- Start Footer Section -->
    <footer>
        <div class="container">
            <!-- Start Copyright -->
            <div class="copyright-section">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2015 PlacementCell - All Rights Reserved</p>
                    </div>
                    <!-- .col-md-6 -->
                    <div class="col-md-6">
                        <ul class="footer-nav">
                            <li><a href="#">Sitemap</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <!-- .col-md-6 -->
                </div>
                <!-- .row -->
            </div>
            <!-- End Copyright -->
        </div>
    </footer>
    <!-- End Footer Section -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</body>
</html>
<?php

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

if ($Pinfo == "ok" &&
    $Cinfo == "ok" &&
    $Objective == "ok" &&
    $School == "ok" &&
    $Certification == "ok" &&
    $Achievements == "ok" &&
    $Specialization == "ok" &&
    $Languages == "ok" &&
    $References == "ok"
) {

} else {
    echo "
    <script type='text/javascript'>
    alert('You must complete your information first.');
    location.href='../myinfo/personal-info.php';
    </script>";
}
?>