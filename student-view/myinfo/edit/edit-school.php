<?php
include('../../../connection.php');
session_start();
include('../../../common-functions.php');
$common_functions->student_login_check();
$StudentID = $_SESSION['StudentID']; // to conform with your coding style -- ghabx

$hashStudentID = hash('md4',$StudentID);

if (isset($_SESSION['StudentID'])) {
    $StudentID = $_SESSION['StudentID'];
} else {
    header("location: ../../../login-student.php");
}

$EditSchoolID = $_GET['id'];
$school_tbl =
    GSecureSQL::query(
        "SELECT * FROM schooltbl WHERE SchoolID = ? AND `StudentID` = ?",
        TRUE,
        "ss",
        $EditSchoolID,
        $_SESSION['StudentID']
    );

if(!count($school_tbl[0])){
    header("Location: ../education.php?error");
    die();
}
$SchoolID = $school_tbl[0][0];
$StudentID = $school_tbl[0][1];
$School = $school_tbl[0][2];
$Attainment = $school_tbl[0][3];
$Course = $school_tbl[0][4];
$Graduated = $school_tbl[0][5];
$GraduatedMonth = substr($Graduated, 0, 2);
$GraduatedYear = substr($Graduated, 3, 6);

$infoquery =
    GSecureSQL::query(
        "SELECT FirstName, LastName, MajorCourse FROM studentinfotbl WHERE StudentID = ?",
        TRUE,
        "s",
        $StudentID
    );

$FirstName = $infoquery[0][0];
$LastName = $infoquery[0][1];
$MajorCourse = $infoquery[0][2];
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
    <title>PlacementCell</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="Margo - Responsive HTML5 Template">
    <meta name="author" content="iThemesLab">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css"/>

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="../../../css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script type="text/javascript" src="../../../js/bootstrapValidator.min.js"></script>

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
<form id="EditSchool" name="EditSchool" autocomplete="off" action="../myinfoedit.php">
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
                                    <span id="notification_count">5</span>
                                    <a href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i
                                            class="fa fa-bell"></i></a>
                                    <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                        <li class="dropdown-header"><label>Notification</label></li>
                                        <li class="disabled"><a href="#" tabindex="-1">No new notification.</a></li>
                                        <li><a href="#" tabindex="-1">The administrator accepted your request.</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../notification/notification.php" tabindex="-1">See All</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b
                                            class="fa fa-user"></b> Welcome, <b><?php echo $StudentName; ?> </b><b
                                            class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Profile <b class="fa fa-user" style="float:right;"></b></a></li>
                                        <li><a href="../../settings/settings.php">Settings <b class="fa fa-cog"
                                                                                              style="float:right;"></b></a>
                                        </li>
                                        <li class="divider"></li>
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
                        <a class="navbar-brand">
                            <img src="../../../images/PlacementCell.png">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-banner no-subtitle">
            <input type="text" class="form-control" id="SchoolID" name="SchoolID" style="display: none;"
                   value="<?php echo $SchoolID; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>School</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#"></a></li>
                            <li>Edit School</li>
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
                                    <input type="text" class="form-control" id="School" name="School"
                                           style="height:34px;" value="<?php echo $School; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Educational Attainment <span>(*)</span></label>
                                    <select id="EducAttainment" name="EducAttainment" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="" <?php if ($Attainment == "") echo 'selected="selected"'; ?>>-
                                            Please select one -
                                        </option>
                                        <option
                                            value="High School Diploma" <?php if ($Attainment == "High School Diploma") echo 'selected="selected"'; ?>>
                                            High School Diploma
                                        </option>
                                        <option
                                            value="Technical Vocational/Certificate" <?php if ($Attainment == "Technical Vocational/Certificate") echo 'selected="selected"'; ?>>
                                            Technical Vocational/Certificate
                                        </option>
                                        <option
                                            value="Bachelor's/College Degree" <?php if ($Attainment == "Bachelor's/College Degree") echo 'selected="selected"'; ?>>
                                            Bachelor's/College Degree
                                        </option>
                                        <option
                                            value="Post Graduate Diploma/Master's Degree" <?php if ($Attainment == "Post Graduate Diploma/Master's Degree") echo 'selected="selected"'; ?>>
                                            Post Graduate Diploma/Master's Degree
                                        </option>
                                        <option
                                            value="Professional License (Passed Board/Bar/Professional License Exam)" <?php if ($Attainment == "Professional License (Passed Board/Bar/Professional License Exam") echo 'selected="selected"'; ?>>
                                            Professional License (Passed Board/Bar/Professional License Exam
                                        </option>
                                        <option
                                            value="Doctorate Degree" <?php if ($Attainment == "Doctorate Degree") echo 'selected="selected"'; ?>>
                                            Doctorate Degree
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course <span>(*)</span></label>
                                    <select id="Course" name="Course" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Course -</option>
                                        <?php
                                        $query = "SELECT * FROM coursetbl";
                                        $tbl = GSecureSQL::query($query, TRUE);
                                        foreach($tbl as $row){
                                            $CourseCode = $row[2];
                                            $CourseTitle = $row[1];
                                            ?>
                                            <option
                                                value="<?php echo $CourseCode; ?>" <?php if ($CourseCode == $Course) echo 'selected="selected"'; ?>><?php echo $CourseTitle; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
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
                                    <?php
                                    $g = explode(' - ', $school_tbl[0][5]);
                                    $gyf = $g[0];
                                    $gyt = $g[1];
                                    ?>
                                    <label>From</label>
                                    <select id="GraduatedYearFrom" name="GraduatedYearFrom" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Year -</option>
                                        <?php
                                        $date = Date("Y") + 1;
                                        while ($date != 1935) {
                                            $date--;
                                            if($gyf == $date){
                                                echo "<option value='$date' selected> $date</option>";
                                            }else{
                                                echo "<option value='$date'> $date</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To</label>
                                    <select id="GraduatedYearTo" name="GraduatedYearTo" class="form-control"
                                            style="width:100%; height:34px;">
                                        <option value="">- Year -</option>
                                        <?php
                                        $date = Date("Y") + 15;
                                        while ($date != 1935) {
                                            $date--;
                                            if($gyt == $date){
                                                echo "<option value='$date' selected> $date</option>";
                                            }else{
                                                echo "<option value='$date'> $date</option>";
                                            }
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
                <div class="field">
                    <div class="text-center">
                        <button type="submit" class="btn-system btn-large" name="btnSave">Save</button>
                        <a href="../education.php" class="btn-system btn-large btn-black">Cancel</a>
                    </div>
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
    $(document).ready(function () {
        $("#EducAttainment").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "High School Diploma") {
                    $("#Course").val("");
                    $("#Course").hide();
                    $("#txtCourse").hide();
                    $("#lblCourse").hide();
                } else {
                    $("#Course").show();
                    $("#lblCourse").show();
                }
            });
        }).change();
    });

    $(document).ready(function () {
        $("#Course").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "other") {
                    $("#txtCourse").val("");
                    $("#txtCourse").show();
                } else {
                    $("#txtCourse").hide();
                }
            });
        }).change();
    });


    $(document).ready(function () {
        var validator = $("#EditSchool").bootstrapValidator({
            feedbackIcons: {
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
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: "School must be 3-30 characters long."
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
                            message: "Year graduated is required."
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