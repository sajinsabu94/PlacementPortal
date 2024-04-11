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
    <title>PlacementCell | Add - School</title>

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
    <form id="AddSchool" name="AddSchool" autocomplete="off" action="../myinfoadd.php">
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
                        <h2>School</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#"></a></li>
                            <li>Add School</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <div class="row sidebar-page">
                    <!-- Page Content -->
                    <div class="col-md-9 page-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>School <span>(*)</span></label>
                                    <input type="text" class="form-control" id="School" name="School" style="height:34px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Educational Attainment <span>(*)</span></label>
                                    <select id="EducAttainment" name="EducAttainment" class="form-control" style="width:100%; height:34px;">
                                        <option value="">- Please select one -</option>
                                        <option value="High School Diploma">High School Diploma</option>
                                        <option value="Technical Vocational/Certificate">Technical Vocational/Certificate</option>
                                        <option value="Bachelor's/College Degree">Bachelor's/College Degree</option>
                                        <option value="Post Graduate Diploma/Master's Degree">Post Graduate Diploma/Master's Degree</option>
                                        <option value="Professional License (Passed Board/Bar/Professional License Exam)">Professional License (Passed Board/Bar/Professional License Exam</option>
                                        <option value="Doctorate Degree">Doctorate Degree</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="lblCourse">Course <span>(*)</span></label>
                                    <select id="Course" name="Course" class="form-control" style="width:100%; height:34px;">
                                        <option value="">- Course -</option>
                                        <?php
                                            $course_tbl =
                                                GSecureSQL::query(
                                                    "SELECT * FROM coursetbl",
                                                    TRUE
                                                );
                                            foreach($course_tbl as $value){
                                                $CourseCode = $value[2];
                                                $CourseTitle = $value[1];
                                        ?>
                                        <option value="<?php echo $CourseCode; ?>"><?php echo $CourseTitle; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="other">others</option>
                                    </select>
                                    <br>
                                    <input type="text" class="form-control" id="txtCourse" name="txtCourse" style="height:34px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Year Covered <span>(*)</span>:</label>
                            </div>
                            <div class="col-md-6">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From</label>
                                    <select id="GraduatedYearFrom" name="GraduatedYearFrom" class="form-control" style="width:100%; height:34px;">
                                        <option value="">- Year -</option>
                                        <?php
                                        $date = Date("Y") + 1;
                                        while($date != 1935){
                                            $date--;
                                            echo "<option value='$date'> $date</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To</label>
                                    <select id="GraduatedYearTo" name="GraduatedYearTo" class="form-control" style="width:100%; height:34px;">
                                        <option value="">- Year -</option>
                                        <?php
                                            $date = Date("Y") + 1;
                                            while($date != 1935){
                                                $date--;
                                                echo "<option value='$date'> $date</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Content -->

                    <!--Sidebar-->
                    <div class="col-md-3 sidebar right-sidebar">
                        <!-- Search Widget -->
                        <div class="call-action call-action-boxed call-action-style2 clearfix">
                            <label><span>(*)</span> Note: Required fields.</label>
                        </div>
                    </div>
                    <!--End sidebar-->
                </div>
                <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                <div class="text-center">
                    <button type="submit" class="btn-system btn-large border-btn">Add</button>
                    <a href="../education.php" class="btn-system btn-large btn-black">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
    <script type="text/javascript" src="../../../js/script.js"></script>
</form>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $("#EducAttainment").change(function(){
            $(this).find("option:selected").each(function(){
                if($(this).attr("value")=="High School Diploma"){
                    $("#Course").val("");
                    $("#Course").hide();
                    $("#txtCourse").hide();
                    $("#lblCourse").hide();
                }else{
                    $("#Course").show();
                    $("#lblCourse").show();
                }
            });
        }).change();
    });

    $(document).ready(function(){
        $("#Course").change(function(){
            $(this).find("option:selected").each(function(){
                if($(this).attr("value")=="other"){
                    $("#txtCourse").val("");
                    $("#txtCourse").show();
                }else{
                    $("#txtCourse").hide();
                }
            });
        }).change();
    });


    $(document).ready(function () {
            var validator = $("#AddSchool").bootstrapValidator({
                feedbackIcons:{
                    valid: "glyphicon glyphicon-ok",
                    invalid: "glyphicon glyphicon-remove",
                    validating: "glyphicon glyphicon-refresh"
                },
                excluded: [':disabled', ':hidden', ':not(:visible)', '#container'],
                fields: {
                    School: {
                        validators: {
                            notEmpty: {
                                message: "School is required."
                            }
                        }
                    },
                    EducAttainment: {
                        validators: {
                            notEmpty: {
                                message: "Educational Attainment is required."
                            }
                        }
                    },
                    Course: {
                        validators: {
                            notEmpty: {
                                message: "Course is required."
                            }
                        }
                    },
                    txtCourse: {
                        validators: {
                            notEmpty: {
                                message: "Course is required."
                            }
                        }
                    },
                    GraduatedYearFrom: {
                        validators: {
                            notEmpty: {
                                message: "Month graduated is required."
                            }
                        }
                    },
                    GraduatedYearTo: {
                        validators: {
                            notEmpty: {
                                message: "Year graduated is required."
                            },
                            greaterThan: {
                                value: "GraduatedYearFrom",
                                message: "Invalid date."
                            }
                        }
                    }
                }
            });
    });
</script>