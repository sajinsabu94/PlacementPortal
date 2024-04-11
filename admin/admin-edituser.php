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

$userID = $_GET['id'];

$admin_tbl =
    GSecureSQL::query(
        "SELECT
        Username,
        FirstName,
        MiddleName,
        LastName,
        Position,
        Address,
        ContactNumber,
        Usertype
        FROM admintbl
        WHERE AdminID = ?",
        TRUE,
        "s",
        $userID
    );


$Username = $admin_tbl[0][0];
$aFirstName = $admin_tbl[0][1];
$MiddleName = $admin_tbl[0][2];
$LastName = $admin_tbl[0][3];
$Position = $admin_tbl[0][4];
$Address = $admin_tbl[0][5];
$ContactNumber = $admin_tbl[0][6];
$Usertype = $admin_tbl[0][7];

?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Add User</title>

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

    <!--  CSS Styles  -->
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
                    </div>
                </div>
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        <!-- End Header Section -->

        <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>User</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#"></a></li>
                            <li>Add User</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div id="content">
            <form method="POST" action="functions.php" name="AddUser" id="AddUser" autocomplete="off">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Username:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="eUsername" id="eUsername" value="<?php echo $Username; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Password:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><i>**************</i></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>First Name:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="eFirstName" id="eFirstName" class="form-control" value="<?php echo $FirstName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>MiddleName:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="eMiddleName" id="eMiddleName" class="form-control" value="<?php echo $MiddleName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Last Name: </label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="eLastName" id="eLastName" class="form-control" value="<?php echo $LastName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Position:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="ePosition" id="ePosition" class="form-control" value="<?php echo $Position; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-2">
                            <label>Address:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="eAddress" id="eAddress" class="form-control" value="<?php echo $Address; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Contact Number:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="eContactNumber" id="eContactNumber" class="form-control" value="<?php echo $ContactNumber; ?>">
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                    <div class="field">
                        <div class="text-center">
                            <button type="submit" class="btn-system btn-large">Save</button>
                            <a href = "admin-users.php" class="btn-system btn-large btn-black">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/script.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#AddUser").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
          s: {
                aUsername: {
                    validators: {
                        notEmpty: {
                            message: "Username is required."
                        },
                        stringLength: {
                            min: 5,
                            max: 15,
                            message: "Username is invalid."
                        },
                        remote: {
                            message: 'The Username already exists',
                            url: 'functions.php',
                            data: {
                                type: 'aUsername'
                            },
                            type: 'POST'
                        }
                    }
                },
                aFirstName: {
                    validators: {
                        notEmpty: {
                            message: "First Name Level is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "First Name can consist of alphabetical characters and spaces only"
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: "First Name must be 3-20 digit only."
                        }
                    }
                },
                aLastName: {
                    validators: {
                        notEmpty: {
                            message: "Last Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Last Name can consist of alphabetical characters and spaces only"
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: "Last Name must be 3-20 digit only."
                        }
                    }
                },
                aPosition: {
                    validators: {
                        notEmpty: {
                            message: "Position is required."
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: "Position must be 3-20 digit only."
                        }
                    }
                },
                aAddress: {
                    validators: {
                        notEmpty: {
                            message: "Address Position is required."
                        },
                        stringLength: {
                            min: 5,
                            max: 30,
                            message: "Address must be 5-30 digit only."
                        }
                    }
                },
                aContactNumber: {
                    validators: {
                        notEmpty: {
                            message: "Contact Number is required."
                        },
                        stringLength: {
                            min: 3,
                            max: 11,
                            message: "Contact Number must be 11 digit only."
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "Contact Number can consist of Positive Numbers only"
                        }
                    }
                }
            }
        });
    });
</script>
</html>