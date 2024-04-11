<?php
include('connection.php');
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
    <link href="fonts/ffonts/montserrat.css" rel="stylesheet" type="text/css">
    <link href="fonts/ffonts/kaushan.css" rel="stylesheet" type="text/css">
    <link href="fonts/ffonts/droid.css" rel="stylesheet" type="text/css">
    <link href="fonts/ffonts/roboto.css" rel="stylesheet" type="text/css">

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
<form method="POST" name="companyregistration" id="companyregistration" action="addcompany.php" autocomplete="off">
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
                            <li><a href="login-company.php">Login</a></li>
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
                <div class="row">
                    <div class="col-md-6">
                        <h3><strong>Company Information:</strong></h3>

                        <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>

                        <div class="form-group">
                            <label>Company Name <span>(*)</span></label>
                            <input type="text" class="form-control" id="CompanyName" name="CompanyName">
                        </div>
                        <div class="form-group">
                            <label>Industry <span>(*)</span></label><br>
                            <select id="Industry" name="Industry" class="industry form-control">
                                <option value>Select Industry</option>
                                <?php
                                $listofindustrytbl =
                                    GSecureSQL::query(
                                        "SELECT * FROM listofindustrytbl",
                                        TRUE
                                    );
                                foreach ($listofindustrytbl as $value) {
                                    $Industry = $value[1];
                                    ?>
                                    <option value="<?php echo $Industry; ?>"><?php echo $Industry; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City <span>(*)</span></label><br>
                              <input type="text" class="form-control" id="City" name="City">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="Email" name="Email">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="cPassword" name="cPassword">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <h3><strong>Primary User Information:</strong></h3>

                        <div class="hr1" style="margin-top:10px;margin-bottom:10px;"></div>

                        <div class="form-group">
                            <label>First Name <span>(*)</span></label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName">
                        </div>
                        <div class="form-group">
                            <label>Middle Name <span>(*)</span></label>
                            <input type="text" class="form-control" id="MiddleName" name="MiddleName">
                        </div>
                        <div class="form-group">
                            <label>Last Name <span>(*)</span></label>
                            <input type="text" class="form-control" id="LastName" name="LastName">
                        </div>
                        <div class="form-group">
                            <label>Contact Number <span>(*)</span></label>
                            <input type="text" class="form-control" id="Contact" name="Contact" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label>Position <span>(*)</span></label>
                            <input type="text" class="form-control" id="Position" name="Position">
                        </div>
                        <div class="form-group">
                            <label>Department <span>(*)</span></label>
                            <input type="text" class="form-control" id="Department" name="Department">
                        </div>

                        <label style="float:right;"><span>(*)</span> <em> - Required Fields</em></label>
                    </div>
                </div>
                <div class="hr5" style="margin-top:40px;margin-bottom:40px;"></div>

                <div class"row">
                    <div class="col-md-6">
                        <label>
                            <b>By clicking the "Sign Up" button, I certify that I have read and agree to the <a href="" target="_blank">Terms of Use</a>.</b>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" name="btnsave" id="btnsave" class="btn-system btn-large border-btn"
                                style="float:right;">Sign Up
                        </button>
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
    </div>
</form>
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#companyregistration").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
           fields: {
                CompanyName: {
                    validators: {
                        notEmpty: {
                            message: "Compamy Name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Company Name can consist of alphabetical characters and spaces only"
                        },
                        remote: {
                            message: 'The Company Name already exists',
                            url: 'addcompany.php',
                            data: {
                                type: 'CompanyName'
                            },
                            type: 'POST'
                        }
                    }
                },
                Industry: {
                    validators: {
                        notEmpty: {
                            message: "Industry is required."
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
                FirstName: {
                    validators: {
                        notEmpty: {
                            message: "First name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "First Name can consist of alphabetical characters and spaces only"
                        }
                    }
                },
                LastName: {
                    validators: {
                        notEmpty: {
                            message: "Last name is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Last Name can consist of alphabetical characters and spaces only"
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
                Department: {
                    validators: {
                        notEmpty: {
                            message: "Department is required."
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
                cPassword: {
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
                            field: "cPassword",
                            message: "Password and confirm password mismatched."
                        }
                    }
                },
                Contact: {
                    validators: {
                        notEmpty: {
                            message: "Contact Number is required."
                        },
                        stringLength: {
                            min: 11,
                            message: "Contact Number must be 11 characters long."
                        },
                        regexp: {
                            regexp: /^[0-9]+$/i,
                            message: "Contact Number can consist of numeric characters only."
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>