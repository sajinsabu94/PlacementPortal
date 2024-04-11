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
    <title>PlacementCell | Accepted Applicants</title>

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

    <!--CSS Styles  -->
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
        <!-- Start Header Section -->
        <div class="hidden-header"></div>
        <header class="clearfix">

            <!-- Start Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Start Contact Info -->
                            <ul class="contact-details">
                                <li class="profile-name"><b><?php echo $CompanyName; ?></b></li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-6">
                            <!-- Notification -->
                                <ul class="nav navbar-nav navbar-right">
                                    <!--noti
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
                                    </li>-->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b>
                                            Welcome, <b><?php echo $cFirstName . " " . $cLastName; ?> </b><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
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
                                            <label = "usr" class = "control-label">Do you want to sign out?</label>
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
                                <a href="company.php">Home</a>
                            </li>
                            <li>
                                <a>Position</a>
                                <ul class="dropdown">
                                    <li><a href="company-positionlist.php">Position List</a></li>
                                    <li><a href="company-createposition.php">Create Position</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="active">Applicant List</a>
                                <ul class="dropdown">
                                    <li><a href="company-pendingapplicants.php">Pending</a></li>
                                    <li><a href="company-acceptedapplicants.php" class="active">Accepted</a></li>
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
                            <li><a href="company-createposition.php">Create Position</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="active">Applicant List</a>
                        <ul class="dropdown">
                            <li><a href="company-pendingapplicants.php">Pending</a></li>
                            <li><a href="company-acceptedapplicants.php" class="active">Accepted</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="company-settings.php">Settings</a>
                    </li>
                </ul>
                <!-- Mobile Menu End -->
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        <!-- End Header Section -->

        <!-- Start Page Banner -->
        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>List of Accepted Applicants</h2>
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
                            <th width='20%' class='tabletitle'>Applicant Name</th>
                            <th width='17%' class='tabletitle'>Position</th>
                            <th width='20%' class='tabletitle'>Course</th>
                            <th width='13%' class='tabletitle'>Location</th>
                            <th width='15%' class='tabletitle'>Email</th>
                            <th width='15%' class='tabletitle'>Contact Number</th>
                            <th width='15%' class='tabletitle'>Date Submitted</th>
                            <th width='5%' class='tabletitle'>Remove</th>
                        <tr>
                    </thead>
                    <?php
                    $requesttocompany_tbl =
                        GSecureSQL::query(
                            "SELECT
                                  requesttocompanytbl.RID,
                                  requesttocompanytbl.StudentID,
                                  requesttocompanytbl.PositionID,
                                  requesttocompanytbl.Status,
                                  studentinfotbl.StudentID,
                                  studentinfotbl.FirstName,
                                  studentinfotbl.LastName,
                                  studentinfotbl.MajorCourse,
                                  studcontactstbl.StudentID,
                                  studcontactstbl.City,
                                  studcontactstbl.Email,
                                  comppositiontbl.PositionID,
                                  comppositiontbl.PositionLevel,
                                  requesttocompanytbl.DateSubmitted,
                                  studcontactstbl.MobileNumber
                                  FROM
                                  requesttocompanytbl
                                  INNER JOIN comppositiontbl ON requesttocompanytbl.PositionID = comppositiontbl.PositionID
                                  INNER JOIN studentinfotbl ON requesttocompanytbl.StudentID = studentinfotbl.StudentID
                                  INNER JOIN studcontactstbl ON studentinfotbl.StudentID = studcontactstbl.StudentID
                                  WHERE requesttocompanytbl.Status = 'Accepted' AND requesttocompanytbl.CompanyID = ?
                                  ",
                            TRUE,
                            "s",
                            $CompanyID
                        );
                    foreach ($requesttocompany_tbl as $value) {
                        $RID = $value[0];
                        $PositionLevel = $value[12];
                        $FirstName = $value[5];
                        $LastName = $value[6];
                        $MajorCourse = $value[7];
                        $Location = $value[9];
                        $Email = $value[10];
                        $DateSubmitted = $value[13];
                        $ContactNumber = $value[14];

                        $coursetbl =
                            GSecureSQL::query(
                                "SELECT CourseTitle FROM coursetbl WHERE CourseCode = ?",
                                TRUE,
                                "s",
                                $MajorCourse
                            );
                        foreach ($coursetbl as $value1) {
                            $MajorCourse = $value1[0];
                        }
                        ?>
                        <tbody>
                        <tr>
                            <td width='20%' class=tabletitle><a href=''><?php echo $LastName . ", " . $FirstName; ?></a></td>
                            <td width='17%' class=tabletitle><?php echo $PositionLevel; ?></td>
                            <td width='20%' class=tabletitle><?php echo $MajorCourse; ?></td>
                            <td width='12%' class=tabletitle><?php echo $Location; ?></td>
                            <td width='15%' class=tabletitle><?php echo $Email; ?></td>
                            <td width='15%' class=tabletitle><?php echo $ContactNumber; ?></td>
                            <td width='15%' class=tabletitle><?php echo $DateSubmitted; ?></td>
                            <td width="5%" class="tabletitle">
                                <button class='btn btn-danger' data-toggle='modal'
                                        data-target='#Delete<?php echo $RID; ?>'><i
                                        class='fa fa-trash fa-1x'></i></button>
                            </td>
                        <tr>
                        </tbody>
                        <!-- Modal -->
                        <form name="form_Delete" id="form_Delete"
                              action="add-company.php" autocomplete="off" method="POST">
                            <div class="modal fade" id="Delete<?php echo $RID; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Do you want to delete this
                                                applicant from the list?</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <input type="hidden" name="delete_applicant">
                                            <input type="hidden" name="rid" value="<?php echo $RID; ?>">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Accept</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
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
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>