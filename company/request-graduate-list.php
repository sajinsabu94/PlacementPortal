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
    <title>PlacementCell | Request List of Graduates</title>

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

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../css/checkbox.css" media="screen"/>

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
    <form method="POST" name="LOGRequest" id="LOGRequest" action="add-company.php" autocomplete="off">
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
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b
                                                class="fa fa-user"></b>
                                            Welcome, <b><?php echo $cFirstName . " " . $cLastName; ?> </b><b
                                                class="caret"></b></a>
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
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
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
                                            <h4 class="modal-title">Sign out?</h4>
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
                                    <a class="active" href="company.php">Home</a>
                                </li>
                                <li>
                                    <a>Position</a>
                                    <ul class="dropdown">
                                        <li><a href="company-positionlist.php">Position List</a></li>
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
                                <li><a href="company-settings.php">Settings</a>
                                </li>
                            </ul>
                            <!-- End Navigation List -->
                        </div>
                    </div>
                    <!-- Mobile Menu Start -->
                    <ul class="wpb-mobile-menu">
                        <li>
                            <a class="active" href="company.php">Home</a>
                        </li>
                        <li>
                            <a>Position</a>
                            <ul class="dropdown">
                                <li><a href="company-positionlist.php" class="active">Position List</a></li>
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
                        <a href="company-settings.php">Settings</a>
                        </li>
                    </ul>
                </div>
                <!-- End Header Logo & Naviagtion -->
            </header>

            <!-- Start Page Banner -->
            <div class="page-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Details of Job Opening</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Banner -->

            <!-- Start Content -->
            <div id="content">
                <div class="container">
                    <div class="row sidebar-page">
                        <div class="col-md-12 page-conten">
                            <div class="row">
                                <div class="col-md-3">&nbsp;</div>
                                <div class="col-md-6">
                                    <div class="call-action call-action-boxed call-action-style1 clearfix">
                                        <div class="form-group">
                                            <label>Position Title</label>
                                            <input type="text" class="form-control" id="rPTitle" name="rPTitle">
                                        </div>
                                        <label>Employee Classification</label>
                                        <br><em>(Please select appropriate box)</em>
                                        <div class="checkbox checkbox-success">
                                            <input id="rEType" name="rEType[]" class="styled" type="checkbox"
                                                   value="Full Time">
                                            <label for="checkbox3"><b>Full Time</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rEType" name="rEType[]" class="styled" type="checkbox"
                                                   value="Part-Time">
                                            <label for="checkbox3"><b>Part-time</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rEType" name="rEType[]" class="styled" type="checkbox"
                                                   value="Contractual">
                                            <label for="checkbox3"><b>Contractual</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rEType" name="rEType[]" class="styled" type="checkbox"
                                                   value="Freelance">
                                            <label for="checkbox3"><b>Freelance</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rEType" name="rEType[]" class="styled" type="checkbox"
                                                   value="Project-based">
                                            <label for="checkbox3"><b>Project-based</b></label>
                                        </div>
                                        <div class="hr4" style="margin-bottom:10px;"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox checkbox-success">
                                                    <input id="other" name="other" class="styled" type="checkbox">
                                                    <label for="checkbox3"><b>Other:</b></label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="txtOther" name="txtOther">
                                            </div>
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Level</label>
                                        <br><em>(Please select appropriate box)</em>
                                        <div class="checkbox checkbox-success">
                                            <input id="rPLevel" name="rPLevel[]" class="styled" type="checkbox"
                                                   value="Entry Level/Gen Staff">
                                            <label for="checkbox3"><b>Entry Level/Gen Staff</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rPLevel" name="rPLevel[]" class="styled" type="checkbox"
                                                   value="Officer">
                                            <label for="checkbox3"><b>Officer</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rPLevel" name="rPLevel[]" class="styled" type="checkbox"
                                                   value="Supervisory">
                                            <label for="checkbox3"><b>Supervisory</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="rPLevel" name="rPLevel[]" class="styled" type="checkbox"
                                                   value="Management">
                                            <label for="checkbox3"><b>Management</b></label>
                                        </div>

                                        <div class="hr4" style="margin-bottom:10px;"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox checkbox-success">
                                                    <input id="pOther" name="pOther" class="styled" type="checkbox">
                                                    <label for="checkbox3"><b>Other:</b></label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="txtPOther" name="txtPOther">
                                            </div>
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="rDescription" id="rDescription" rows="7"
                                                      cols="0" maxlength="300"></textarea>
                                        </div>
                                        <label>Qualifications</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="rQualification" id="rQualification"
                                                      rows="7" cols="0" maxlength="100"></textarea>
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Location</label>
                                        <br><em>(Please select appropriate box)</em>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="rLocation" name="rLocation">
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Salary Range</label>
                                        <br><em>(Should not be lower than the Minimum Wage)</em>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="rSalaryRange" name="rSalaryRange">
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <div class="form-group">
                                            <label>Required years of experience</label>
                                            <input type="number" class="form-control" id="rYOE" name="rYOE">
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Consider Fresh Graduate</label>
                                        <br><em>(Please select)</em>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="Yes" value="Yes" name="CFG">
                                            <label for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="radio radio-inline">
                                            <input type="radio" id="No" value="No" name="CFG">
                                            <label for="inlineRadio2">No</label>
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Duration of Request</label>
                                        <br><em>(Please select Duration)</em>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input id="rDOR" name="rDOR" type="radio" value="15 Days">
                                            <label for="inlineRadio2"><b>15 Days</b></label>
                                        </div>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input id="rDOR" name="rDOR" type="radio" value="1 Month">
                                            <label for="inlineRadio2"><b>1 month</b></label>
                                        </div>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input id="rDOR" name="rDOR" type="radio" value="2 Months">
                                            <label for="inlineRadio2"><b>2 months</b></label>
                                        </div>
                                        <br>
                                        <div class="hr4" style="margin-bottom:10px;"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="radio radio-inline">
                                                    <input id="rDOR" name="rDOR" type="radio" value="other">
                                                    <label for="inlineRadio2"><b>Other:</b></label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="txtDORother" name="txtDORother">
                                            </div>
                                        </div>
                                        <br>
                                        <label>Courses needed</label>
                                        <br>

                                        <?php
                                        $courses_tbl =
                                            GSecureSQL::query(
                                                "SELECT CourseCode, CourseTitle FROM coursetbl",
                                                TRUE
                                            );
                                        foreach ($courses_tbl as $value) {
                                            $CourseCode = $value[0];
                                            $CourseTitle = $value[1];
                                            ?>
                                            <div class="checkbox checkbox-success">
                                                <input id="Course" name="Course[]" class="styled" type="checkbox"
                                                       value="<?php echo $CourseCode; ?>">
                                                <label for="checkbox3"><b><?php echo $CourseTitle; ?></b></label>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>Our company would like to send marketing materials for posting.</label>
                                        <br><em>(Someone from Alumni and Placement Office will contact you to make
                                            arrangements for the particulars of the request.)</em>
                                        <div class="checkbox checkbox-success">
                                            <input id="MarketingMaterials" name="MarketingMaterials" class="styled"
                                                   type="checkbox" value="Yes">
                                            <label for="checkbox3"><b>Yes</b></label>
                                        </div>

                                        <div class="hr1" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <label>In order to complete the process, you are requested to forward the following
                                            requirements:</label>
                                        <br><em>Please email at <a href="mailto:test@gmail.com"><u>test@gmail.com</u></a></em>
                                        <ul class="icon-list">
                                            <li><label><i class="fa fa-check-circle"></i> Company Profile</label></li>
                                            <li><label><i class="fa fa-check-circle"></i> Copy of Securities and Exchange
                                                    Commission Certificate of Registration or Copy of Department of Trade
                                                    and Industry Certificate of Registration</label></li>
                                            <li><label><i class="fa fa-check-circle"></i> Copy of Business Permit</label>
                                            </li>
                                            <li><label><i class="fa fa-check-circle"></i> POEA License for Overseas
                                                    Employment Opportunities</label></li>
                                            <li><label><i class="fa fa-check-circle"></i> List of Job Openings</label></li>
                                        </ul>

                                        <div class="hr5" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <div class="call-action call-action-boxed call-action-style2 clearfix">
                                            <label>If you would like more information 
                                                Program, please contact:</label>
                                            <p>Mr. Sajin</p>
                                            <p>Manager</p>
                                            <p>XetaTria</p>
                                            <p><label>Mobile No.:</label> (91) 9876543210</p>
                                            <p><label>Email Adds.:</label> <a
                                                    href="mailto:test@gmail.com"><u>test@gmail.com</u></a>
                                            </p>
                                        </div>

                                        <div class="hr5" style="margin-top:15px;margin-bottom:15px;"></div>

                                        <div class="text-center">
                                            <button type="submit" class="btn-system btn-large" name="btnRequestLOG"
                                                    id="btnRequestLOG">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#LOGRequest").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                rPTitle: {
                    validators: {
                        notEmpty: {
                            message: "Position Title is required."
                        }
                    }
                },
                'rEType[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check atleast one."
                        }
                    }
                },
                'rPLevel[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check atleast one."
                        }
                    }
                },
                rDescription: {
                    validators: {
                        notEmpty: {
                            message: "Description Level is required."
                        }
                    }
                },
                rQualification: {
                    validators: {
                        notEmpty: {
                            message: "Qualifications is required."
                        },
                        stringLength: {
                            min: 5,
                            max: 70,
                            message: "Qualifications is 70 characters only."
                        }
                    }
                },
                rLocation: {
                    validators: {
                        notEmpty: {
                            message: "Location is required."
                        }
                    }
                },
                rSalaryRange: {
                    validators: {
                        notEmpty: {
                            message: "Salary Range Type is required."
                        },
                        regexp: {
                            regexp: /^[0-9\s-]+$/i,
                            message: "Salary Range can consist of Positive Numbers only"
                        }
                    }
                },
                rYOE: {
                    validators: {
                        notEmpty: {
                            message: "Required Years of Experience is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 2,
                            message: "Required Years of Experience must be 2 digit long."
                        }
                    }
                },
                CFG: {
                    validators: {
                        notEmpty: {
                            message: "Salary is required."
                        }
                    }
                },
                rDOR: {
                    validators: {
                        notEmpty: {
                            message: "Duration of request is required."
                        }
                    }
                }

            }
        });
    });
</script>
</html>
<script>
    $('#other').click(function () {
        $("#txtOther").val("");
        if ($(this).is(':checked')) {
            $('#txtOther').show();
        } else {
            $('#txtOther').hide();
        }
    });

    if ($('#other').is(':checked')) {
        $('#txtOther').show();
    } else {
        $('#txtOther').hide();
    }

    $('#pOther').click(function () {
        $("#txtPOther").val("");
        if ($(this).is(':checked')) {
            $('#txtPOther').show();
        } else {
            $('#txtPOther').hide();
        }
    });

    if ($('#pOther').is(':checked')) {
        $('#txtPOther').show();
    } else {
        $('#txtPOther').hide();
    }

    $(document).ready(function () {
        $('input[type="radio"]').click(function () {
            if ($(this).attr("value") == "other") {
                $("#txtDORother").show();
            } else {
                $("#txtDORother").hide();
            }
        });
        if ($('#rDOR').is(':checked')) {
            $("#txtDORother").show();
        } else {
            $("#txtDORother").hide();
        }
    });
</script>
