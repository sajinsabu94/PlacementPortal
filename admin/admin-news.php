<?php
include('../connection.php');
session_start();

if(isset($_SESSION['AdminID'])){
    $AdminID = $_SESSION['AdminID'];
}else{
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
    <title>PlacementCell | List of News</title>

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

    <!-- Alert -->
    <script type="text/javascript">
        $(document).ready (function(){
        $("#success-alert").hide();
        $("#btnsave").click(function showAlert() {
            $("#success-alert").alert();
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
           $("#success-alert").alert('close');
                });   
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
                            <!-- Start Contact Info -->
                            <ul class="contact-details">
                                <li class="profile-name">
                            </ul>
                            <!-- End Contact Info -->
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
                                        <div class="col-md-15">
                                            <label>Do you want to Sign Out?</label>
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
                                <a class="active">Maintenance</a>
                                <ul class="dropdown">
                                    <li><a href="admin-maintenance.php">Courses</a></li>
                                    <li><a href="admin-users.php">Users</a></li>
                                    <li><a href="admin-calendar.php">Calendar Events</a></li>
                                    <li><a class="active" href="admin-news.php">News</a></li>
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
                                    <li><a href="admin-reports.php" class = "active">Alumni Reports</a></li>
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
                                <li><a class="active" href="admin-calendar.php">Calendar Events</a></li>
                                <li><a href="admin-news.php">News</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        <!-- Mobile Menu End -->

        <!-- Start Page Banner -->
        <div class="page-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>List of News</h2>
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

                        if ($id == 'addnews') {
                            echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> News successfully Added.</strong>
                            </div>
                            ';
                        } elseif ($id == 'updatenews') {
                            echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> News successfully Updated.</strong>
                            </div>
                            ';
                        } elseif ($id == 'deletenews') {
                            echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> News successfully deleted.</strong> 
                            </div>
                            ';
                        }
                    } 
                ?>

                <div class="row">
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <a href="admin-createnews.php" class="main-button" style="float:right;">
                            <span class="fa fa-pencil-square-o fa-1x"></span> Create a News 
                        </a>
                    </div>
                </div>

                <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                <div class="hr2"></div>
                <table class="table segment table-hover">
                    <thead>
                        <tr>
                            <th width="25%">News</th>
                            <th width="20%">Date</th>
                            <th width="20%">Location</th>
                            <th width="25%">Caption</th>
                            <th width="10%"></th>
                        <tr>
                    </thead>
                    <tbody>
                        <?php
                            $adminnews_tbl =
                                GSecureSQL::query(
                                    "SELECT * FROM adminnewstbl WHERE `AdminID` = ?",
                                    TRUE,
                                    "s",
                                    $AdminID
                                );
                            foreach ($adminnews_tbl as $value) {
                            $NewsID = $value[0];
                            $newstitle = $value[2];
                            $newsdate = $value[3];
                            $newslocation = $value[4];
                            $newscaption = $value[5];
                            
                        ?>
                        <tr>
                            <td width="25%"><?php echo $newstitle;?></td>
                            <td width="20%"><?php echo $newsdate; ?></td>
                            <td width="20%"><?php echo $newslocation; ?></td>
                            <td width="25%"><?php echo $newscaption;?></td>
                            <td width="10%" class="text-center">
                                <button class="btn btn-default" data-toggle="modal"
                                    data-target="#EditEvent<?php echo $NewsID; ?>">
                                    <i class="fa fa-pencil-square-o fa-1x"></i>
                                </button>
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#DeleteEvent<?php echo $NewsID; ?>">
                                    <i class="fa fa-trash fa-1x"></i>
                                </button> 
                           </td>
                        </tr>
                        <!-- Edit Modal-->
                        <div class="modal fade" id="EditEvent<?php echo $NewsID; ?>" role="dialog">
                            <div class="modal-dialog modal-lg" style="padding:100px">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Event?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="functions.php ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>News Date:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class = "form-group">
                                                                <label><p><?php echo $newsdate; ?></p></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>News Title:</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" name="NewsTitle" id="NewsTitle" class="form-control" value="<?php echo $newstitle; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>News Location</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" name="NewsLocation" id="NewsLocation" class="form-control" value="<?php echo $newslocation; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>News Caption</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="NewsCaption" name="NewsCaption" value="<?php echo $newscaption; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="NewsID" value="<?php echo $NewsID; ?>">
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
                        <!-- Delete Modal-->
                        <div class="modal fade" id="DeleteEvent<?php echo $NewsID; ?>"
                         role="dialog">
                            <div class="modal-dialog" style="padding:100px">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Delete Event?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-15">
                                            <label>Do you want to delete
                                            <?php echo $newstitle; ?> ? This cannot be undone.</label>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="admin-delete.php?delete_NewsID=<?php echo $NewsID; ?>"
                                               class="btn btn-danger">Delete</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal--> 
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
</body>


</html>