<?php
include('../../connection.php');
include('../../common-functions.php');
include('../../encryption.php');
session_start();
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conformSe
// with your coding style -- ghabx

$num = rand(0,9999);
$hashStudentID = encrypt_decrypt_plusTime('encrypt', $StudentID, $num);

$student_tbl =
    GSecureSQL::query(
        "SELECT * FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$FirstName = $student_tbl[0][3];
$MiddleName = $student_tbl[0][4];
$LastName = $student_tbl[0][5];
$Gender = $student_tbl[0][6];
$Birthdate = $student_tbl[0][7];
$Nationality = $student_tbl[0][10];
$CivilStatus = $student_tbl[0][9];
$FBLink = $student_tbl[0][12];
$TwitterLink = $student_tbl[0][13];
$ProfileImage = $student_tbl[0][14];
$MajorCourse = $student_tbl[0][15];
$FBLink = substr($FBLink, 24);

$course_qry =
    GSecureSQL::query(
        "SELECT CourseTitle FROM coursetbl WHERE CourseCode = ?",
        TRUE,
        "s",
        $MajorCourse
    );
$MajorCourse = $course_qry[0][0];
$StudentName = $FirstName . " " . $LastName;

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
    <title>PlacementCell | Personal Info</title>

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
                                    <li><a href="../../student-profile.php?id=<?php echo $hashStudentID; ?>&n=<?php echo $num; ?>">Profile <b class="fa fa-user" style="float:right;"></b></a></li>
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
                                <li><a class="active" href="personal-info.php"><?php echo $nPinfo; ?> Personal Info</a>
                                </li>
                                <li><a href="contacts-info.php"><?php echo $nCinfo; ?> Contacts Info</a></li>
                                <li><a href="work.php"><?php echo $nWorkXP; ?> Work</a></li>
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
                        <li><a class="active" href="personal-info.php">Personal Info</a></li>
                        <li><a href="contacts-info.php">Contacts Info</a></li>
                        <li><a href="work.php">Work</a></li>
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
                    <h2>Personal Information</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Start Content -->
    <form id="Save" name="Save" autocomplete="off" method="POST" action="addfunction.php" enctype="multipart/form-data">
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
                    <div class="col-md-9 page-content">
                        <div class="row">
                            <div class="col-md-7">
                                <!-- Single Testimonial -->
                                <div class="call-action call-action-boxed call-action-style1 clearfix">
                                    <div class="form-group">
                                        <label>First Name <span>(*)</span></label>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="<?php echo $MiddleName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <span>(*)</span></label>
                                        <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender <span>(*)</span></label>
                                        <select id="Gender" name="Gender" class="form-control" style="width:100%; height:34px;">
                                            <option value="" <?php if ($Gender == "") echo 'selected="selected"'; ?>>-Please Select Gender -</option>
                                            <option value="Female" <?php if ($Gender == "Female") echo 'selected="selected"'; ?>>Female</option>
                                            <option value="Male" <?php if ($Gender == "Male") echo 'selected="selected"'; ?>>Male</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Birthdate <span>(*)</span></label><br>
                                        <input type="date" class="form-control" name="Birthdate" id="Birthdate" value="<?php echo $Birthdate; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nationality <span>(*)</span></label>
                                        <select id="Nationality" name="Nationality" class="form-control">
                                            <option value="" <?php if ($Nationality == "") echo 'selected="selected"'; ?>>-Please select one -</option>
                                            <option value="Afghan">Afghan</option>
                                            <option value="Albanian">Albanian</option>
                                            <option value="Algerian">Algerian</option>
                                            <option value="American" <?php if ($Nationality == "American") echo 'selected="selected"'; ?>>American</option>
                                            <option value="Andorran">Andorran</option>
                                            <option value="Angolan">Angolan</option>
                                            <option value="Antiguans">Antiguans</option>
                                            <option value="Argentinean">Argentinean</option>
                                            <option value="Armenian">Armenian</option>
                                            <option value="Australian">Australian</option>
                                            <option value="Austrian">Austrian</option>
                                            <option value="Azerbaijani">Azerbaijani</option>
                                            <option value="Bahamian">Bahamian</option>
                                            <option value="Bahraini">Bahraini</option>
                                            <option value="Bangladeshi">Bangladeshi</option>
                                            <option value="Barbadian">Barbadian</option>
                                            <option value="Barbudans">Barbudans</option>
                                            <option value="Batswana">Batswana</option>
                                            <option value="Belarusian">Belarusian</option>
                                            <option value="Belgian">Belgian</option>
                                            <option value="Belizean">Belizean</option>
                                            <option value="Beninese">Beninese</option>
                                            <option value="Bhutanese">Bhutanese</option>
                                            <option value="Bolivian">Bolivian</option>
                                            <option value="Bosnian">Bosnian</option>
                                            <option value="Brazilian">Brazilian</option>
                                            <option value="British">British</option>
                                            <option value="Bruneian">Bruneian</option>
                                            <option value="Bulgarian">Bulgarian</option>
                                            <option value="Burkinabe">Burkinabe</option>
                                            <option value="Burmese">Burmese</option>
                                            <option value="Burundian">Burundian</option>
                                            <option value="Cambodian">Cambodian</option>
                                            <option value="Cameroonian">Cameroonian</option>
                                            <option value="Canadian">Canadian</option>
                                            <option value="Cape Verdean">Cape Verdean</option>
                                            <option value="Central African">Central African</option>
                                            <option value="Chadian">Chadian</option>
                                            <option value="Chilean">Chilean</option>
                                            <option value="Chinese">Chinese</option>
                                            <option value="Colombian">Colombian</option>
                                            <option value="Comoran">Comoran</option>
                                            <option value="Congolese">Congolese</option>
                                            <option value="Costa Rican">Costa Rican</option>
                                            <option value="Croatian">Croatian</option>
                                            <option value="Cuban">Cuban</option>
                                            <option value="Cypriot">Cypriot</option>
                                            <option value="Czech">Czech</option>
                                            <option value="Danish">Danish</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominican">Dominican</option>
                                            <option value="Dutch">Dutch</option>
                                            <option value="East Timorese">East Timorese</option>
                                            <option value="Ecuadorean">Ecuadorean</option>
                                            <option value="Egyptian">Egyptian</option>
                                            <option value="Emirian">Emirian</option>
                                            <option value="Equatorial Guinean">Equatorial Guinean</option>
                                            <option value="Eritrean">Eritrean</option>
                                            <option value="Estonian">Estonian</option>
                                            <option value="Ethiopian">Ethiopian</option>
                                            <option value="Fijian">Fijian</option>
                                            <option value="Filipino" <?php if ($Nationality == "Filipino") echo 'selected="selected"'; ?>>Filipino</option>
                                            <option value="Finnish">Finnish</option>
                                            <option value="French">French</option>
                                            <option value="Gabonese">Gabonese</option>
                                            <option value="Gambian">Gambian</option>
                                            <option value="Georgian">Georgian</option>
                                            <option value="German">German</option>
                                            <option value="Ghanaian">Ghanaian</option>
                                            <option value="Greek">Greek</option>
                                            <option value="Grenadian">Grenadian</option>
                                            <option value="Guatemalan">Guatemalan</option>
                                            <option value="Guinea-Bissauan">Guinea-Bissauan</option>
                                            <option value="Guinean">Guinean</option>
                                            <option value="Guyanese">Guyanese</option>
                                            <option value="Haitian">Haitian</option>
                                            <option value="Herzegovinian">Herzegovinian</option>
                                            <option value="Honduran">Honduran</option>
                                            <option value="Hungarian">Hungarian</option>
                                            <option value="I-Kiribati">I-Kiribati</option>
                                            <option value="Icelander">Icelander</option>
                                            <option value="Indian">Indian</option>
                                            <option value="Indonesian">Indonesian</option>
                                            <option value="Iranian">Iranian</option>
                                            <option value="Iraqi">Iraqi</option>
                                            <option value="Irish">Irish</option>
                                            <option value="Israeli">Israeli</option>
                                            <option value="Italian">Italian</option>
                                            <option value="Ivorian">Ivorian</option>
                                            <option value="Jamaican">Jamaican</option>
                                            <option value="Japanese">Japanese</option>
                                            <option value="Jordanian">Jordanian</option>
                                            <option value="Kazakhstani">Kazakhstani</option>
                                            <option value="Kenyan">Kenyan</option>
                                            <option value="Kittian and Nevisian">Kittian and Nevisian</option>
                                            <option value="Kuwaiti">Kuwaiti</option>
                                            <option value="Kyrgyz">Kyrgyz</option>
                                            <option value="Laotian">Laotian</option>
                                            <option value="Latvian">Latvian</option>
                                            <option value="Lebanese">Lebanese</option>
                                            <option value="Liberian">Liberian</option>
                                            <option value="Libyan">Libyan</option>
                                            <option value="Liechtensteiner">Liechtensteiner</option>
                                            <option value="Lithuanian">Lithuanian</option>
                                            <option value="Luxembourger">Luxembourger</option>
                                            <option value="Macedonian">Macedonian</option>
                                            <option value="Malagasy">Malagasy</option>
                                            <option value="Malawian">Malawian</option>
                                            <option value="Malaysian">Malaysian</option>
                                            <option value="Maldivan">Maldivan</option>
                                            <option value="Malian">Malian</option>
                                            <option value="Maltese">Maltese</option>
                                            <option value="Marshallese">Marshallese</option>
                                            <option value="Mauritanian">Mauritanian</option>
                                            <option value="Mauritian">Mauritian</option>
                                            <option value="Mexican">Mexican</option>
                                            <option value="Micronesian">Micronesian</option>
                                            <option value="Moldovan">Moldovan</option>
                                            <option value="Monacan">Monacan</option>
                                            <option value="Mongolian">Mongolian</option>
                                            <option value="Moroccan">Moroccan</option>
                                            <option value="Mosotho">Mosotho</option>
                                            <option value="Motswana">Motswana</option>
                                            <option value="Mozambican">Mozambican</option>
                                            <option value="Namibian">Namibian</option>
                                            <option value="Nauruan">Nauruan</option>
                                            <option value="Nepalese">Nepalese</option>
                                            <option value="New Zealander">New Zealander</option>
                                            <option value="Nicaraguan">Nicaraguan</option>
                                            <option value="Nigerian">Nigerian</option>
                                            <option value="Nigerien">Nigerien</option>
                                            <option value="North Korean">North Korean</option>
                                            <option value="Northern Irish">Northern Irish</option>
                                            <option value="Norwegian">Norwegian</option>
                                            <option value="Omani">Omani</option>
                                            <option value="Pakistani">Pakistani</option>
                                            <option value="Palauan">Palauan</option>
                                            <option value="Panamanian">Panamanian</option>
                                            <option value="Papua New Guinean">Papua New Guinean</option>
                                            <option value="Paraguayan">Paraguayan</option>
                                            <option value="Peruvian">Peruvian</option>
                                            <option value="Polish">Polish</option>
                                            <option value="Portuguese">Portuguese</option>
                                            <option value="Qatari">Qatari</option>
                                            <option value="Romanian">Romanian</option>
                                            <option value="Russian">Russian</option>
                                            <option value="Rwandan">Rwandan</option>
                                            <option value="Saint Lucian">Saint Lucian</option>
                                            <option value="Salvadoran">Salvadoran</option>
                                            <option value="Samoan">Samoan</option>
                                            <option value="San Marinese">San Marinese</option>
                                            <option value="Sao Tomean">Sao Tomean</option>
                                            <option value="Saudi">Saudi</option>
                                            <option value="Scottish">Scottish</option>
                                            <option value="Senegalese">Senegalese</option>
                                            <option value="Serbian">Serbian</option>
                                            <option value="Seychellois">Seychellois</option>
                                            <option value="Sierra Leonean">Sierra Leonean</option>
                                            <option value="Singaporean">Singaporean</option>
                                            <option value="Slovakian">Slovakian</option>
                                            <option value="Slovenian">Slovenian</option>
                                            <option value="Solomon Islander">Solomon Islander</option>
                                            <option value="Somali">Somali</option>
                                            <option value="South African">South African</option>
                                            <option value="South Korean">South Korean</option>
                                            <option value="Spanish">Spanish</option>
                                            <option value="Sri Lankan">Sri Lankan</option>
                                            <option value="Sudanese">Sudanese</option>
                                            <option value="Surinamer">Surinamer</option>
                                            <option value="Swazi">Swazi</option>
                                            <option value="Swedish">Swedish</option>
                                            <option value="Swiss">Swiss</option>
                                            <option value="Syrian">Syrian</option>
                                            <option value="Taiwanese">Taiwanese</option>
                                            <option value="Tajik">Tajik</option>
                                            <option value="Tanzanian">Tanzanian</option>
                                            <option value="Thai">Thai</option>
                                            <option value="Togolese">Togolese</option>
                                            <option value="Tongan">Tongan</option>
                                            <option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
                                            <option value="Tunisian">Tunisian</option>
                                            <option value="Turkish">Turkish</option>
                                            <option value="Tuvaluan">Tuvaluan</option>
                                            <option value="Ugandan">Ugandan</option>
                                            <option value="Ukrainian">Ukrainian</option>
                                            <option value="Uruguayan">Uruguayan</option>
                                            <option value="Uzbekistani">Uzbekistani</option>
                                            <option value="Venezuelan">Venezuelan</option>
                                            <option value="Vietnamese">Vietnamese</option>
                                            <option value="Welsh">Welsh</option>
                                            <option value="Yemenite">Yemenite</option>
                                            <option value="Zambian">Zambian</option>
                                            <option value="Zimbabwean">Zimbabwean</option>
                                        </select>
                                        <script>
                                            // daya pa murrr. Filipino at US lang ang maayos na nationality. XD
                                            // I have my jquery fix for this thing. :P
                                            $(document).ready(function () {
                                                $("#Nationality").val(<?php echo json_encode($Nationality)?>);
                                            });
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label>Civil Status <span>(*)</span></label>
                                        <select id="CivilStatus" name="CivilStatus" class="form-control">
                                            <option value="" <?php if ($CivilStatus == "") echo 'selected="selected"'; ?>>-Please select one -</option>
                                            <option value="Single" <?php if ($CivilStatus == "Single") echo 'selected="selected"'; ?>>Single</option>
                                            <option value="Married" <?php if ($CivilStatus == "Married") echo 'selected="selected"'; ?>>Married</option>
                                            <option value="Separated" <?php if ($CivilStatus == "Separated") echo 'selected="selected"'; ?>>Separated</option>
                                            <option value="Widowed" <?php if ($CivilStatus == "Widowed") echo 'selected="selected"'; ?>>Widowed</option>
                                        </select>
                                    </div>
                                    <label class="control-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">http://www.facebook.com/</span>
                                        <div class="form-group">
                                            <input name="FBLink" id="FBLink" type="text" maxlength="20" class="form-control" value="<?php echo $FBLink; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Testimonial -->
                            </div>
                            <div class="col-md-5">
                                <?php
                                if ($ProfileImage == "") {
                                    ?>
                                    <div class="image-border">
                                        <img src="../../img/man-icon.png" class="img-responsive" style="width:100%; height:100%;">
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="image-border">
                                        <img src="<?php echo $ProfileImage; ?>" class="img-responsive" style="width:100%; height:100%;">
                                    </div>
                                    <?php
                                }
                                ?>
                                <br><br>
                                <label>Photo <span>(*)</span></label>
                                <div class="form-group">
                                    <input id="ProfilePicture" name="ProfilePicture" type="file" class="file file-loading" data-allowed-file-extensions='["png", "jpg", "jpeg"]'>
                                </div>
                                <script>
                                    $("#ProfilePicture").fileinput({
                                        showUpload: false
                                    });
                                </script>
                                <label style="float:right;">* Select Image</label>
                                <br>
                                <!-- <button id="" class="btn-system btn-mini border-btn" name="btnDelete">Delete Image</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- End Page Content -->

                    <!--Sidebar-->
                    <div class="col-md-3 sidebar right-sidebar">
                        <!-- Search Widget -->
                        <div class="call-action call-action-boxed call-action-style2 clearfix">
                            <label><span>(*)</span> Note: Required fields.</label>
                            <label><span>Photo:</span> Upload your most decent photo that will best represent yourself.</label>
                        </div>
                    </div>
                    <!--End sidebar-->
                </div>
                <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                <div class="text-center">
                    <input type="hidden" name="btnSaveInfo"/> <!-- magic ko to mark lol -- ghabx -->
                    <button type="submit" class="btn-system btn-large" id="btnsave">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Content -->
<script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#Save").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                FirstName: {
                    validators: {
                        notEmpty: {
                            message: "First Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "First Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                MiddleName: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Middle Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                LastName: {
                    validators: {
                        notEmpty: {
                            message: "Last Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "The full name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                Gender: {
                    validators: {
                        notEmpty: {
                            message: "Gender is required."
                        }
                    }
                },
                Birthdate: {
                    validators: {
                        notEmpty: {
                            message: "Birthdate is required."
                        }
                    }
                },
                Nationality: {
                    validators: {
                        notEmpty: {
                            message: "Nationality is required."
                        }
                    }
                },
                CivilStatus: {
                    validators: {
                        notEmpty: {
                            message: "CivilStatus is required."
                        }
                    }
                },
                FBLink: {
                    validators: {
                        regexp: {
                            regexp: /^([a-z0-9]+[.]*)+$/i,
                            message: "Invalid FB Link."
                        }
                    }
                },
                TwitterLink: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z_0-9\s]+$/i,
                            message: "Invalid Twitter Link"
                        }
                    }
                }
            }
        });
    });
</script>

<!--
<?php
/*
if($ProfileImage == ""){
?>
                ProfilePicture: {
                    validators: {
                        notEmpty: {
                            message: "Photo is required."
                        }
                    }
                }
                <?php
}
*/
?>
-->
