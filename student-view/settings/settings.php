<?php
session_start();
include('../../connection.php');
include('../../common-functions.php');
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
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <title>PlacementCell | Settings</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="PlacementCell">

    <link rel="shortcut icon" href="../../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../../css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

    <!-- BootstrapValidator -->
    <script src="../../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/animate.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../../css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="../../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../../js/modernizrr.js"></script>
    <script type="text/javascript" src="../../js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.appear.js"></script>
    <script type="text/javascript" src="../../js/count-to.js"></script>
    <script type="text/javascript" src="../../js/jquery.textillate.js"></script>
    <script type="text/javascript" src="../../js/jquery.lettering.js"></script>
    <script type="text/javascript" src="../../js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.parallax.js"></script>
    <script type="text/javascript" src="../../js/jquery.slicknav.js"></script>

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../../css/checkbox.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="../../css/color-selector/prettify.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/color-selector/bootstrap-colorselector.css"/>

    <!-- fileupload -->
    <link href="../../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="../../js/fileinput.min.js" type="text/javascript"></script>

    <!-- Notification -->
    <link rel="stylesheet" href="../../css/notif.css"/>

    <?php
    $Countnotification =
        GSecureSQL::query(
            "SELECT COUNT(*) FROM studnotificationtbl WHERE StudentID = ? AND Seen = 0",
            TRUE,
            "s",
            $StudentID
        );

    $Notif_Count = $Countnotification[0][0];
    if ($Notif_Count == 0) {
        ?>
        <script type="text/javascript">
            $(window).load(function () {
                $("#notification_count").hide();
            });
        </script>
        <?php
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#notificationLink").click(function () {
                $("#notificationContainer").fadeToggle(300);
                $("#notification_count").fadeOut("slow");
                return false;
            });

            $("#notif").click(function () {
                $.ajax({
                    type: "POST",
                    url: 'function_notif.php'
                });
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
                                    <span id="notification_count"><?php echo $Notif_Count; ?></span>
                                    <a id="notif" href="#" class="bell itl-tooltip" data-placement="bottom" data-toggle="dropdown"><i class="fa fa-bell"></i></a>
                                    <ul id="notificationContainer" class="dropdown-menu dropdown-menu-inverse">
                                        <li class="dropdown-header"><label>Notification</label></li>
                                        <?php
                                        $NotificationContent =
                                            GSecureSQL::query(
                                                "SELECT Message,_From,_Date FROM studnotificationtbl WHERE StudentID = ? ORDER BY Time ASC LIMIT 10",
                                                TRUE,
                                                "s",
                                                $StudentID
                                            );
                                        foreach ($NotificationContent as $value) {
                                            $Message = $value[0];
                                            $From = $value[1];
                                            $Date = $value[2];
                                            ?>
                                            <li><a tabindex="-1"><b><?php echo $From; ?>: </b><?php echo $Message; ?></a></li>
                                            <?php
                                        }
                                        ?>

                                        <li class="divider"></li>
                                        <li><a href="wala pa to e" tabindex="-1">See All</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user"></b> Welcome, <b><?php echo $StudentName; ?> </b><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a href="../../student-profile.php?id=">Profile <b class="fa fa-user" style="float:right;"></b></a></li> -->
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
                                <label = "usr" class = "control-label">Do you want to sign out?</label>
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="../logout.php"
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
                        <a class="navbar-brand" href="../myinfo/personal-info.php">
                            <img src="../../images/PlacementCell.png">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-banner no-subtitle">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Settings</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Content -->
        <div id="content">
            <div class="container">
                
                <div class="tabs-section">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-user"></i>Profile Settings</a></li>
                        <li><a href="#tab-2" data-toggle="tab"><i class="fa fa-check"></i>Privacy Settings</a></li>
                        <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-lock"></i>Password Settings</a></li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">

                        <!-- Tab Content 1 -->
                        <div class="tab-pane fade in active" id="tab-1">
                            <div class="call-action call-action-boxed call-action-style2 clearfix">         
                                <h2 class="primary"><strong>Profile Settings</strong></h2>
                            </div>
                            <div class="hr4" style="margin-top:15px;margin-bottom:25px;"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>About Me</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="" id="" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Use Background</label><br>

                                    <div class="radio radio-inline">
                                        <input type="radio" id="Image" value="Image" name="selection">
                                        <label for="inlineRadio2"> Uploaded Image </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="Color" value="Color" name="selection" checked="checked">
                                        <label for="inlineRadio1"> Solid Color </label>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-6" id="ToImage">
                                            <div id="UploadImages">
                                                <label class="accent-color">Uploaded Image</label>
                                                <div class="classic-testimonials">
                                                    <input id="ProfilePicture" name="" multiple type="file" class="file file-loading"
                                                           data-allowed-file-extensions='["png", "jpg", "bmp", "gif"]'>
                                                    <br>
                                                    <button id="" class="btn-system btn-mini border-btn" name="btnDelete">Delete Image</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="ToColor">
                                            <div id="Colors">
                                                <label class="accent-color">Solid Color</label><br>
                                                <select id="colorselector_1" style="display: none;">
                                                    <option value="106" data-color="#A0522D" selected="selected">sienna</option>
                                                    <option value="47" data-color="#CD5C5C">indianred</option>
                                                    <option value="87" data-color="#FF4500">orangered</option>
                                                    <option value="17" data-color="#008B8B">darkcyan</option>
                                                    <option value="18" data-color="#B8860B">darkgoldenrod</option>
                                                    <option value="68" data-color="#32CD32">limegreen</option>
                                                    <option value="42" data-color="#FFD700">gold</option>
                                                    <option value="77" data-color="#48D1CC">mediumturquoise</option>
                                                    <option value="107" data-color="#87CEEB">skyblue</option>
                                                    <option value="46" data-color="#FF69B4">hotpink</option>
                                                    <option value="64" data-color="#87CEFA">lightskyblue</option>
                                                    <option value="13" data-color="#6495ED">cornflowerblue</option>
                                                    <option value="15" data-color="#DC143C">crimson</option>
                                                    <option value="24" data-color="#FF8C00">darkorange</option>
                                                    <option value="78" data-color="#C71585">mediumvioletred</option>
                                                    <option value="123" data-color="#000000">black</option>
                                                </select>
                                                <script>
                                                    $('#colorselector_1').colorselector();
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr4" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="text-center">
                                <button type="submit" class="btn-system btn-large" name="btnSave">Save</button>
                            </div>
                        </div>

                        
                        <!-- Tab Content 2 -->
                        <div class="tab-pane fade" id="tab-2">
                            <div class="call-action call-action-boxed call-action-style2 clearfix">         
                                <h2 class="primary"><strong>Privacy Settings</strong></h2>
                            </div>
                            <div class="hr4" style="margin-top:15px;margin-bottom:25px;"></div>
                            <div class="row">
                                <div class="project-content col-md-6">
                                    <h4><span>Enable Public Resumelink</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox" checked="checked">
                                        <label for="checkbox3"><b><em> Please note that your name is always displayed.</em></b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="hr4" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="row">
                                <div class="project-content col-md-3">
                                    <h4><span>Personal Info</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Photo</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Birthdate</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Nationality</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Gender</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Civil Status</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Social Networking</b></label>
                                    </div>
                                </div>
                    
                               <div class="project-content col-md-3">
                                    <h4><span>Contact Info</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Email</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Mobile</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Home Number</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Work Number</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Address</b></label>
                                    </div>
                                </div>

                                <div class="project-content col-md-3">
                                    <h4><span>Work</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Work Options</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Objectives</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Work Experience</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="hr4" style="margin-top:35px;margin-bottom:40px;"></div>
                            <div class="row">
                                <div class="project-content col-md-3">
                                    <h4><span>Education</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Schools</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>References</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Portfolio</b></label>
                                    </div>
                                </div>
                    
                               <div class="project-content col-md-3">
                                    <br><br>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Certifications</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Achievements</b></label>
                                    </div>
                                </div>

                                <div class="project-content col-md-5">
                                    <h4><span>Specialization & Languages</span></h4>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Specialization</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox">
                                        <label for="checkbox3"><b>Languages</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Content 3 -->
                        <div class="tab-pane fade in" id="tab-3">
                            <div class="call-action call-action-boxed call-action-style2 clearfix">         
                                <h2 class="primary"><strong>Password Settings</strong></h2>
                            </div>
                            <div class="hr4" style="margin-top:15px;margin-bottom:25px;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Current Password <span>(*)</span></label>
                                        <input type="password" class="form-control" id="txtCurrentPassword" name="txtCurrentPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>New Password <span>(*)</span></label>
                                        <input type="password" class="form-control" id="txtNewPassword" name="txtNewPassword">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm New Password <span>(*)</span></label>
                                        <input type="password" class="form-control" id="txtConfPassword" name="txtConfPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    &nbsp;
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn-system btn-large" style="float:right;" name="btnChangePass">Change Password</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- End Tab Panels -->
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
    <script type="text/javascript" src="../../js/script.js"></script>

    <script src="../../css/color-selector/jquery-1.10.2.min.js"></script>
    <script src="../../css/color-selector/bootstrap-colorselector.js"></script>
    <script src="../../css/color-selector/prettify.js"></script>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="Color"){
                $("#UploadImages").hide();
                $("#Colors").show();
            }
            if($(this).attr("value")=="Image"){
                $("#Colors").hide();
                $("#UploadImages").show();
            }
        });
        if ($('#Color').is(':checked')) {
            $('#UploadImages').hide();
        } else {
            $('#Colors').show();
        }
    });


    $(function () {

        window.prettyPrint && prettyPrint();

        $('#colorselector_1').colorselector();
        $('#colorselector_2').colorselector({
            callback: function (value, color, title) {
                $("#colorValue").val(value);
                $("#colorColor").val(color);
                $("#colorTitle").val(title);
            }
        });

        $("#setColor").click(function (e) {
            $("#colorselector_2").colorselector("setColor", "#008B8B");
        })

        $("#setValue").click(function (e) {
            $("#colorselector_2").colorselector("setValue", 18);
        })

    });
</script>


<?php

if(isset($_POST['btnChangePass'])){

$x = $_SESSION['StudentID'];

$qry = "SELECT * FROM studentinfotbl WHERE StudentID ='$x'";
$result = mysql_query($qry);
        while($qry = mysql_fetch_Array($result))
        {       
                $Password = $qry['Password'];
        }

$oldpassword = $_POST['txtCurrentPassword']; 
$newpassword = $_POST['txtNewPassword']; 
$confirmpass = $_POST['txtConfPassword']; 

        if($oldpassword <> $Password){
            echo "
            <script type='text/javascript'>
            alert('Incorrect Password. Please try again.');
            </script>
            ";
        }
        else {
            if ($newpassword <> $confirmpass) {
                echo "
                <script type='text/javascript'>
                alert('Password mismatch. Please try again.');
                </script>
                ";
            }
            else{
                $query = "UPDATE studentinfotbl SET Password = '$newpassword' WHERE StudentID = '$x'";
                $Result = mysql_query($query);
                echo "
                <script type='text/javascript'>
                location.href='./settings.php';
                alert('Password Changed!');
                </script>
                ";
            }
        }
}
?>
</html>