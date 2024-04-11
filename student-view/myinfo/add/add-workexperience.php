<?php
include('../../../connection.php');
session_start();
include('../../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$hashStudentID = hash('md4',$StudentID);

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$FirstName = $infoquery[0][0];
$LastName = $infoquery[0][1];
$MajorCourse =  $infoquery[0][2];
$StudentName = $FirstName . " " . $LastName;

$course_qry =
    GSecureSQL::query(
        "SELECT CourseTitle FROM coursetbl WHERE CourseCode = ?",
        TRUE,
        "s",
        $MajorCourse
    );
$MajorCourse = $course_qry[0][0];
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Add - Work Experience</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content=" - Responsive HTML5 Template">

    <link rel="shortcut icon" href="../../../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="../../../css/bootstrapValidator.min.css" />

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../../js/bootstrap.min.js" ></script>

    <!-- BootstrapValidator -->
    <script type="text/javascript" src="../../../js/bootstrapValidator.min.js" ></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../../../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../../../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../../../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../../../css/animate.css" media="screen">

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="../../../css/PlacementCell-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../../css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="../../../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../../../js/modernizrr.js"></script>
    <script type="text/javascript" src="../../../js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../../../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../../js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.appear.js"></script>
    <script type="text/javascript" src="../../../js/count-to.js"></script>
    <script type="text/javascript" src="../../../js/jquery.textillate.js"></script>
    <script type="text/javascript" src="../../../js/jquery.lettering.js"></script>
    <script type="text/javascript" src="../../../js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.parallax.js"></script>
    <script type="text/javascript" src="../../../js/jquery.slicknav.js"></script>

    <!-- Notification -->
    <link rel="stylesheet" href="../../../css/notif.css"/>

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
</head>

<body>
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
                            <ul class="profile-name">
                                <li>Course: <b><?php echo $MajorCourse; ?></b></li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-5">
                            <!-- Start Social Links -->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown icon-border" id="notificationLink">
                                    <span id="notification_count">3</span>
                                    <a href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i class="fa fa-bell"></i></a>
                                    <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                        <li class="dropdown-header"><label>Notification</label></li>
                                        <li class="disabled"><a href="#" tabindex="-1">No new notification.</a></li>
                                        <li><a href="#" tabindex="-1">The administrator accepted your request.</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../../notification/notification.php" tabindex="-1">See All</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b> Welcome, <b><?php echo $StudentName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../../../student-profile.php?id=<?php echo $hashStudentID; ?>">Profile <b class="fa fa-user" style="float:right;"></b></a></li>
                                        <li><a href="../../settings/settings.php">Settings <b class="fa fa-cog" style="float:right;"></b></a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b class="fa fa-sign-out" style="float:right;"></b></a></li>
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

            <!-- Modal -->
            <div class="modal fade" id="Logout" role="dialog">
                <div class="modal-dialog" style="padding:100px">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Sign Out</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-15 fieldcol">
                                <label>Do you want to sign out?</label>
                            </div>
                            <div class="modal-footer">
                                <a href="../../logout.php"
                                   class="btn btn-primary">Sign Out</a>
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
                        <a class="navbar-brand">
                            <img src="../../../images/PlacementCell.png">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Work Experience</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#"></a></li>
                            <li>Add Work Experience</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Content -->
        <form id="myForm" name="myForm" action="../myinfoadd.php" method="POST" autocomplete="off">
        <div id="content">
            <div class="container">
                <div class="row sidebar-page">
                    <!-- Page Content -->
                    <div class="col-md-9 page-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name <span>(*)</span></label>
                                    <input type="text" class="form-control" id="CompanyName" name="CompanyName">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="CompanyAddress" name="CompanyAddress">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Industry <span>(*)</span></label>
                                    <select id="Industry" name="Industry" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Please select one -</option>
                                        <?php
                                        $industry_tbl =
                                            GSecureSQL::query(
                                                "SELECT * FROM listofindustrytbl",
                                                TRUE
                                            );
                                        foreach ($industry_tbl as $value) {
                                            $IndustryID = $value[0];
                                            $Industry = $value[1];
                                            ?>
                                            <option value="<?php echo $Industry; ?>"><?php echo $Industry; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration</label><br>
                                    <label><input type="checkbox" name="Duration" id="Duration" checked="checked"> Currently Work Here</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From <span>(*)</span></label>
                                    <select id="FromMonth" name="FromMonth" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Select Month -</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select id="FromYear" name="FromYear" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Select Year -</option>
                                        <?php
                                        $date = Date("Y") + 1;
                                        while ($date != 1935) {
                                            $date--;
                                            echo "<option value=\"$date\"> $date</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="ToDuration">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To <span>(*)</span></label>
                                        <select id="ToMonth" name="ToMonth" class="form-control" style="width:100%; height:34px;">
                                            <option value="">- Select Month -</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 fieldcol">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <select id="ToYear" name="ToYear" class="form-control"
                                                style="width:100%; height:34px;">
                                            <option value="">- Select Year -</option>
                                            <?php
                                            $date = Date("Y") + 1;
                                            while ($date != 1935) {
                                                $date--;
                                                echo "<option value='$date'> $date</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position Level <span>(*)</span></label>
                                    <select id="PositionLevel" name="PositionLevel" class="form-control">
                                        <option value="">- Select Position Level -</option>
                                        <?php
                                        $position_tbl =
                                            GSecureSQL::query(
                                                "SELECT * FROM listofpositiontbl",
                                                TRUE
                                            );
                                        foreach ($position_tbl as $value) {
                                            $PositionID = $value[0];
                                            $Position = $value[1];
                                            ?>
                                            <option value="<?php echo $Position; ?>"><?php echo $Position; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row field">
                            <div class="col-md-6 fieldcol">
                                <div class="form-group">
                                    <label>Specialization <span>(*)</span></label>
                                    <select id="WorkSpecialization" name="WorkSpecialization" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Select Specialization -</option>
                                        <?php
                                        $specialization_tbl =
                                            GSecureSQL::query(
                                                "SELECT * FROM listofspecializationtbl",
                                                TRUE
                                            );
                                        $count = 0;
                                        foreach ($specialization_tbl as $value) {
                                            $SpecializationID = $value[0];
                                            $Specialization = $value[1];
                                            $count++;
                                            ?>
                                            <option
                                                value="<?php echo $Specialization; ?>"><?php echo $Specialization; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 fieldcol">
                                <div class="form-group">
                                    <label>Monthly Salary</label><br>
                                    <select id="MonthlySalary" name="MonthlySalary" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Select Monthly Salary -</option>
                                        <?php
                                        $salaryrange_tbl =
                                            GSecureSQL::query(
                                                "SELECT * FROM listofsalaryrangetbl",
                                                TRUE
                                            );
                                        foreach ($salaryrange_tbl as $value) {
                                            $SalaryID = $value[0];
                                            $Salary = $value[1];
                                            ?>
                                            <option value="<?php echo $SalaryID; ?>"><?php echo $Salary; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row field">
                            <div class="col-md-12 fieldcol">
                                <div class="form-group">
                                    <label>Nature of Work</label><br>
                                    <textarea class="form-control" id="NatureOfWork" name="NatureOfWork"
                                              rows="5" maxlength="150"></textarea>
                                    <div id="textarea_feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Content -->

                    <!--Sidebar-->
                    <div class="col-md-3 sidebar left-sidebar">
                        <!-- Search Widget -->
                        <div class="call-action call-action-boxed call-action-style2 clearfix">
                            <label><span>(*)</span> Note: Required fields.</label>
                        </div>
                    </div>
                    <!--End sidebar-->
                </div>
                <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                <div class="field">
                    <div class="text-center">
                        <button type="submit" class="btn-system btn-large border-btn">Add</button>
                        <a href="../work.php" class="btn-system btn-large btn-black">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    
    <!-- End Content -->
    <script type="text/javascript" src="../../../js/script.js"></script>
</body>
</html>

<script type="text/javascript">
    $('#Duration').click(function () {
        $("#ToMonth").val("");
        $("#ToYear").val("");
        if ($(this).is(':checked')) {
            $('#ToDuration').hide();
        } else {
            $('#ToDuration').show();
        }
    });

    if ($('#Duration').is(':checked')) {
        $('#ToDuration').hide();
    } else {
        $('#ToDuration').show();
    }

    $(document).ready(function() {
        var text_max = 150;
        $('#textarea_feedback').html(text_max + ' characters remaining.');

        $('#NatureOfWork').keyup(function() {
            var text_length = $('#NatureOfWork').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining.');
        });
    });

    $(document).ready(function () {
        var validator = $("#myForm").bootstrapValidator({
            feedbackIcons:{
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                CompanyName: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                CompanyAddress: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                Industry: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                FromMonth: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                FromYear: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                ToMonth: {
                    required: "#Duration:checked",
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                ToYear: {
                    required: "#Duration:checked",
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        },
                        greaterThan: {
                            value: "FromYear",
                            message: "Invalid date."
                        }
                    }
                },
                PositionLevel: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                WorkSpecialization: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                MonthlySalary: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                }
            }
        });
        $("#FromYear").change(function(){
            var from_year = $("#FromYear").val();
            var to_year = $("#ToYear").val();

            if(from_year > to_year){
                $("#ToYear").val(from_year);
                $("#ToYear").parent().removeClass("has-error");
                $("#ToYear").parent().addClass("has-success");
                $($("#ToYear").parent().find(".form-control-feedback")).removeClass("glyphicon-remove");
                $($("#ToYear").parent().find(".form-control-feedback")).addClass("glyphicon-ok");
                $($("#ToYear").parent().find(".help-block")).css("display", "none");
            }
        });
    });
</script>