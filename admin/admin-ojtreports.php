<?php
include('../connection.php');
session_start();

if (isset($_SESSION['AdminID'])) {
    $AdminID = $_SESSION['AdminID'];
} else {
    header("location: ../login-admin.php");
}

$SearchBy_Default = isset($_GET['SearchBy']) ? $_GET['SearchBy'] : '';
$Search_Default = isset($_GET['Search']) ? $_GET['Search'] : '';

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName FROM admintbl WHERE AdminID = ?",
        TRUE,
        "s",
        $AdminID
    );

$cFirstName = $infoquery[0][0];

?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | OJT Reports</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="PlacementCell">
    <link rel="shortcut icon" href="../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    <!-- BootstrapValidator -->
    <script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../js/modernizrr.js"></script>
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

    <link rel="stylesheet" href="../css/checkbox.css"/>

    <!-- Notification -->
    <link rel="stylesheet" href="../css/notif.css"/>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#notificationLink").click(function () {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                return false;
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
    <!-- Full Body Container -->
    <div id="container">
        <div class="hidden-header"></div>
        <header class="clearfix">
            <!-- Start Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            &nbsp;
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-5">
                            <!-- Notification -->
                            <ul class="nav navbar-nav navbar-right">
                                <!--<li class="dropdown icon-border" id="notificationLink">
                                    <span id="notification_count">3</span>
                                    <a href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i
                                            class="fa fa-bell"></i></a>
                                    <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                        <li class="dropdown-header"><label>Notification</label></li>
                                        <li class="disabled"><a href="#" tabindex="-1">No new notification.</a></li>
                                        <li><a href="#" tabindex="-1">This is a notification.</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../notification/notification.php" tabindex="-1">See All</a></li>
                                    </ul>
                                </li>-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b>
                                        Welcome, <b>Admin <?php echo $cFirstName; ?></b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="admin-account.php">Account <b class="fa fa-user"
                                                                                   style="float:right;"></b></a></li>
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
                        <a class="navbar-brand" href="">
                            <img src="../images/PlacementCell.png">
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
                                        <h4 class="modal-title">Sign Out</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-15 fieldcol">
                                            <label = "usr" class = "control-label">Do you want to Sign Out?</label>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="logout.php"
                                               class="btn btn-primary">Sign Out</a>
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
                                <a href="admin.php">Home</a>
                            </li>
                            <li>
                                <a class="active">Reports</a>
                                <ul class="dropdown">
                                    <li><a href="admin-reports.php">Alumni Reports</a></li>
                                    <li><a href="admin-ojtreports.php" class="active">OJT Reports</a></li>
                                </ul>
                            </li>
                            <!--<li>
                                <a href="admin-account.php">Account</a>
                            </li>-->
                            <li>
                                <a href="admin-requested.php">Requested</a>
                            </li>
                            <li>
                                <a>Company List</a>
                                <ul class="dropdown">
                                    <li><a href="admin-companylist.php">Active</a></li>
                                    <li><a href="admin-company_pending.php">Pending</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="job-fair.php">Job Fair</a>
                            </li>
                            <li>
                                <a> Maintenance</a>
                                <ul class="dropdown">
                                    <li><a href="admin-maintenance.php">Courses</a></li>
                                    <li><a href="admin-users.php">Users</a></li>
                                    <li><a href="admin-calendar.php">Calendar Events</a></li>
                                    <li><a href="admin-news.php">News</a></li>
                                    <li><a href="admin-contact.php">Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
                <!-- Mobile Menu Start -->
                <ul class="wpb-mobile-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="admin.php">Home</a>
                        </li>
                        <li>
                            <a>Reports</a>
                            <ul class="dropdown">
                                <li><a href="admin-reports.php">Alumni Reports</a></li>
                                <li><a href="admin-ojtreports.php" class="active">OJT Reports</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="admin-account.php">Account</a>
                        </li>
                        <li>
                            <a href="admin-requested.php">Requested</a>
                        </li>
                        <li>
                            <a>Company List</a>
                            <ul class="dropdown">
                                <li><a href="admin-companylist.php">Active</a></li>
                                <li><a href="admin-company_pending.php">Pending</a></li>
                            </ul>
                        </li>
                        <li>
                            <a> Maintenance</a>
                            <ul class="dropdown">
                                <li><a href="admin-maintenance.php">Courses</a></li>
                                <li><a href="admin-users.php">Users</a></li>
                                <li><a href="admin-calendar.php">Calendar Events</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        <!-- End Header Section -->

        <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>OJT Reports</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div id="content">
            <div class="container">
            <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    if ($id == 1) {
                        echo '
                                <div class="alert alert-success" id="success-alert" width = "70%">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><span class="fa fa-info-circle"></span> OJT student account updated.</strong>
                                </div>
                                ';
                    } 
                }
            ?>
                <div class="row">
                    <div class="col-sm-4">
                        <h4 style="margin-top:20px;">TOTAL NUMBER OF STUDENTS:</b></h4>
                    </div>
                    <form method="GET" autocomplete="off">
                        <div class="col-sm-3">
                            <label>
                                <center><b>Search by: </b></center>
                            </label>
                            <select name="SearchBy" class="form-control" style="width:250px;">
                                <option value="StudentID" <?php if ($SearchBy_Default == "StudentID") {
                                    echo "selected='selected'";
                                } ?>>Student ID
                                </option>
                                <option value="Name" <?php if ($SearchBy_Default == "Name") {
                                    echo "selected='selected'";
                                } ?>>Name
                                </option>
                                <option value="Course" <?php if ($SearchBy_Default == "Course") {
                                    echo "selected='selected'";
                                } ?>>Course
                                </option>
                                <option value="Company" <?php if ($SearchBy_Default == "Company") {
                                    echo "selected='selected'";
                                } ?>>Company
                                </option>
                                <option value="Remarks" <?php if ($SearchBy_Default == "Remarks") {
                                    echo "selected='selected'";
                                } ?>>Remarks
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>
                                <center><b>Search: </b></center>
                            </label>
                            <input type="text" class="form-control" name="Search" <?php echo "value=$Search_Default"; ?>>
                        </div>
                        <div class="col-sm-2">
                            <button name="btnSearch" type="submit" class="btn-system btn-large border-btn"
                                    style="margin-top: 20px;">Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="hr1" style="margin-bottom:20px;margin-top:20px;"></div>

                <div class="scrollable-table">
                    <div class="hr2"></div>
                    <table class="table table-striped table-header-rotated table-hover">
                        <thead>
                            <tr>
                                <!-- First column header is not rotated -->
                                <th width="15%">Student No.</th>
                                <th width="20%">Name</th>
                                <th width="20%">Course</th>
                                <th width="20%">Company</th>
                                <th width="30%">Address</th>
                                <th width="10%">Remarks</th>
                                <th width="10%">Adviser</th>
                                <!-- Following headers are rotated -->
                                <th class="rotate-45">
                                    <div><span>Hours</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Endorsement</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>DTR</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Waiver</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Training Plan</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>MOA</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Journal</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Integration</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>PAF</span></div>
                                </th>
                                <th class="rotate-45">
                                    <div><span>Certificate</span></div>
                                </th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <?php
                        if (isset($_GET['btnSearch'])) {
                            $SearchBy = $_GET['SearchBy'];
                            $Search = $_GET['Search'];

                            if ($SearchBy == "StudentID") {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl WHERE StudentID LIKE '$Search%' ORDER BY StudentID",
                                        TRUE
                                    );
                            } elseif ($SearchBy == "Name") {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl WHERE FirstName LIKE '$Search%' OR MiddleName LIKE '$Search%'
                                        OR LastName LIKE '$Search%'
                                        ORDER BY LastName",
                                        TRUE
                                    );
                            } elseif ($SearchBy == "Course") {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl WHERE Course LIKE '%$Search%' ORDER BY Course",
                                        TRUE
                                    );
                            } elseif ($SearchBy == "Company") {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl WHERE CompanyName LIKE '%$Search%'
                                        ORDER BY CompanyName",
                                        TRUE
                                    );
                            } elseif ($SearchBy == "Remarks") {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl WHERE Remarks LIKE '$Search%'
                                        ORDER BY Remarks",
                                        TRUE
                                    );
                            } else {
                                $ojtlist_tbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM ojttbl ORDER BY StudentID DESC",
                                        TRUE
                                    );
                            }
                            foreach ($ojtlist_tbl as $value) {
                                $StudentID = $value[1];
                                $LastName = $value[2];
                                $FirstName = $value[3];
                                $MiddleName = $value[4];
                                $Course = $value[5];
                                $CompanyName = $value[6];
                                $CompanyAddress = $value[7];
                                $Supervisor = $value[8];
                                $Position = $value[9];
                                $ContactNumber = $value[10];
                                $Email = $value[11];
                                $Remarks = $value[12];
                                $Hours = $value[13];
                                $Endorsement = $value[14];
                                $DTR = $value[15];
                                $Waiver = $value[16];
                                $TrainingPlan = $value[17];
                                $MOA = $value[18];
                                $Journal = $value[19];
                                $Integration = $value[20];
                                $PAF = $value[21];
                                $Certification = $value[22];
                                $adviser_tbl =
                                    GSecureSQL::query(
                                        "SELECT FirstName, LastName FROM admintbl where AdminID = ?",
                                        TRUE,
                                        "s",
                                        $AdminID
                                    );
                                $aFirstName = $adviser_tbl[0][0];
                                $aLastName = $adviser_tbl[0][1];
                                $aFullName = $aFirstName . " " . $aLastName;
                                $FullName = $LastName . ", " . $FirstName . " " . $MiddleName;

                                ?>
                                <tbody>
                                <tr>
                                    <td width="15%"><?php echo $StudentID; ?></td>
                                    <td width="20%"><?php echo $FullName; ?></td>
                                    <td width="20%"><?php echo $Course; ?></td>
                                    <td width="20%"><?php echo $CompanyName; ?></td>
                                    <td width="30%"><?php echo $CompanyAddress; ?></td>
                                    <td width="10%"><?php echo $Remarks; ?></td>
                                    <td width="10%"><?php echo $aFullName; ?></td>
                                    <td width="10%"><?php echo $Hours; ?></td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Endorsement == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($DTR == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Waiver == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($TrainingPlan == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($MOA == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Journal == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Integration == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($PAF == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Certification == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class='btn btn-default' data-toggle='modal'
                                                data-target='#EditInfo<?php echo $StudentID; ?>'>
                                            <i class="fa fa-pencil-square-o fa-1x"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                                <!-- Modal -->
                                <form class="ModalForm" id="ModalForm" action="functions.php" method="POST">
                                    <div class='modal fade' id='EditInfo<?php echo $StudentID; ?>' role='dialog'>
                                        <div class='modal-dialog' style='padding:100px'>
                                            <!-- Modal content-->
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close'
                                                            data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Update OJT Info</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <div class='col-md-15 fieldcol'>
                                                        <ul>
                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="hidden" value="<?php echo $StudentID; ?>"
                                                                           name="StudentID">
                                                                    <label> Student
                                                                        Name: <?php echo $FullName; ?></label><br>
                                                                    <label> Course: <?php echo $Course; ?></label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Company </label><br>
                                                                    <input type="text" class="form-control" id="Company"
                                                                           name="Company"
                                                                           value="<?php echo $CompanyName; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Company Address </label><br>
                                                                    <input type="text" class="form-control"
                                                                           id="CompanyAddress"
                                                                           name="CompanyAddress"
                                                                           value="<?php echo $CompanyAddress; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Position </label><br>
                                                                    <input type="text" class="form-control" id="Position"
                                                                           name="Position"
                                                                           value="<?php echo $Position; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Supervisor </label><br>
                                                                    <input type="text" class="form-control" id="Supervisor"
                                                                           name="Supervisor"
                                                                           value="<?php echo $Supervisor; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Remarks </label><br>
                                                                    <select class="form-control" name="Remarks"
                                                                            id="Remarks">
                                                                        <option value="">- Select Remarks -</option>
                                                                        <option value="INC" <?php if ($Remarks == "INC") {
                                                                            echo "selected='selected'";
                                                                        } ?>>INC
                                                                        </option>
                                                                        <option
                                                                            value="Finished" <?php if ($Remarks == "Finished") {
                                                                            echo "selected='selected'";
                                                                        } ?>>Finished
                                                                        </option>
                                                                        <option
                                                                            value="On Going" <?php if ($Remarks == "On Going") {
                                                                            echo "selected='selected'";
                                                                        } ?>>On Going
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Hours </label><br>
                                                                    <input type="text" class="form-control" id="Hours"
                                                                           name="Hours"
                                                                           value="<?php echo $Hours; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <br><label> Requirements</label><br>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <input id="Endorsement" name="Endorsement" value="on"
                                                                           class="styled" <?php if ($Endorsement == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Endorsement</label>
                                                                </div>
                                                                <input name="EndorsementHidden" value="off" type='hidden'>

                                                                <div class="checkbox">
                                                                    <input id="DTR" name="DTR" value="on"
                                                                           class="styled" <?php if ($DTR == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">DTR</label>
                                                                    <input name="DTRHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Waiver" name="Waiver" value="on"
                                                                           class="styled" <?php if ($Waiver == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Waiver</label>
                                                                    <input name="WaiverHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="TrainingPlan" name="TrainingPlan" value="on"
                                                                           class="styled" <?php if ($TrainingPlan == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Training Plan</label>
                                                                    <input name="TrainingPlanHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="MOA" name="MOA" value="on"
                                                                           class="styled" <?php if ($MOA == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">MOA</label>
                                                                    <input name="MOAHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Journal" name="Journal" value="on"
                                                                           class="styled" <?php if ($Journal == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Journal</label>
                                                                    <input name="JournalHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Integration" name="Integration" value="on"
                                                                           class="styled" <?php if ($Integration == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Integration</label>
                                                                    <input name="IntegrationHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="PAF" name="PAF" value="on"
                                                                           class="styled" <?php if ($PAF == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">PAF</label>
                                                                    <input name="PAFHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Certification" name="Certification"
                                                                           value="on"
                                                                           class="styled" <?php if ($Certification == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Certification</label>
                                                                    <input name="CertificationHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                            </li>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="desination"
                                                       value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>

                                                <div class='modal-footer'>
                                                    <button type="submit"
                                                            class='btn btn-primary'> Update
                                                    </button>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                <?php
                            }
                        } else {
                            $ojtlist_tbl =
                                GSecureSQL::query(
                                    "SELECT * FROM ojttbl ORDER BY LastName ASC",
                                    TRUE
                                );
                            foreach ($ojtlist_tbl as $value) {
                                $StudentID = $value[1];
                                $LastName = $value[2];
                                $FirstName = $value[3];
                                $MiddleName = $value[4];
                                $Course = $value[5];
                                $CompanyName = $value[6];
                                $CompanyAddress = $value[7];
                                $Supervisor = $value[8];
                                $Position = $value[9];
                                $ContactNumber = $value[10];
                                $Email = $value[11];
                                $Remarks = $value[12];
                                $Hours = $value[13];
                                $Endorsement = $value[14];
                                $DTR = $value[15];
                                $Waiver = $value[16];
                                $TrainingPlan = $value[17];
                                $MOA = $value[18];
                                $Journal = $value[19];
                                $Integration = $value[20];
                                $PAF = $value[21];
                                $Certification = $value[22];
                                $adviser_tbl =
                                    GSecureSQL::query(
                                        "SELECT FirstName, LastName FROM admintbl where AdminID = ?",
                                        TRUE,
                                        "s",
                                        $AdminID
                                    );
                                $aFirstName = $adviser_tbl[0][0];
                                $aLastName = $adviser_tbl[0][1];
                                $aFullName = $aFirstName . " " . $aLastName;
                                $FullName = $LastName . ", " . $FirstName . " " . $MiddleName;

                                ?>
                                <tbody>
                                <tr>
                                    <td width="15%"><?php echo $StudentID; ?></td>
                                    <td width="20%"><?php echo $FullName; ?></td>
                                    <td width="20%"><?php echo $Course; ?></td>
                                    <td width="20%"><?php echo $CompanyName; ?></td>
                                    <td width="30%"><?php echo $CompanyAddress; ?></td>
                                    <td width="10%"><?php echo $Remarks; ?></td>
                                    <td width="10%"><?php echo $aFullName; ?></td>
                                    <td width="10%"><?php echo $Hours; ?></td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Endorsement == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($DTR == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Waiver == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($TrainingPlan == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($MOA == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Journal == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Integration == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($PAF == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <input class="styled" <?php if ($Certification == "on") {
                                                echo "checked";
                                            } ?> type="checkbox" disabled>
                                            <label for=""></label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class='btn btn-default' data-toggle='modal'
                                                data-target='#EditInfo<?php echo $StudentID; ?>'>
                                            <i class="fa fa-pencil-square-o fa-1x"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                                <!-- Modal -->
                                <form class="ModalForm" id="ModalForm" action="functions.php" method="POST">
                                    <div class='modal fade' id='EditInfo<?php echo $StudentID; ?>' role='dialog'>
                                        <div class='modal-dialog' style='padding:100px'>
                                            <!-- Modal content-->
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close'
                                                            data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Update OJT Info</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <div class='col-md-15 fieldcol'>
                                                        <ul>
                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="hidden" value="<?php echo $StudentID; ?>"
                                                                           name="StudentID">
                                                                    <label> Student
                                                                        Name: <?php echo $FullName; ?></label><br>
                                                                    <label> Course: <?php echo $Course; ?></label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Company </label><br>
                                                                    <input type="text" class="form-control" id="Company"
                                                                           name="Company"
                                                                           value="<?php echo $CompanyName; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Company Address </label><br>
                                                                    <input type="text" class="form-control"
                                                                           id="CompanyAddress"
                                                                           name="CompanyAddress"
                                                                           value="<?php echo $CompanyAddress; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Position </label><br>
                                                                    <input type="text" class="form-control" id="Position"
                                                                           name="Position"
                                                                           value="<?php echo $Position; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Supervisor </label><br>
                                                                    <input type="text" class="form-control" id="Supervisor"
                                                                           name="Supervisor"
                                                                           value="<?php echo $Supervisor; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Remarks </label><br>
                                                                    <select class="form-control" name="Remarks"
                                                                            id="Remarks">
                                                                        <option value="">- Select Remarks -</option>
                                                                        <option value="INC" <?php if ($Remarks == "INC") {
                                                                            echo "selected='selected'";
                                                                        } ?>>INC
                                                                        </option>
                                                                        <option
                                                                            value="Finished" <?php if ($Remarks == "Finished") {
                                                                            echo "selected='selected'";
                                                                        } ?>>Finished
                                                                        </option>
                                                                        <option
                                                                            value="On Going" <?php if ($Remarks == "On Going") {
                                                                            echo "selected='selected'";
                                                                        } ?>>On Going
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <label> Hours </label><br>
                                                                    <input type="text" class="form-control" id="Hours"
                                                                           name="Hours"
                                                                           value="<?php echo $Hours; ?>">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <br><label> Requirements</label><br>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <input id="Endorsement" name="Endorsement" value="on"
                                                                           class="styled" <?php if ($Endorsement == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Endorsement</label>
                                                                </div>
                                                                <input name="EndorsementHidden" value="off" type='hidden'>

                                                                <div class="checkbox">
                                                                    <input id="DTR" name="DTR" value="on"
                                                                           class="styled" <?php if ($DTR == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">DTR</label>
                                                                    <input name="DTRHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Waiver" name="Waiver" value="on"
                                                                           class="styled" <?php if ($Waiver == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Waiver</label>
                                                                    <input name="WaiverHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="TrainingPlan" name="TrainingPlan" value="on"
                                                                           class="styled" <?php if ($TrainingPlan == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Training Plan</label>
                                                                    <input name="TrainingPlanHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="MOA" name="MOA" value="on"
                                                                           class="styled" <?php if ($MOA == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">MOA</label>
                                                                    <input name="MOAHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Journal" name="Journal" value="on"
                                                                           class="styled" <?php if ($Journal == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Journal</label>
                                                                    <input name="JournalHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Integration" name="Integration" value="on"
                                                                           class="styled" <?php if ($Integration == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Integration</label>
                                                                    <input name="IntegrationHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="PAF" name="PAF" value="on"
                                                                           class="styled" <?php if ($PAF == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">PAF</label>
                                                                    <input name="PAFHidden" value="off" type='hidden'>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <input id="Certification" name="Certification"
                                                                           value="on"
                                                                           class="styled" <?php if ($Certification == "on") {
                                                                        echo "checked";
                                                                    } ?> type="checkbox">
                                                                    <label for="">Certification</label>
                                                                    <input name="CertificationHidden" value="off"
                                                                           type='hidden'>
                                                                </div>
                                                            </li>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="desination"
                                                       value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>

                                                <div class='modal-footer'>
                                                    <button type="submit"
                                                            class='btn btn-primary'> Update
                                                    </button>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Go To Top Link -->
        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    </div>
</body>
<script type="text/javascript" src="../js/script.js"></script>
</html>