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
    <title>PlacementCell | Position List</title>

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
                                </li> -->
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
                            <a class="active">Position</a>
                            <ul class="dropdown">
                                <li><a class="active" href="company-positionlist.php">Position List</a></li>
                                <li><a href="company-createposition.php">Create Position</a></li>
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
                    <!-- End Navigation List -->
                </div>
            </div>
            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">
                <li>
                    <a href="company.php">Home</a>
                </li>
                <li>
                    <a class="active">Position</a>
                    <ul class="dropdown">
                        <li><a class="active" href="company-positionlist.php">Position List</a></li>
                        <li><a href="company-createposition.php">Create Position</a></li>
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
            <!-- Mobile Menu End -->
        </div>
        <!-- End Header Logo & Naviagtion -->
    </header>
    <!-- End Header Section -->

    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>List of Positions</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!--Content-->
    <br><br><br>
    <div class="container">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if ($id == 2) {
                    echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> Position successfully updated.</strong>
                            </div>
                            ';
                } elseif ($id == 1) {
                    echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> Position successfully added.</strong>
                            </div>
                            ';
                } elseif ($id == 3) {
                    echo '
                            <div class="alert alert-success" id="success-alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> Position successfully deleted.</strong>
                            </div>
                            ';
                }

            }
            ?>
            <table class="table segment table-hover" width="100%" cellpadding="0">
                <thead>
                <tr>
                    <th width='30%' class='tabletitle'>Positions</th>
                    <th width='20%' class='tabletitle'>From</th>
                    <th width='20%' class='tabletitle'>To</th>
                    <th width='20%' class='tabletitle'>Available Position</th>
                    <th width='10%' class='tabletitle'>Action</th>
                <tr>
                </thead>
                <?php
                $compposition_tbl =
                    GSecureSQL::query(
                        "SELECT * FROM comppositiontbl WHERE CompanyID = ? ORDER BY PostingDateFrom ASC",
                        TRUE,
                        "s",
                        $CompanyID
                    );
                foreach ($compposition_tbl as $value) {
                    $PositionID = $value[0];
                    $PositionTitle = $value[1];
                    $PostingDateFrom = $value[3];
                    $PostingDateTo = $value[4];
                    $PositionTitle = $value[5];
                    $PositionLevel = $value[6];
                    $JobDescription = $value[7];
                    $JSpecialization = $value[8];
                    $EType = $value[9];
                    $AvPosition = $value[10];
                    $MonthlySalary = $value[11];
                    $YExperience = $value[12];
                    $DegreeLevel = $value[13];
                    $Language = $value[14];
                    $ReqSkills = $value[15];
                    ?>
                    <tbody>
                    <tr>
                        <td width=30% class='tabletitle'><?php echo $PositionTitle; ?></td>
                        <td width=20% class='tabletitle'><?php echo $PostingDateFrom; ?></td>
                        <td width=20% class='tabletitle'><?php echo $PostingDateTo; ?></td>
                        <td width=20% class='tabletitle' style = "text-indent:50px;"><?php echo $AvPosition; ?></td>
                        <td width=10% class='tabletitle'>
                            <button name="btnedit" data-toggle='modal'
                                    data-target='#UpdatePosition<?php echo $PositionID; ?>' class='btn btn-default'>
                                <i class='fa fa-eye'></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#DeletePosition<?php echo $PositionID; ?>">
                                <i class="fa fa-trash fa-1x"></i>
                            </button>
                        </td>
                        </form>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="DeletePosition<?php echo $PositionID; ?>"
                         role="dialog">
                        <div class="modal-dialog" style="padding:100px">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete Position?</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-15">
                                        <label = "usr" class = "control-label">Do you want to delete
                                        Position ? This cannot be undone.</label>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="company-delete.php?delete_PositionID=<?php echo $PositionID; ?>"
                                           class="btn btn-danger">Delete</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tbody>
                    <!-- Modal -->
                    <div class="modal fade" id="UpdatePosition<?php echo $PositionID; ?>" role="dialog">
                        <div class="modal-dialog modal-lg" style="padding:100px">
                            <form id="update-AvPosition" autocomplete="off" method="POST" action="add-company.php">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Posting Date: </label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>From:</label> <label><?php echo $PostingDateFrom; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>To:</label> <label><?php echo $PostingDateTo; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <h3> Position Information </h3>
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Position Title: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $PositionTitle; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Position Level: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $PositionLevel; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Job Description: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $JobDescription; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Employment Type: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $EType; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Available Position: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="aPositionID"
                                                           value="<?php echo $PositionID; ?>">
                                                    <input type="number" name="uAvPosition" id="uAvPosition"
                                                           class="form-control" value="<?php echo $AvPosition; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h3> Salary Range </h3>
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Range of Salary: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $MonthlySalary; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <h3> General Requirements </h3>
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Year of Experience: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> <?php echo $YExperience; ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Educatonal Attainment: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <ul>
                                                        <?php
                                                        $dLevel = explode(", ", $DegreeLevel);
                                                        foreach ($dLevel as $value1) {
                                                            $dLevel = $value1;
                                                            ?>
                                                            <li>* <?php echo $dLevel; ?></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Required Skills: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <ul>
                                                        <?php
                                                        $rSkill = explode(", ", $ReqSkills);
                                                        foreach ($rSkill as $value2) {
                                                            $rSkill = $value2;
                                                            ?>
                                                            <li>* <?php echo $rSkill; ?></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <h3> Optional Requirements </h3>
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Language: </label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <ul>
                                                        <?php
                                                        $rLanguage = explode(", ", $Language);
                                                        foreach ($rLanguage as $value3) {
                                                            $rLanguage = $value3;
                                                            ?>
                                                            <li>* <?php echo $rLanguage; ?></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/script.js">

    $("button#submitPassword").click(function () {
        $.post($("#update-AvPositio").attr("action"),
            $("#update-AvPositio :input").serializeArray(),
            function (data) {
                $("div#message").html(data);
            });

        $("#update-AvPositio").submit(function () {
            return false;
        });
    });
</script>
</body>
</html>
