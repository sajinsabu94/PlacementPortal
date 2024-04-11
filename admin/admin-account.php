<?php
include('../connection.php');
session_start();

if(isset($_SESSION['AdminID'])){
    $AdminID = $_SESSION['AdminID'];
}else{
    header("location: ../login-admin.php");
}

$admin_tbl =
    GSecureSQL::query(
        "SELECT * FROM admintbl WHERE AdminID = ?",
        TRUE,
        "s",
        $AdminID
    );

$Username = $admin_tbl[0][1];
$FirstName = $admin_tbl[0][4];
$MiddleName = $admin_tbl[0][5];
$LastName = $admin_tbl[0][6];
$Position = $admin_tbl[0][7];
$Address = $admin_tbl[0][8];
$ContactNumber = $admin_tbl[0][9];

?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Account</title>

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
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="ChangeUsername" role="dialog">
            <div class="modal-dialog" style="padding:100px">

                <!-- Modal content-->
                <form id="change-Username-form" autocomplete="off" method="POST" action="functions.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Username</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-15">
                                <label> New Username: </label>
                                <div class="form-group">
                                    <input type="text" name="ModalNewUsername" id="ModalNewUsername" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-15">
                                <label> Confirm Username: </label>
                                <div class="form-group">
                                    <input type="text" name="ModalConfirmUsername" id="ModalConfirmUsername" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnChangeUsername">Change Username</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


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
                            <div class="col-md-15">
                                <div id="message"></div>
                                <br>
                                <label> Old Password: </label>
                                <div class="form-group">
                                    <input type="password" name="ModalOldPassword" id="ModalOldPassword"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="col-md-15">
                                <label> New Password: </label>
                                <div class="form-group">
                                    <input type="password" name="ModalNewPassword" id="ModalNewPassword"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="col-md-15">
                                <label> Confirm Password: </label>
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
    </div>

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
                        <a class="navbar-brand" href="admin.php">
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
                            <a class="active" href="admin-account.php">Account</a>
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
        </header>
        <!-- End Header Section -->

        <!-- Start Page Banner -->
        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Account</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div id="content">
            <div class="container">
                <form name="UpdateAdmin" id="UpdateAdmin" autocomplete="off" action="functions.php" method="POST">
                    <?php
                    if (isset($_GET['saved'])) {
                        echo '
                        <div class="alert alert-success fade in" id="success-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-info-circle"></span> Information successfully updated.</strong>
                        </div>
                        ';
                    }
                    if (isset($_GET['error'])) {
                        echo '
                        <div class="alert alert-danger fade in" id="danger-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-warning"></span> Some errors occured, Please try again.</strong>
                        </div>
                        ';
                    }
                    if (isset($_GET['error1'])) {
                        echo '
                        <div class="alert alert-danger fade in" id="danger-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-warning"></span> Incorrect password, Please try again.</strong>
                        </div>
                        ';
                    }
                    ?>
                    <script type="text/javascript">
                        $("#success-alert").fadeTo(5000, 500).slideUp(500, function () {
                            $("#success-alert").alert('close');
                        });
                    </script>

                    <div class="">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Username:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $Username; ?></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="box">
                                        <button class="btn btn-default" data-toggle="modal" data-target="#ChangeUsername">Change
                                            Username
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Password: </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>**********</label>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                                           maxlength="20" value="<?php echo $FirstName; ?>">
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
                                           maxlength="20" value="<?php echo $MiddleName; ?>">
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
                                           maxlength="20" value="<?php echo $LastName; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Position <span>(*)</span></label>
                            </div>,
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="Position" id="Position" class="form-control"
                                           maxlength="50" value="<?php echo $Position; ?>">
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
                                           maxlength="100" value="<?php echo $Address; ?>">
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
                                           maxlength="11" value="<?php echo $ContactNumber ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                    <div class="text-center">
                        <button type="submit" class="btn-system btn-large">Save</button>
                    </div>
                </form>
            </div>
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

        $("#UpdateAdmin").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
           fields: {
                FirstName: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
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
                            message: "This is required."
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
                            message: "This is required."
                        }
                    }
                },
                Department: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                Address: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        }
                    }
                },
                ContactNumber: {
                    validators: {
                        notEmpty: {
                            message: "This is required."
                        },
                        regexp: {
                            regexp: /^[0-9]+$/i,
                            message: "Contact Number can consist of numeric characters only"
                        }
                    }
                }
            }
        });
    });

/*
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
    */
</script>