<?php
include('../connection.php');
session_start();

if(isset($_SESSION['CompanyID'])){
    $CompanyID = $_SESSION['CompanyID'];
}
else{
    header("location: ../login-company.php");
}

$companyinfo_tbl =
    GSecureSQL::query(
        "SELECT CompanyName, FirstName, LastName FROM companyinfotbl WHERE CompanyID = ?",
        TRUE,
        "s",
        $CompanyID
    );
$CompanyName = $companyinfo_tbl[0][0];
$cFirstName = $companyinfo_tbl[0][1];
$cLastName = $companyinfo_tbl[0][2];
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

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../css/slicknav.css" media="screen">

    <!--  CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css" media="screen">

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="../css/PlacementCell-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/colors/yellow.css" title="yellow" media="screen"/>


    <!-- Margo JS  -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../js/modernizrr.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="../js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="../js/jquery.appear.js"></script>
    <script type="text/javascript" src="../js/count-to.js"></script>
    <script type="text/javascript" src="../js/jquery.textillate.js"></script>
    <script type="text/javascript" src="../js/jquery.lettering.js"></script>
    <script type="text/javascript" src="../js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../js/jquery.parallax.js"></script>
    <script type="text/javascript" src="../js/jquery.slicknav.js"></script>

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../css/checkbox.css" media="screen" />

    <!-- Notification -->
    <link rel="stylesheet" href="../css/notif.css"/>

    <script type="text/javascript" >
        $(document).ready(function()
        {
        $("#notificationLink").click(function()
        {
        $("#notificationContainer").fadeToggle(300);
        $("#notification_count").fadeOut("slow");
        return false;
        });

        //Document Click
        $(document).click(function()
        {
        $("#notificationContainer").hide();
        });
        //Popup Click
        $("#notificationContainer").click(function()
        {
        return false
        });

        });
    </script>
</head>

<body>
    <!-- Full Body Container -->
    <div id="container">
        <!-- Start Header Section -->
        <div class="hidden-header"></div>
        <header class="clearfix">
            <!-- Start Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <!-- Start Contact Info-->
                            <ul class="profile-name">
                                <li><i class="fa fa-hashtag"></i><b> 008-2012-0805</b></li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-5">
                            <!-- Notification -->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown icon-border" id="notificationLink">
                                    <span id="notification_count">3</span>
                                    <a href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i
                                            class="fa fa-bell"></i></a>
                                    <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                        <li class="dropdown-header"><label>Notification</label></li>
                                        <li class="disabled"><a href="#" tabindex="-1">No new notification.</a></li>
                                        <li><a href="#" tabindex="-1">The administrator accepted your request.</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../notification/notification.php" tabindex="-1">See All</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b>
                                        Welcome, <b><?php echo $cFirstName . " " . $cLastName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Profile <b class="fa fa-user" style="float:right;"></b></a></li>
                                        <li><a href="company-settings.php">Settings <b class="fa fa-cog"
                                                                                                   style="float:right;"></b></a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b
                                                    class="fa fa-sign-out" style="float:right;"></b></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- Notification -->
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
                        <a class="navbar-brand" href="index.html">
                            PlacementCell
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Modal -->
                        <div class="modal fade" id="Logout"
                             role="dialog">
                            <div class="modal-dialog" style="padding:100px">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Log out?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-15">
                                            <label>Do you want to log out?</label>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="logout.php"
                                               class="btn btn-primary">Log out</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sign-out -->
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="company.php">Home</a>
                            </li>
                            <li>
                                <a >Position</a>
                                <ul class="dropdown">
                                    <li><a href="company-positionlist.php">Position List</a></li>
                                    <li><a href="company-createposition.php" class = "active">Create Position</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="company-applicants.php">Applicant List</a>
                                <ul class="dropdown">
                                    <li><a href="company-pendingapplicants.php">Pending</a></li>
                                    <li><a href="company-acceptedapplicants.php">Accepted</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="company-settings.php">Settings</a>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
                <!-- Mobile Menu Start -->
                <ul class="wpb-mobile-menu">
                    <li>
                        <a href="company.php">Home</a>
                    </li>
                    <li>
                        <a>Position</a>
                        <ul class="dropdown">
                            <li><a href="company-positionlist.php">Position List</a></li>
                            <li><a class="active" href="company-createposition.php">Create Position</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Applicant List</a>
                        <ul class="dropdown">
                            <li><a href="company-pendingapplicants.php">Pending</a></li>
                            <li><a href="company-acceptedapplicants.php">Accepted</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="company-settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Edit Position</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Content -->
        <br><br><br>
        <form method="POST">
            <div class="container">
                <div class="col-md-12">
                    <div class="row">
                        <h3>Post Position</h3>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-3">
                                <label>Posting Date:</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From:</label><input type="date" name="DateFrom" id="date_from" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To:</label><input type="date" name="DateTo" id="date_to" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h3>Position Information</h3>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-3">
                                <label>Position Level:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select id="position" name="plevel" class="position form-control">
                                        <option value="" selected="selected">Select Position</option>
                                        <option value="top level management">Top Level Management</option>
                                        <option value="senior manager">Senior Manager</option>
                                        <option value="manager">Manager</option>
                                        <option value="supervisor">Senior Executive/ Supervisor</option>
                                        <option value="junior executive">Junior Executive</option>
                                        <option value="fresh">Fresh/Entry Level</option>
                                        <option value="non-executive">Non-Executive</option>
                                        <option value="trainee">Trainee</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Job Specialization:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select id="specialization" name="specialization" class="specialization form-control">
                                        <option value="" selected="selected"> Select Specialization</option>
                                        <option value="Actuarial Science"> Actuarial Science/ Statistics</option>
                                        <option value="Advertising"> Advertising/ Media Planning</option>
                                        <option value="Architecture"> Architecture/ Interior Design</option>
                                        <option value="Arts and Design">Arts and Design</option>
                                        <option value="Arts/ Creative"> Arts/ Creative/ Graphics Design</option>
                                        <option value="Aviation"> Aviation/ Aircraft Maintenance</option>
                                        <option value="Banking"> Banking/ Financial Services</option>
                                        <option value="Biotechnology"> Biotechnology</option>
                                        <option value="Call Center Agent"> Call Center Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Employment Type:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select id="state" name="etype" class="state form-control">
                                        <option value="select">Please select One</option>
                                        <option value="full">Full Time</option>
                                        <option value="parttime">Part Time</option>
                                        <option value="contract">Contract</option>
                                        <option value="temporary">Temporary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Available Position:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="avposition" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h3>Salary Range</h3>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-3">
                                <label>Range of Salary:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select id="salaryrange" name="salary" class="salaryrange form-control">
                                        <option value="" selected="selected"> Select Salary Range</option>
                                        <option value="10,000 - 15,000"> 10,000 - 15,000</option>
                                        <option value="15,000 - 20,000"> 15,000 - 20,000</option>
                                        <option value="20,000 - 25,000"> 20,000 - 25,000</option>
                                        <option value="25,000 - 30,000"> 25,000 - 30,000</option>
                                        <option value="30,000 - 40,000"> 30,000 - 40,000</option>
                                        <option value="40,000 - 45,000"> 40,000 - 45,000</option>
                                        <option value="45,000 - 50,000"> 45,000 - 50,000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h3> General Requirements</h3>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-3">
                                <label>Years of Experience:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="yexperience" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Training:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="training" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Knowledge in:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="knowledge" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h3> Optional Requirements</h3>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-3">
                                <label>Language:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                        <div class="text-center">
                            <button type="submit" class="btn-system btn-large" id="btnsave" name="btnsave">Save</button>
                            <button type="submit" class="btn-system btn-large btn-black" id="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--End of Content-->
        <script type="text/javascript" src="../js/script.js"></script>
    </div>
</body>
</html>