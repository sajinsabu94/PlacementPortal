<?php
include('connection.php');
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Registration</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="PlacementCell">
    <link rel="shortcut icon" href="images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script src="js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="css/PlacementCell-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="js/jquery.migrate.js"></script>
    <script type="text/javascript" src="js/modernizrr.js"></script>
    <script type="text/javascript" src="js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <script type="text/javascript" src="js/count-to.js"></script>
    <script type="text/javascript" src="js/jquery.textillate.js"></script>
    <script type="text/javascript" src="js/jquery.lettering.js"></script>
    <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.parallax.js"></script>
    <script type="text/javascript" src="js/jquery.slicknav.js"></script>
</head>

<body>
<form method="POST" id="registration" name="registration" autocomplete="off" action="registeradd.php">
    <!-- Container -->
    <div id="container">
        <div class="hidden-header"></div>

        <!-- Start Page Banner -->
        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/PlacementCell.png">
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li>Already a member?</li>
                            <li><a href="login-student.php">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->


        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <div class="big-title text-center">
                    <h1><strong>Registration</strong></h1>
                </div>
                <h3><strong>Student Details:</strong></h3>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label>Student ID <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="StudentID" name="StudentID" maxlength="11">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>First Name <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="FirstName" name="FirstName">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Last Name <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="LastName" name="LastName">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Birthdate <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="date" class="form-control" name="Birthday" id="Birthday">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Mobile Number <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Email <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="email" class="form-control" id="Email" name="Email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Email <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="ConfirmEmail" name="ConfirmEmail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Password <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="password" class="form-control" id="_Password" name="_Password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>City <span>(*)</span></label>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="City" name="City">                                
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>
                <h3><strong>Educational Background:</strong></h3><br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Course <span>(*)</span></label>
                        <div class="form-group">
                            <select id="Course" name="Course" class="form-control" style="width:100%; height:34px;">
                                <option value="">- Please select one -</option>
                                <?php
                                $course_tbl =
                                    GSecureSQL::query(
                                        "SELECT CourseCode,CourseTitle FROM coursetbl",
                                        TRUE
                                    );
                                foreach ($course_tbl as $value) {
                                    $CourseCode = $value[0];
                                    $CourseTitle = $value[1];
                                    print_r($course_tbl);
                                    ?>
                                    <option value="<?php echo $CourseCode; ?>"><?php echo $CourseTitle; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Graduation Date <span>(*)</span></label>
                            <select id="GraduatedMonth" name="GraduatedMonth" class="form-control"
                                    style="width:100%; height:34px;">
                                <option value="">- Month -</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="10">October</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <select id="GraduatedYear" name="GraduatedYear" class="form-control"
                                    style="width:100%; height:34px;">
                                <option value="">- Select year -</option>
                                <?php
                                $date = Date("Y") + 1;
                                while ($date != 1935) {
                                    $date--;
                                    echo "<option value='$date'>$date</option>";

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <label style="float:right;"><span>(*)</span> <em> - Required Fields</em></label>
                </div>
                <div class="hr5" style="margin-top:40px;margin-bottom:40px;"></div>
                <div class"row">
                    <div class="col-md-6">
                        <label><b>By clicking the "Sign Up" button, I certify that I have read and agree to the <a
                                    href="" target="_blank">Terms of Use</a>.</b></label>
                    </div>
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                </div>
                
                <div class="row">
                    <button type="submit" name="btnSave" class="btn-system btn-large border-btn" style="float:right;">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->

    <!-- Start Footer Section -->
    <footer>
        <div class="container">
            <!-- Start Copyright -->
            <div class="copyright-section">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2015 PlacementCell - All Rights Reserved</p>
                    </div>
                    <!-- .col-md-6 -->
                    <div class="col-md-6">
                        <ul class="footer-nav">
                            <li><a href="#">Sitemap</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <!-- .col-md-6 -->
                </div>
                <!-- .row -->
            </div>
            <!-- End Copyright -->
        </div>
    </footer>
    <!-- End Footer Section -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script type="text/javascript" src="js/script.js"></script>
</form>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#registration").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                StudentID: {
                    validators: {
                        notEmpty: {
                            message: "Student ID is required."
                        },
                        stringLength: {
                            min: 3,
                            max: 10,
                            message: "Student ID is invalid."
                        },
                        remote: {
                            message: 'The student ID already exists',
                            url: 'registeradd.php',
                            data: {
                                type: 'StudentID'
                            },
                            type: 'POST'
                        }
                    }
                },
                FirstName: {
                    validators: {
                        notEmpty: {
                            message: "First name is required."
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid name."
                        }
                    }
                },
                LastName: {
                    validators: {
                        notEmpty: {
                            message: "First name is required."
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid name."
                        }
                    }
                },
                Birthday: {
                    validators: {
                        notEmpty: {
                            message: "Birthdate is required."
                        }
                    }
                },
                MobileNumber: {
                    validators: {
                        notEmpty: {
                            message: "Mobile Number is required."
                        },
                        regexp: {
                            regexp: /^[789]\d{9}$/,
                            message: "Invalid mobile number"
                        }
                    }
                },
                Email: {
                    validators: {
                        notEmpty: {
                            message: "Email address is required."
                        }
                    }
                },
                ConfirmEmail: {
                    validators: {
                        notEmpty: {
                            message: "Confirm Email is required."
                        },
                        identical: {
                            field: "Email",
                            message: "Email and Confirm email mismatched."
                        }
                    }
                },
                _Password: {
                    validators: {
                        notEmpty: {
                            message: "Password is required."
                        },

                        stringLength: {
                            min: 8,
                            max: 16,
                            message: "Password must be 8-16 characters long."
                        }

                    }
                },
                ConfirmPassword: {
                    validators: {
                        notEmpty: {
                            message: "Confirm password is required."
                        },
                        identical: {
                            field: "_Password",
                            message: "Password and confirm password mismatched."
                        }
                    }
                },
                City: {
                    validators: {
                        notEmpty: {
                            message: "City is required."
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
                GraduatedMonth: {
                    validators: {
                        notEmpty: {
                            message: "Month is required."
                        }
                    }
                },
                GraduatedYear: {
                    validators: {
                        notEmpty: {
                            message: "Year is required."
                        }
                    }
                }
            }
        });
    });
</script>