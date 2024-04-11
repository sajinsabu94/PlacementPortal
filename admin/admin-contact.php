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
    <title>PlacementCell | Create an Event</title>

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

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="../css/PlacementCell-style.css" media="screen">

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
    <script type="text/javascript" src="../js/script.js"></script>

    <!-- fileupload -->
    <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="../js/fileinput.min.js" type="text/javascript"></script>

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
                        <!-- .col-md-6 -->
                        <div class="col-md-5">
                            &nbsp;
                        </div>
                        <div class="col-md-7">
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
                        <a class="navbar-brand">
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
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        <!-- Mobile Menu End -->

        <!-- Start Page Banner -->
        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Contact Maintenance</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <?php
            $admincontact_tbl =
                GSecureSQL::query(
                    "SELECT * FROM contacttbl WHERE `AdminID` = ?",
                    TRUE,
                    "s",
                    $AdminID
                );
            foreach ($admincontact_tbl as $value) {
            $TelNumber = $value[2];
            $Address = $value[3];
            $PhoneNumber = $value[4];
            $Email = $value[5];
            $Website = $value[6];
            
        ?>

        <form action="functions.php" name="addcontact" id="addcontact" autocomplete="off" method="POST" enctype="multipart/form-data">
            <div id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Telephone Number:</label>
                            <div class="form-group">
                                <input type="text" name="telnumber" id="telnumber" class="form-control" value="<?php echo $TelNumber ?>">
                            </div>
                            <label>Phone Number:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $PhoneNumber ?>">
                            </div>
                            <label>Address:</label>
                            <div class="form-group">
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo $Address ?>">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $Email ?>">
                            </div>
                            <label>Website:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="website" name="website" value="<?php echo $Website ?>">
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                    <div class="text-center">
                        <button type="submit" class="btn-system btn-large" id="BtnContactsave" name="BtnContactsave">Save</button>
                        <a href = "admin-news.php" class="btn-system btn-large btn-black">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#addcalendar").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                datefrom: {
                    validators: {
                        notEmpty: {
                            message: "Date From is required."
                        }
                    }
                },
                dateto: {
                    validators: {
                        notEmpty: {
                            message: "Date To is required."
                        }
                    }
                },
                eventtitle: {
                    validators: {
                        notEmpty: {
                            message: "Event Title is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 100,
                            message: "Event Title is 100 characters only."
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: "Location is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 15,
                            message: "Location is 15 characters only."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Location can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                descrip: {
                    validators: {
                        notEmpty: {
                            message: "Description is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 100,
                            message: "Description is 255 characters only."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Description can consist of alphabetical characters and spaces only"
                        }
                    }
                }
            }
        });
    });
</script>
</html>