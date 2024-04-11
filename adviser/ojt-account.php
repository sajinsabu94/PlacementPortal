<?php
include('../connection.php');
session_start();

if (isset($_SESSION['AdviserID'])) {
    $AdviserID = $_SESSION['AdviserID'];
} else {
    header("location: ../login-adviser.php");
}

$adviser_tbl =
    GSecureSQL::query(
        "SELECT * FROM admintbl WHERE AdminID = ?",
        TRUE,
        "s",
        $AdviserID
    );

$Username = $adviser_tbl[0][1];
$FirstName = $adviser_tbl[0][4];
$MiddleName = $adviser_tbl[0][5];
$LastName = $adviser_tbl[0][6];
$Position = $adviser_tbl[0][7];
$Address = $adviser_tbl[0][8];
$ContactNumber = $adviser_tbl[0][9];

?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Account </title>

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
    <link href="../fonts/ffonts/montserrat.css" rel="stylesheet" type="text/css">
    <link href="../fonts/ffonts/kaushan.css" rel="stylesheet" type="text/css">
    <link href="../fonts/ffonts/droid.css" rel="stylesheet" type="text/css">
    <link href="../fonts/ffonts/roboto.css" rel="stylesheet" type="text/css">

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
    <!-- Start Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">&nbsp;</div>
                <div class="col-md-5">
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
                                Welcome <?php echo $FirstName; ?> </b><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b
                                            class="fa fa-sign-out" style="float:right;"></b></a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Notification -->
                </div>
                <!-- .col-md-5 -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .top-bar -->
    <!-- End Top Bar -->

    <!-- Modal -->
    <div class="modal fade" id="Logout"
         role="dialog">
        <div class="modal-dialog" style="padding:100px">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign out</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-15">
                        <label>Do you want to sign out?</label>
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
                <!-- Start Navigation List -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="ojt-adviser.php">Home</a>
                    </li>
                    <li>
                        <a class = "active" href="ojt-account.php">Account</a>
                    </li>
                </ul>
                <!-- End Navigation List -->
            </div>
        </div>
        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="ojt-adviser.php">Home</a>
                </li>
                <li>
                    <a class = "active"  href="ojt-account.php">Account</a>
                </li>
            </ul>
        </ul>
    </div>
    <!-- End Header Logo & Naviagtion -->

    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>My Account</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!--Content-->
    <br><br><br>

    <div class="container">
        <!-- Modal for Username -->
        <div class="modal fade" id="ChangeOJTUsername" role="dialog">
            <div class="modal-dialog" style="padding:100px">
                <!-- Modal content-->
                <form id="change-Username-form" autocomplete="off" method="POST" action="functions.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Username</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-15 fieldcol">
                                <label = "usr" class = "control-label"> New Username: </label>
                                <div class="form-group">
                                    <input type="text" name="ModalNewUsername" id="ModalNewUsername"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-15 fieldcol">
                                <label = "usr" class = "control-label"> Confirm Username: </label>
                                <div class="form-group">
                                    <input type="text" name="ModalConfirmUsername" id="ModalConfirmUsername"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnChangeUsername">Change Email</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal ng Change Email -->
        <!-- Modal ng Change Password -->
        <div class="modal fade" id="ChangePassword" role="dialog">
            <div class="modal-dialog" style="padding:100px">

                <!-- Modal content-->
                <form id="change-password-form" autocomplete="off" method="POST" action="functions.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-15 fieldcol">
                                <div id="message"></div>
                                <br>
                                <label = "usr" class = "control-label"> Old Password: </label>
                                <div class="form-group">
                                    <input type="password" name="ModalOldPassword" id="ModalOldPassword"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="col-md-15 fieldcol">
                                <label = "usr" class = "control-label"> New Password: </label>
                                <div class="form-group">
                                    <input type="password" name="ModalNewPassword" id="ModalNewPassword"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="col-md-15 fieldcol">
                                <label = "usr" class = "control-label"> Confirm Password: </label>
                                <div class="form-group">
                                    <input type="password" name="ModalConfirmPassword" id="ModalConfirmPassword"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitPassword" class="btn btn-primary">Change Password</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal ng Change Password -->
        <form name="UpdateAdviser" id="UpdateAdviser" autocomplete="off" action="functions.php">
            <div class="col-md-12">
                <div class="row">
                    <?php

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        if ($id == 1) {
                            echo '
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-info-sign"></span> 
                                Username successfully changed.
                            </div>
                            ';
                        } elseif ($id == 2) {
                            echo '
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-info-sign"></span> 
                                Password successfully changed.
                            </div>
                            ';
                        } elseif ($id == 3) {
                            echo '
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-info-sign"></span> 
                                OJT Account successfully updated.
                            </div>
                            ';
                        }

                    }
                    ?>
                    <div class="row field">
                        <div class="col-md-2 fieldcol">
                            <label = "usr" class = "control-label"> Username: </label>
                        </div>
                        <div class="col-md-4 fieldcol">
                            <div class="form-group">
                                <label = "usr" class = "control-label"><?php echo $Username; ?></label>
                            </div>
                        </div>
                        <div class="col-md-3 fieldcol">
                            <div class="form-group">
                                <div class="box">
                                    <button class="btn btn-default" data-toggle="modal"
                                            data-target="#ChangeOJTUsername">Change
                                        Username
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row field">
                        <div class="col-md-2 fieldcol">
                            <label = "usr" class = "control-label"> Password: </label>
                        </div>
                        <div class="col-md-4 fieldcol">
                            <div class="form-group">
                                <label = "usr" class = "control-label">*****</label>
                            </div>
                        </div>
                        <div class="col-md-3 fieldcol">
                            <div class="form-group">
                                <div class="box">
                                    <button class="btn btn-default" data-toggle="modal" data-target="#ChangePassword">
                                        ChangePassword
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>First Name <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="FirstName" id="FirstName" class="form-control"
                                       value="<?php echo $FirstName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Middle Name <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="MiddleName" id="MiddleName" class="form-control"
                                       value="<?php echo $MiddleName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Last Name <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="LastName" id="LastName" class="form-control"
                                       value="<?php echo $LastName; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Position <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="Position" id="Position" class="form-control"
                                       value="<?php echo $Position; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Address <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="Address" id="Address" class="form-control"
                                       value="<?php echo $Address; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Contact Number <span>(*)</span></label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="ContactNumber" id="ContactNumber" class="form-control"
                                       value="<?php echo $ContactNumber ?>">
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                <div class="field">
                    <div class="text-center">
                        <button type="submit" class="btn-system btn-large" id="btnsave" name="btnsaveuser">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</body>
<script type="text/javascript" src="../js/script.js"></script>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#change-Username-form").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                ModalNewUsername: {
                    validators: {
                        notEmpty: {
                            message: "Username is required."
                        },
                        identical: {
                            field: "ModalConfirmUsername",
                            message: "Username and Confirm Username mismatched."
                        }
                    }
                },
                ModalConfirmUsername: {
                    validators: {
                        notEmpty: {
                            message: "Username is required."
                        },
                        identical: {
                            field: "ModalNewUsername",
                            message: "Username and Confirm Username mismatched."
                        }
                    }
                }
            }
        });

        $("#change-password-form").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                ModalOldPassword: {
                    validators: {
                        notEmpty: {
                            message: "Old Password is required."
                        }
                    }
                },
                ModalNewPassword: {
                    validators: {
                        notEmpty: {
                            message: "New Password is required."
                        }
                    }
                },
                ModalConfirmPassword: {
                    validators: {
                        notEmpty: {
                            message: "Confirm Password is required."
                        },
                        identical: {
                            field: "ModalNewPassword",
                            message: "Password mismatched."
                        }
                    }
                }
            }
        });

        $("#UpdateAdviser").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                FirstName: {
                    validators: {
                        notEmpty: {
                            message: "First Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "First Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                MiddleName: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Middle Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                LastName: {
                    validators: {
                        notEmpty: {
                            message: "Last Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Last Name Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                Position: {
                    validators: {
                        notEmpty: {
                            message: "Position is required."
                        }
                    }
                },
                Address: {
                    validators: {
                        notEmpty: {
                            message: "Address is required."
                        }
                    }
                },
                ContactNumber: {
                    validators: {
                        notEmpty: {
                            message: "Contact Number is required."
                        }
                    }
                },
            }
        });
    });


    $("button#submitPassword").click(function () {
        $.post($("#change-password-form").attr("action"),
            $("#change-password-form :input").serializeArray(),
            function (data) {
                $("div#message").html(data);
            });

        $("#change-password-form").submit(function () {
            return false;
        });
    });
</script>