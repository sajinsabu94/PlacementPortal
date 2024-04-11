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
    <title>PlacementCell | Create Position</title>

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

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../css/checkbox.css" media="screen" />

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
                        <div class="col-md-6">
                            <!-- Start Contact Info -->
                            <ul class="contact-details">
                                <li class="profile-name"><b><?php echo $CompanyName; ?></b></li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-6">
                            <!-- Notification -->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown icon-border" id="notificationLink">
                                     <!--noti
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
                                        Welcome, <b><?php echo $cFirstName . " " . $cLastName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-target='#Logout' data-toggle='modal'>Sign Out <b
                                                    class="fa fa-sign-out" style="float:right;"></b></a></li>
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
                        <!-- End Sign-out -->
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="company.php">Home</a>
                            </li>
                            <li>
                                <a class="active">Position</a>
                                <ul class="dropdown">
                                    <li><a href="company-positionlist.php">Position List</a></li>
                                    <li><a href="company-createposition.php" class="active">Create Position</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>Applicant List</a>
                                <ul class="dropdown">
                                    <li><a href="company-pendingapplicants.php">Pending</a></li>
                                    <li><a href="company-acceptedapplicants.php">Accepted</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="company-settings.php">Settings</a>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
                <!-- Mobile Menu Start -->
                <ul class="wpb-mobile-menu">
                    <li>
                        <a href="company.php">Home</a>
                    </li>
                    <li>
                        <a class="active">Position</a>
                        <ul class="dropdown">
                            <li><a href="company-positionlist.php">Position List</a></li>
                            <li><a href="company-createposition.php" class="active">Create Position</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Applicant List</a>
                        <ul class="dropdown">
                            <li><a href="company-pendingapplicants.php">Pending</a></li>
                            <li><a href="company-acceptedapplicants.php">Accepted</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="company-settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </header>
        <!-- Mobile Menu End -->

        <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; center:#f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Create Position</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <div id="content">
            <form action="add-company.php" name="AddPosition" id="AddPosition" autocomplete="off">
                <div class="container">
                    <div class="col-md-12">
                        <div class="row">
                            <h3>Post Position </h3>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Posting Date: </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>From:</label><input type="date" name="DateFrom" id="date_from" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To:</label><input type="date" name="DateTo" id="date_to" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h3> Position Information </h3>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Position Title: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="PTitle" name="PTitle" class="form-control" style=" width: 100%; height:30px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Position Level: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="PLevel" name="PLevel" class="specialization form-control">
                                            <option value="" selected="selected">- Select Position level -</option>
                                            <?php
                                            $position_tbl =
                                                GSecureSQL::query(
                                                    "SELECT Position FROM listofpositiontbl",
                                                    TRUE
                                                );
                                            foreach ($position_tbl as $value) {
                                                $Position = $value[0];
                                                ?>
                                                <option value="<?php echo $Position; ?>"><?php echo $Position; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Job Description: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="JobDesc" id="JobDesc" class="form-control" style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Job Specialization: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="Specialization" name="Specialization" class="specialization form-control">
                                            <option value="" selected="selected">- Select Specialization -</option>
                                            <?php
                                            $specialization_tbl =
                                                GSecureSQL::query(
                                                    "SELECT * FROM listofspecializationtbl",
                                                    TRUE
                                                );
                                            foreach ($specialization_tbl as $value) {
                                                $Specialization = $value[1];
                                                ?>
                                                <option
                                                    value="<?php echo $Specialization; ?>"><?php echo $Specialization; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Employment Type: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="EType" name="EType" class="state form-control">
                                            <option value="">- Please select One -</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Temporary">Temporary</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Available Position: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="AvPosition" id="AvPosition" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h3> Salary Range </h3>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Range of Salary: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="Salary" name="Salary" class="salaryrange form-control">
                                            <option value="" selected="selected">- Select Salary Range -</option>
                                            <?php
                                            $salaryrange_tbl =
                                                GSecureSQL::query(
                                                    "SELECT * FROM listofsalaryrangetbl",
                                                    TRUE
                                                );
                                            foreach ($salaryrange_tbl as $value) {
                                                $SalaryRange = $value[1];
                                                ?>
                                                <option value="<?php echo $SalaryRange; ?>"><?php echo $SalaryRange; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h3> General Requirements </h3>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Years of Experience:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="Salary" name="YExperience" class="form-control">
                                            <option value="" selected="selected">- Select Year of experience -</option>
                                            <?php
                                            for ($count = 0; $count <= 20; $count++) {
                                                ?>
                                                <option value="<?php echo $count; ?>"><?php echo $count; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Degree Level:</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group" style="margin-bottom: 5px">
                                            <ul>
                                                <li>
                                                    <div class="checkbox checkbox-success">
                                                    <input id="DegreeLevel" class="styled" type="checkbox" name="DegreeLevel[]" value="Bachelor Degree">
                                                    <label for="checkbox3"><b>Bachelor Degree</b></label>
                                                </li>
                                                <li>
                                                    <div class="checkbox checkbox-success">
                                                    <input id="DegreeLevel" class="styled" type="checkbox" name="DegreeLevel[]" value="Masteral Degree">
                                                    <label for="checkbox3"><b>Masteral Degree</b></label>
                                                </li>
                                                <li>
                                                    <div class="checkbox checkbox-success">
                                                    <input id="DegreeLevel" class="styled" type="checkbox" name="DegreeLevel[]" value="Doctorate Degree">
                                                    <label for="checkbox3"><b>Doctorate Degree</b></label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Required Skills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group" style="margin-bottom: 15px">
                                            <input type="text" class="form-control" id="txt-knowledge" name="Knowledge">
                                            <script>
                                                var kl_index = -1;
                                                function delete_knowledge(index) {
                                                    $('#kl-span-' + index).remove();
                                                    $('#kl-a-' + index).remove();
                                                    $('#kl-input-' + index).remove();
                                                }
                                            </script>
                                          <span class="input-group-btn">
                                            <a class="btn btn-primary" onclick="(function(){
                                              var _requirements = $('#txt-knowledge').val();
                                              if(_requirements==''){
                                                  alert('Cannot add empty value.');
                                              }
                                              else{
                                                  kl_index++;
                                                  var kk = $('#knowledge-template');
                                                  var kk_span = kk.find('span');
                                                  var kk_a = kk.find('a');
                                                  var kk_input = kk.find('input');

                                                  kk_span.text($('#txt-knowledge').val());
                                                  kk_span.attr('id', 'kl-span-' + kl_index);
                                                  kk_a.attr('id', 'kl-a-' + kl_index);
                                                  kk_a.attr('onclick', 'delete_knowledge(' + kl_index + ')');
                                                  kk_input.attr('id', 'kl-input-' + kl_index);
                                                  kk_input.attr('name', 'knowledge[' + kl_index +']');
                                                  kk_input.val(kk_span.text());
                                                  $('#knowledge-list').append($('#knowledge-template').html());
                                                  $('#txt-knowledge').val('');

                                                  //disposal of used resource in #knowledge-template
                                                  kk_span.removeAttr('id');
                                                  kk_a.removeAttr('id');
                                                  kk_a.removeAttr('onclick');
                                                  kk_input.removeAttr('id');
                                                  kk_input.removeAttr('name');
                                                  kk_input.removeAttr('value');
                                              }
                                            })()">Add</a>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 15px">
                                <div id="knowledge-template" class="hidden">
                                    <b><span>dito_yung_text</span></b>
                                    <a href="javascript:void(0)">[remove]<br></a>
                                    <input type="hidden"/>
                                </div>
                                <div id="knowledge-list" class="col-md-offset-3 col-md-4"
                                     style="width: 300px; word-wrap: break-word">
                                </div>
                            </div>
                            &nbsp;
                            <div class="row" style="margin-bottom: 15px">
                                <div id="specialize-template" class="hidden">
                                    <b><span>dito_yung_text</span></b>
                                    <a href="javascript:void(0)">[remove]<br></a>
                                    <input type="hidden"/>
                                </div>
                                <div id="specialize-list" class="col-md-offset-3 col-md-8"
                                     style="width: 300px; word-wrap: break-word">
                                </div>
                            </div>
                            <h3> Optional Requirements </h3>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Language: </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group" style="margin-bottom: 15px">
                                            <input type="text" class="form-control" id="txt-language" name="Language">
                                            <script>
                                                var lll_index = -1;
                                                function delete_language(index) {
                                                    $('#lll-span-' + index).remove();
                                                    $('#lll-a-' + index).remove();
                                                    $('#lll-input-' + index).remove();
                                                }
                                            </script>
                                            <span class="input-group-btn">
                                                <a class="btn btn-primary" onclick="(function(){
                                                  var _languages = $('#txt-language').val();
                                                  if(_languages==''){
                                                    alert('Cannot add empty value.');
                                                  }else{
                                                  lll_index++;
                                                  var ll = $('#language-template');
                                                  var ll_span = ll.find('span');
                                                  var ll_a = ll.find('a');
                                                  var ll_input = ll.find('input');

                                                  ll_span.text($('#txt-language').val());
                                                  ll_span.attr('id', 'lll-span-' + lll_index);
                                                  ll_a.attr('id', 'lll-a-' + lll_index);
                                                  ll_a.attr('onclick', 'delete_language(' + lll_index + ')');
                                                  ll_input.attr('id', 'lll-input-' + lll_index);
                                                  ll_input.attr('name', 'language[' + lll_index +']');
                                                  ll_input.val(ll_span.text());
                                                  $('#language-list').append($('#language-template').html());
                                                  $('#txt-language').val('');

                                                  //disposal of used resource in #language-template
                                                  ll_span.removeAttr('id');
                                                  ll_a.removeAttr('id');
                                                  ll_a.removeAttr('onclick');
                                                  ll_input.removeAttr('id');
                                                  ll_input.removeAttr('name');
                                                  ll_input.removeAttr('value');
                                                  }
                                                })()">Add</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 15px">
                                <div id="language-template" class="hidden">
                                    <b><span>dito_yung_text</span></b>
                                    <a href="javascript:void(0)">[remove]<br></a>
                                    <input type="hidden"/>
                                </div>
                                <div id="language-list" class="col-md-offset-3 col-md-8"
                                     style="width: 300px; word-wrap: break-word">
                                </div>
                            </div>
                            <div class="hr5" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="text-center">
                                <button type="submit" class="btn-system btn-large" id="btnsave" name="btnsave">Save</button>
                                <button type="submit" class="btn-system btn-large btn-black" id="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End of Content-->
    <script type="text/javascript" src="../js/script.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#AddPosition").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
           fields: {
                DateFrom: {
                    validators: {
                        notEmpty: {
                            message: "Date From is required."
                        }
                    }
                },
                DateTo: {
                    validators: {
                        notEmpty: {
                            message: "Date To is required."
                        }
                    }
                },
               PTitle: {
                   validators: {
                       notEmpty: {
                           message: "Position Title is required."
                       }
                   }
               },
                PLevel: {
                    validators: {
                        notEmpty: {
                            message: "Position Level is required."
                        }
                    }
                },
                JobDesc: {
                    validators: {
                        notEmpty: {
                            message: "Job Description is required."
                        },
                        stringLength: {
                            min: 5,
                            max: 70,
                            message: "Job Description must be 5-70 characters long."
                        }
                    }
                },
                Specialization: {
                    validators: {
                        notEmpty: {
                            message: "Specialization is required."
                        }
                    }
                },
                EType: {
                    validators: {
                        notEmpty: {
                            message: "Employment Type is required."
                        }
                    }
                },
                AvPosition: {
                    validators: {
                        notEmpty: {
                            message: "Available Position is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 2,
                            message: "Available Position must be 2 digit long."
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "Available Position can consist of Positive Numbers only"
                        }
                    }
                },
                Salary: {
                    validators: {
                        notEmpty: {
                            message: "Salary is required."
                        }
                    }
                },
                YExperience: {
                    validators: {
                        notEmpty: {
                            message: "Years of Experience is required."
                        },
                        stringLength: {
                            min: 1,
                            max: 2,
                            message: "Years of Experience must be 2 digit long."
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "Years of Experience can consist of Positive Numbers only"
                        }
                    }
                },
                'DegreeLevel[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check atleast one."
                        }
                    }
                }

            }
        });
    });
</script>

</html>