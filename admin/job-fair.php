<?php
include('../connection.php');
session_start();

if (isset($_SESSION['AdminID'])) {
    $AdminID = $_SESSION['AdminID'];
} else {
    header("location: ../login-admin.php");
}

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName FROM admintbl WHERE AdminID = ?",
        TRUE,
        "s",
        $AdminID
    );

$FirstName = $infoquery[0][0];

?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Job Fair</title>

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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b> Welcome, <b>Admin <?php echo $FirstName; ?> </b><b class="caret"></b></a>
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
                            <a>Reports</a>
                            <ul class="dropdown">
                                <li><a href="admin-reports.php">Alumni Reports</a></li>
                                <li><a href="admin-ojtreports.php">OJT Reports</a></li>
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
                            <a class="active" href="job-fair.php">Job Fair</a>
                        </li>
                        <li>
                            <a>Maintenance</a>
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
                <li>
                    <a href="admin.php">Home</a>
                </li>
                <li>
                    <a>Reports</a>
                    <ul class="dropdown">
                        <li><a href="admin-reports.php" class="active">Alumni Reports</a></li>
                        <li><a href="admin-ojtreports.php">OJT Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="admin-account.php">Account</a>
                </li>
                <li>
                    <a href="admin-requested.php">Requested</a>
                </li>
                <li>
                    <a class="active">Company List</a>
                    <ul class="dropdown">
                        <li><a href="admin-companylist.php">Active</a></li>
                        <li><a class="active" href="admin-company_pending.php">Pending</a></li>
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
        </div>
        <!-- End Header Logo & Naviagtion -->
    </header>
    <!-- End Header Section -->

    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>List of Company</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <div id="content">
        <div class="container">
            <div class="hr2"></div>
            <table class="table segment table-hover">
                <thead>
                <tr>
                    <th width="15%">Company Name</th>
                    <th width="10%">Location</th>
                    <th width="15%">Industry</th>
                    <th width="15%">Website</th>
                    <th width="10%">Email</th>
                    <th width="15%">Contact Person</th>
                    <th width="10%">Contact No.</th>
                    <th width="10%"></th>
                <tr>
                </thead>
                <tbody>
                <?php
                $JobFairParticpants =
                    GSecureSQL::query(
                        "SELECT id, CompanyName, City, Industry, Website, Email, ContactPerson, Phone1, Phone2, Phone3 FROM jobfairtbl",
                        TRUE
                    );
                foreach ($JobFairParticpants as $value){
                $JobID = $value[0];
                $CompanyName = $value[1];
                $Location = $value[2];
                $Industry = $value[3];
                $Website = $value[4];
                $Email = $value[5];
                $ContactPerson = $value[6];
                $Phone1 = $value[7];
                $Phone2 = $value[8];
                $Phone3 = $value[9];

                if (!empty($Phone2) && empty($Phone3)) {
                    $ContactNumber = $Phone1 . ", " . $Phone2;
                } elseif (!empty($Phone3) && empty($Phone2)) {
                    $ContactNumber = $Phone1 . ", " . $Phone3;
                } elseif (!empty($Phone2) && !empty($Phone3)) {
                    $ContactNumber = $Phone1 . ", " . $Phone2 . ", " . $Phone3;
                } else {
                    $ContactNumber = $Phone1;
                }
                ?>
                <tr>
                    <td width="15%"><?php echo $CompanyName; ?></td>
                    <td width="10%"><?php echo $Location; ?></td>
                    <td width="15%"><?php echo $Industry; ?></td>
                    <td width="15%"><?php echo $Website; ?></td>
                    <td width="10%"><?php echo $Email; ?></td>
                    <td width="15%"><?php echo $ContactPerson; ?></td>
                    <td width="10%"><?php echo $ContactNumber; ?></td>
                    <td width="10%">
                        <form method="POST" action="job-fair-data.php">
                            <input type="hidden" name="JobID" value="<?php echo $JobID; ?>">
                            <button class='btn btn-default'><i class='fa fa-eye'></i></button>
                            <a class="btn btn-danger" data-toggle="modal"
                                    data-target="#DeleteJob<?php echo $JobID; ?>">
                                <i class="fa fa-trash fa-1x"></i>
                            </a>
                        </form>
                    </td>
                <tr>
                    <!-- Modal -->
                    <div class="modal fade" id="DeleteJob<?php echo $JobID; ?>" role="dialog">
                        <div class="modal-dialog" style="padding:160px;width:50%">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete?</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-15 fieldcol">
                                        <label = "usr" class = "control-label">Do you want to delete this
                                        information? This cannot be undone.</label>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="functions.php?deletePID=<?php echo $JobID; ?>"
                                           class="btn btn-danger">Delete</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
</div>
</body>
<script type="text/javascript" src="../js/script.js"></script>
</html>