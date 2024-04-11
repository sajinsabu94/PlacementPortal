<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$PositionID = $_GET['id'];
$num = $_GET['n'];

$PositionID = encrypt_decrypt_plusTime('decrypt', $PositionID, $num);

$checklink = substr($num, 0,3);

if($checklink != $StudentID){
    header("location: jobs.php");
    die();
}

$position_tbl =
    GSecureSQL::query(
        "SELECT * FROM comppositiontbl WHERE PositionID = ?",
        TRUE,
        "s",
        $PositionID
    );

if(count($position_tbl) == 0){
    header("location: jobs.php");
}


$CompanyID = $position_tbl[0][1];
$Email = $position_tbl[0][2];
$PostingDateFrom = $position_tbl[0][3];
$PostingDateTo = $position_tbl[0][4];
$PositionTitle = $position_tbl[0][5];
$PositionLevel = $position_tbl[0][6];
$JobDescription = $position_tbl[0][7];
$EmploymentType = $position_tbl[0][9];
$MonthlySalary = $position_tbl[0][11];
$YearExperience = $position_tbl[0][12];
$DegreeLevel = $position_tbl[0][14];

$companyinfo_tbl =
    GSecureSQL::query(
        "SELECT
        CompanyName,
        Description,
        Industry,
        City,
        ProfileImage
        FROM companyinfotbl WHERE CompanyID = ?",
        TRUE,
        "s",
        $CompanyID
    );
$CompanyName = $companyinfo_tbl[0][0];
$CompanyDescription = $companyinfo_tbl[0][1];
$cIndustry = $companyinfo_tbl[0][2];
$cLocation = $companyinfo_tbl[0][3];
$ProfileImage = $companyinfo_tbl[0][4];


$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

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

<!doctype html>
<html lang="en">
<head>

    <!-- Basic -->
    <title>PlacementCell</title>

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
                                    <!-- <li><a href="../../student-profile.php?id=<?php echo $hashStudentID; ?>">Profile <b class="fa fa-user" style="float:right;"></b></a></li> -->
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
                    <!-- Sign-out -->
                    <div class="signout-side">
                        <form method="GET">
                            <?php
                            $requesttocompany_tbl =
                                GSecureSQL::query(
                                    "SELECT * FROM requesttocompanytbl WHERE StudentID = ? AND PositionID = ?",
                                    TRUE,
                                    "ss",
                                    $StudentID,
                                    $PositionID
                                );

                            if (count($requesttocompany_tbl)) {
                                echo "
                            <button name='btnBack' class='btn-system btn-mini border-btn'>Back</button>
                            <a class='btn-system btn-mini border-btn' data-toggle='modal'
                                data-target='#ApplyNow' disabled>Resumé Submitted
                            </a>
                            ";
                            } else {
                                echo "
                            <button name='btnBack' class='btn-system btn-mini border-btn'>Back</button>
                            <a class='btn-system btn-mini border-btn' data-toggle='modal'
                                data-target='#ApplyNow'>Submit Resumé
                            </a>
                            ";
                            }
                            ?>
                        </form>
                    </div>
                    <!-- End Sign-out -->
                    <!-- Modal -->
                    <form action="function.php" method="POST">
                        <div class="modal fade" id="ApplyNow" role="dialog">
                            <div class="modal-dialog" style="padding:100px">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Submit Resume</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-15 fieldcol">
                                            <label = "usr" class = "control-label">Do you want to Submit your resume to
                                            this
                                            company?</label>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $PositionID; ?>">
                                        <input type="hidden" name="cid" value="<?php echo $CompanyID; ?>"
                                        <input type="hidden" name="desination"
                                               value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                                        <div class="modal-footer">
                                            <button class="btn-system btn-large">Send</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Modal End -->

                    <!-- Start Navigation List -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>&nbsp;</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">
                <li>
                    <a href="#">Apply Now</a>
                </li>
            </ul>
            <!-- Mobile Menu End -->
        </div>
    </header>

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


    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row sidebar-page">
                <!-- Page Content -->
                <div class="col-md-9 page-content">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Single Testimonial -->
                            <div class="classic-testimonials">
                                From: <?php echo $PostingDateFrom . " To: " . $PostingDateTo; ?>
                            </div>
                        </div>
                        <div class="col-md-6">                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Single Testimonial -->
                            <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="text-center">
                                <div class="company-logo">
                                    <img src="../../company/<?php echo $ProfileImage; ?>" class="img-responsive"
                                         style="width:100%; height:100%;">
                                </div>
                            </div>
                            <!-- End Single Testimonial -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h4><?php echo $CompanyName; ?></h4>
                            </div>
                            <label><?php echo nl2br($CompanyDescription); ?></label>
                            <div class="hr3" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="text-center"><h3><?php echo $PositionTitle; ?></h3></div>
                            <div class="hr3" style="margin-top:35px;margin-bottom:40px;"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="classic-testimonials">
                                <label><u>Good candidate must have the following qualifications:</u></label>
                            </div>
                            <?php
                            $reqSkills_tbl =
                                GSecureSQL::query(
                                    "SELECT ReqSkills FROM comppositiontbl WHERE CompanyID = ? AND PositionID = ?",
                                    TRUE,
                                    "ss",
                                    $CompanyID,
                                    $PositionID
                                );
                            foreach ($reqSkills_tbl as $value) {
                                $Skills = $value[0];
                                $Skills = explode(", ", $Skills);
                                foreach ($Skills as $value2) {
                                    $Skills = $value2;
                                    ?>
                                    <li><?php echo $Skills; ?></li>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>

                    <div class="row">
                        <div class="col-md-3">
                            <label>Year(s) of Experience</label>
                        </div>
                        <div class="col-md-3"><?php echo $YearExperience; ?> year(s)</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Educational Attainment</label>
                        </div>
                        <div class="col-md-3"><?php echo $DegreeLevel; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Industry</label>
                        </div>
                        <div class="col-md-3">Information Technology</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Job Description</label>
                        </div>
                        <div class="col-md-4"><?php echo $JobDescription; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Location</label>
                        </div>
                        <div class="col-md-3"><?php echo $cLocation; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Salary</label>
                        </div>
                        <div class="col-md-3">PHP <?php echo $MonthlySalary; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Employment Type</label>
                        </div>
                        <div class="col-md-3"><?php echo $EmploymentType; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                        </div>
                    </div>

                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                    <div><h3>People also viewed</h3></div>
                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                    <div><h3>Related Searches</h3></div>

                </div>
                <!-- End Page Content -->

                <!--Sidebar-->
                <div class="col-md-3 sidebar right-sidebar">
                    <!-- Search Widget -->
                    <div class="widget widget-categories">
                        <h4>Tools <span class="head-line"></span></h4>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-bookmark"></i> Bookmark this Job</a>
                            </li> 
                        </ul>
                    </div>                    
                </div>
                <!--End sidebar-->
            </div>
        </div>
    </div>
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