<?php
include('../connection.php');
session_start();

if(isset($_SESSION['AdminID'])){
    $AdminID = $_SESSION['AdminID'];
}else{
    header("location: ../login-admin.php");
}

$CourseID = $_GET['id'];

$course_tbl =
    GSecureSQL::query(
        "SELECT * FROM coursetbl WHERE CourseID = ?",
        TRUE,
        "s",
        $CourseID
    );
$CourseTitle = $course_tbl[0][1];
$CourseCode = $course_tbl[0][2];

$studentinfo_tbl =
    GSecureSQL::query(
        "SELECT COUNT(*) FROM studentinfotbl WHERE MajorCourse=?",
        TRUE,
        "s",
        $CourseCode
    );
$Total = $studentinfo_tbl[0][0];

$work_tbl =
    GSecureSQL::query(
        "SELECT StudentID, DateToYear FROM workexperiencetbl",
        TRUE
    );
$count = 0;
foreach($work_tbl as $value){
    $StudentID = $value[0];
    $DateToYear = $value[1];

    if($DateToYear=="Current"){
        $count++;
    }
    if ($count == 0) {
        GSecureSQL::query(
            "UPDATE studentinfotbl SET EmploymentStatus = 'Unemployed' WHERE StudentID = ?",
            FALSE,
            "s",
            $StudentID
        );
    } else {
        GSecureSQL::query(
            "UPDATE studentinfotbl SET EmploymentStatus = 'Employed' WHERE StudentID = ?",
            FALSE,
            "s",
            $StudentID
        );
    }
}

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName FROM admintbl WHERE AdminID = ?",
        TRUE,
        "s",
        $AdminID
    );

$aFirstName = $infoquery[0][0];

?>
<!doctype html>
<html lang="en">
<head>

    <!-- Basic -->
    <title>PlacementCell | Reports</title>

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
                        <div class="col-md-6">
                             &nbsp;   
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-6">
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b> Welcome, <b>Admin <?php echo $aFirstName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="admin-account.php">Account <b class="fa fa-user" style="float:right;"></b></a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b class="fa fa-sign-out" style="float:right;"></b></a></li>
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
                                            <label = "usr" class = "control-label">Do you want to Sign Out?</label>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="logout.php"
                                               class="btn btn-primary">Sign out</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="admin.php">Home</a>
                            </li>
                            <li>
                                <a class="active">Reports</a>
                                <ul class="dropdown">
                                    <li><a href="admin-reports.php">Alumni Reports</a></li>
                                    <li><a href="admin-ojtreports.php">OJT Reports</a></li>
                                </ul>
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
                                <a>Maintenance</a>
                                <ul class="dropdown">
                                    <li><a href="admin-maintenance.php">Courses</a></li>
                                    <li><a href="admin-users.php">Users</a></li>
                                    <li><a href="admin-calendar.php">Calendar Events</a></li>
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
                            <a class="active" href="admin.php">Home</a>
                        </li>
                        <li>
                            <a>Reports</a>
                            <ul class="dropdown">
                                <li><a href="admin-reports.php">Alumni Reports</a></li>
                                <li><a href="admin-ojtreports.php">OJT Reports</a></li>
                            </ul>
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
                            <a>Maintenance</a>
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
        <!-- Mobile Menu End -->

        <!-- Start Page Banner -->
        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Reports</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h5><?php echo $CourseTitle; ?><h5>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group text-center">
                            <a href="#" class="main-button" style="float:right;">
                                <span class="fa fa-download"></span> Export XLS
                            </a>
                        </div>
                    </div>
                </div>

                <div class="hr1" style="margin-top:30px;"></div>

                <div class="row">
                    <div class="col-md-4">
                        <strong>TOTAL NUMBER OF STUDENTS: <?php echo $Total; ?></strong>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name= id= "" class="form-control" value="" placeholder="Enter Student Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn-system btn-large border-btn" href="#">Search</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4"><strong>Select Employment Status</strong></div>
                    <div class="col-md-4">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <select id="status" name="status" class="form-control">
                            <option value="pos">Select One</option>
                            <option value="emp">Employed</option>
                            <option value="unemp">Unemployed</option>
                        </select></div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn-system btn-large border-btn" href="#">Filter</button>
                    </div>
                </div>
                         
                <div class="hr2" style="margin-top:20px;"></div>
                <table class="table segment table-hover">
                    <thead>
                        <tr>
                            <th width="25%"> Student Name</th>
                            <th width="15%"> Position Level</th>
                            <th width="20%"> Specialization</th>
                            <th width="15%"> Industry</th>
                            <th width="20%"> Employment Status</th>
                            <!--
                            <th width="5%"></th>
                            -->
                        <tr>
                    </thead>
                    <?php
                        $studentinfocourse_tbl =
                            GSecureSQL::query(
                                "SELECT
                                StudentID,
                                FirstName,
                                LastName,
                                EmploymentStatus
                                FROM studentinfotbl
                                WHERE MajorCourse = ?
                                ORDER BY LastName ASC",
                                TRUE,
                                "s",
                                $CourseCode
                            );
                        foreach ($studentinfocourse_tbl as $value) {
                            $StudentID = $value[0];
                            $FirstName = $value[1];
                            $LastName = $value[2];
                            $FullName = $LastName . ", " . $FirstName;
                            $EmploymentStatus = $value[3];

                            $positionlevel_tbl =
                                GSecureSQL::query(
                                    "SELECT PositionLevel FROM workexperiencetbl WHERE StudentID = ? LIMIT 1",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );
                            $specialization_tbl =
                                GSecureSQL::query(
                                    "SELECT Specialization FROM workexperiencetbl WHERE StudentID = ? LIMIT 1",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );
                            $industry_tbl =
                                GSecureSQL::query(
                                    "SELECT Industry FROM workexperiencetbl WHERE StudentID = ? LIMIT 1",
                                    TRUE,
                                    "s",
                                    $StudentID
                                );

                            $positionlevel_tbl = array_reduce($positionlevel_tbl, 'array_merge', array());
                            $specialization_tbl = array_reduce($specialization_tbl, 'array_merge', array());
                            $industry_tbl = array_reduce($industry_tbl, 'array_merge', array());

                            $PositionLevel = implode(", ", $positionlevel_tbl);
                            $Specialization = implode(", ", $specialization_tbl);
                            $Industry = implode(", ", $industry_tbl);
                        ?>
                    <tbody>
                        <tr>
                            <td>
                                <a href = '#'><?php echo $FullName; ?></a>
                            </td>
                            <td class = 'tcenter'><?php echo $PositionLevel; ?></td>
                            <td class = 'tcenter'><?php echo $Specialization; ?></td>
                            <td class = 'tcenter'><?php echo $Industry; ?></td>
                            <td class = 'tcenter'><?php echo $EmploymentStatus; ?></td>
                            <!--
                            <td>
                                <button class="btn btn-default" data-toggle="modal"
                                    data-target="#ViewWork">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                            -->
                        </tr>
                        <!-- Edit Modal-->
                        <div class="modal fade" id="ViewWork<?php echo $StudentID; ?>" role="dialog">
                            <div class="modal-dialog modal-lg" style="padding:100px">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Work View</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="functions.php ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Company Name:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class = "form-group">
                                                                <label><p><?php echo $datefrom; ?></p></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Position Level:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class = "form-group">
                                                                <label><p><?php echo $dateto; ?></p></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Employment Type:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class = "form-group">
                                                                <label><p><?php echo $dateto; ?></p></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Date:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class = "form-group">
                                                                <label><p><?php echo $dateto; ?></p></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="btnUpdateEvent">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal-->
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/script.js"></script>
</html>