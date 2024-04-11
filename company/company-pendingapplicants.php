<?php
include('../connection.php');
session_start();


if (isset($_SESSION['CompanyID'])) {
    $CompanyID = $_SESSION['CompanyID'];
} else {
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
    <title>PlacementCell | Pending Applicants</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content=" PlacementCell">
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
                                <li class="profile-name"><b><?php echo $CompanyName; ?></b></li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-5">
                            <!-- Start Social Links -->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown icon-border" id="notificationLink">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b>
                                        Welcome, <b><?php echo $cFirstName . " " . $cLastName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
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
                                    <li><a href="company-pendingapplicants.php" class="active">Pending</a></li>
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
                            <li><a href="company-createposition.php">Create Position</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="active" href="company-applicants.php">Applicant List</a>
                        <ul class="dropdown">
                            <li><a href="company-pendingapplicants.php" class="active">Pending</a></li>
                            <li><a href="company-acceptedapplicants.php">Accepted</a></li>
                        </ul>
                    </li>
                    <li><a href="company-settings.php">Settings</a>
                    </li>
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
                        <h2>List of Pending Applicants</h2>
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
                        <th width='15%' class='tabletitle'>Applicant Name</th>
                        <th width='12%' class='tabletitle'>Position</th>
                        <th width='12%' class='tabletitle'>Course</th>
                        <th width='12%' class='tabletitle'>Location</th>
                        <th width='12%' class='tabletitle'>Email</th>
                        <th width='12%' class='tabletitle'>Contact Number</th>
                        <th width='12%' class='tabletitle'>Date Submitted</th>
                        <th width='9%' class='tabletitle'>Action</th>
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
                                  comppositiontbl.PositionTitle,
                                  requesttocompanytbl.DateSubmitted,
                                  studcontactstbl.MobileNumber
                                  FROM
                                  requesttocompanytbl
                                  INNER JOIN comppositiontbl ON requesttocompanytbl.PositionID = comppositiontbl.PositionID
                                  INNER JOIN studentinfotbl ON requesttocompanytbl.StudentID = studentinfotbl.StudentID
                                  INNER JOIN studcontactstbl ON studentinfotbl.StudentID = studcontactstbl.StudentID
                                  WHERE requesttocompanytbl.Status = 'Pending' AND requesttocompanytbl.CompanyID = ?
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
                        $SID = $value[1];

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
                            <td width='15%' class=tabletitle><a href='#'onClick="window.open('../student-profile.php?id=<?php echo $SID; ?>', '_blank')"><?php echo $LastName . ", " . $FirstName; ?></a></td>
                            <td width='12%' class=tabletitle><?php echo $PositionLevel; ?></td>
                            <td width='12%' class=tabletitle><?php echo $MajorCourse; ?></td>
                            <td width='12%' class=tabletitle><?php echo $Location; ?></td>
                            <td width='12%' class=tabletitle><?php echo $Email; ?></td>
                            <td width='12%' class=tabletitle><?php echo $ContactNumber; ?></td>
                            <td width='12%' class=tabletitle><?php echo $DateSubmitted; ?></td>
                            <td width='8%'>
                                <button class='btn btn-default' data-toggle='modal'
                                        data-target='#AcceptRequest<?php echo $RID; ?>'>
                                    <i class='fa fa-check-circle'></i></button>
                                <button class='btn btn-danger' data-toggle='modal'
                                        data-target='#DeclineRequest<?php echo $RID; ?>'>
                                    <i class='fa fa-trash fa-1x'></i></button>
                            </td>
                        <tr>
                        </tbody>
                        <!-- Modal -->
                        <form name="form_Accept[]" id="form_Accept[]"
                              action="add-company.php" autocomplete="off" method="POST">
                            <div class="modal fade" id="AcceptRequest<?php echo $RID; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Accept Applicant?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Do you want to accept this
                                                applicant?</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Message to applicant.
                                                <span>(*)</span> </label>
                                                <div class="form-group">
                                            <textarea type="text" name="AcceptMsg" id="AcceptMsg"
                                                      class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="1">
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

                        <form name="form_Decline" id="form_Decline"
                              action="add-company.php" autocomplete="off" method="POST">
                            <div class="modal fade" id="DeclineRequest<?php echo $RID; ?>"
                                 role="dialog">
                                <div class="modal-dialog" style="padding:100px">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Reject Applicant?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Do you want to reject this applicant?
                                                This
                                                cannot be undone.</label>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col-md-15 fieldcol">
                                                <label = "usr" class = "control-label">Message to applicant.
                                                <span>(*)</span> </label>
                                                <div class="form-group">
                                                <textarea type="text" name="AcceptMsg" id="AcceptMsg"
                                                          class="form-control"> </textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="2">
                                            <input type="hidden" name="rid" value="<?php echo $RID; ?>">
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Reject</button>
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