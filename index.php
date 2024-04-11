<?php
include("connection.php");

$adminevent_tbl =
    GSecureSQL::query(
        "SELECT 
            *
        FROM `admineventtbl`
        LIMIT 6",
        TRUE
    );
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PlacementCell">
    <meta name="author" content="">

    <title>Placement Cell System</title>

    <!-- Page Description and Author -->
    <meta name="description" content="PCS">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/logo/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="css/about-style.css" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/colors/home-color.css" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.migrate.js"></script>
    <script type="text/javascript" src="js/modernizrr.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
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
    <script type="text/javascript" src="js/mediaelement-and-player.js"></script>
    <script type="text/javascript" src="js/jquery.slicknav.js"></script>
</head>


<body id="page-top" class="index">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><img src="images/logo.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#home">Home</a>
                </li>
                <li>
                    <a class="page-scroll" href="#jobs">Jobs</a>
                </li>
                <li>
                    <a class="page-scroll" href="#events">Events</a>
                </li>                
                <li>
                    <a class="page-scroll" href="#sign-in">Sign In</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Services Section -->
<section id="home" class="bg-light-gray">
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#main-slide" data-slide-to="0" class="active"></li>
            <li data-target="#main-slide" data-slide-to="1"></li>
            <li data-target="#main-slide" data-slide-to="2"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="img-responsive" src="images/slider/1.png" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated2">
                            <span>Welcome to <strong>Placement Portal</strong></span>
                        </h2>
                        <h3 class="animated3">
                            <span>College Name</span>
                        </h3>                        
                    </div>
                </div>
            </div>
            <!--/ Carousel item end -->
            <div class="item">
                <img class="img-responsive" src="images/slider/2.png" alt="slider">
            </div>
            <!--/ Carousel item end -->
            <div class="item">
                <img class="img-responsive" src="images/slider/3.jpg" alt="slider">
            </div>
            <!--/ Carousel item end -->
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
    </div>
    <!-- /carousel -->
</section>

<!-- Start Content -->

<section id="jobs">
    <div class="container">
        <div class="row">
            <div class="big-title text-center animated fadeInDown delay-01" data-animation="fadeInDown"
                 data-animation-delay="01">
                <h1>Search for Your <strong><span class="accent-color">Jobs</span></strong></h1>
                <p class="title-desc"></p>
            </div>
            <div class="col-md-3 pricing-tables" style="left: 37%;">
                <div class="pricing-table highlight-plan">
                    <div class="plan-name">
                        <h3>Latest Jobs</h3>
                    </div>
                    <div class="plan-price">
                        <div class="row">
                            <div class="col-md-6">
                                <button id="btnRefresh" class="btn-system btn-mini border-btn btn-gray">Refresh</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn-system btn-mini border-btn">View More</button>
                            </div>
                        </div>
                    </div>
                    <div class="plan-list" id="Jobs">
                        <ul>
                            <?php
                            $JCount = 0;
                            $compposition_tbl =
                                GSecureSQL::query(
                                    "SELECT
                                            PositionID,
                                            CompanyID,
                                            PostingDateFrom,
                                            PostingDateTo,
                                            PositionTitle
                                            FROM comppositiontbl
                                            ORDER BY PostingDateFrom DESC",
                                    TRUE
                                );
                            foreach ($compposition_tbl as $value) {
                                $PositionID = $value[0];
                                $CompanyID = $value[1];
                                $PostingDateFrom = $value[2];
                                $PostingDateTo = $value[3];
                                $PositionTitle = $value[4];

                                $company_tbl =
                                    GSecureSQL::query(
                                        "SELECT CompanyName FROM companyinfotbl WHERE CompanyID = ?",
                                        TRUE,
                                        "s",
                                        $CompanyID
                                    );
                                foreach ($company_tbl as $value1) {
                                    $CompanyName = $value1[0];

                                    $diff_from = date_diff(new DateTime(), new DateTime($PostingDateFrom));
                                    $diff_to = date_diff(new DateTime(), new DateTime($PostingDateTo));

                                    if ($diff_to->d == 0) {
                                        $diff_to->invert = 0;
                                    }

                                    $a = $diff_from->y >= 0 &&
                                        $diff_from->m >= 0 &&
                                        $diff_from->d >= 0 &&
                                        $diff_from->invert == 1;

                                    $b = $diff_to->y >= 0 &&
                                        $diff_to->m >= 0 &&
                                        $diff_to->d >= 0 &&
                                        $diff_to->invert == 0;

                                    if ($a && $b) {
                                        $JCount++;
                                        if ($JCount <= 5) {
                                            ?>
                                            <li><strong><a href=""><?php echo $PositionTitle; ?></a></strong>
                                                <div class="interval">Posted By: <?php echo $CompanyName; ?></div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                        </ul>
                    </div>
                    <script>
                        $(document).ready(function () {

                            function RefreshTable() {
                                $("#Jobs").load("index.php #Jobs");
                            }

                            $("#btnRefresh").on("click", RefreshTable);
                        });
                    </script>
                    <div class="plan-signup">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>


<section id="events" class="section" style="background-color:#00599D;">
    <div class="container">
        <div class="recent-projects">
            <h4 class="title-yellow wite-text">Events</h4>
            <div class="projects-carousel touch-carousel">
                <?php
                $events_tbl =
                    GSecureSQL::query(
                        "SELECT EventTitle, ProfileImage FROM admineventtbl",
                        TRUE
                    );
                foreach ($events_tbl as $value) {
                    $EventTitle = $value[0];
                    $ProfileImage = $value[1];
                    ?>
                    <div class="portfolio-item item">
                        <div class="portfolio-border">
                            <div class="portfolio-thumb">
                                <a class="lightbox" title="<?php echo $EventTitle; ?>"
                                   href="images/event/gen-ass-2016.jpg">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    <img alt="" src="admin/<?php echo $ProfileImage; ?>"/>
                                </a>
                            </div>
                            <div class="portfolio-details">
                                <a href="for-index/view-event.php">
                                    <h4><?php echo $EventTitle; ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
        <!-- End Recent Projects Carousel -->

        <!-- Divider -->
        <div class="hr1 margin-60"></div>
        
    </div>
</section>

<section id="sign-in" class="parallax" style="background-image:url(images/sti-bldg.jpg);">
    <div class="overlay">
        <div class="parallax-text-container-1">
            <div class="parallax-text-item">
                <div class="container">
                    <div class="row">
                        <div class="big-title text-center animated fadeInDown delay-01" data-animation="fadeInDown"
                             data-animation-delay="01">
                            <strong><h1 class="wite-text">Sign In</h1></strong>
                        </div>

                        <ul class="timeline">
                            <li>
                                <div class="timeline-image">
                                    <a href="login-student.php"><img class="img-circle img-responsive"
                                                                     src="images/home/student.png" alt=""></a>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <strong><h1 style="color:#337ab7;">Student</h1></strong>
                                        <h4 class="subheading">This section is exclusively made for TKMCE students.</h4>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <a href="login-company.php"><img class="img-circle img-responsive"
                                                                     src="images/home/company.png" alt=""></a>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <strong><h1 style="color:#f8ba01;">Company</h1></strong>
                                        <h4 class="subheading">This section is designed for TKM partner companies.</h4>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>       
<footer id="contact">
    <div class="container">
        <div class="footer-widget contact-widget">
            <div class="row text-center">
                <h4>Contact Us</h4>
                <div><b>Tel. no. <?php echo 1111111111 ?></b></div>
                <label><?php echo Address ?></label>
            </div>
            <div class="row text-center">
                <ul>
                    <li><span>Phone Number:</span> <?php echo 9876543210 ?></li>
                    <li><span>Email:</span><?php echo "email@email.com" ?></li>
                    <li><span>Website:</span><?php echo "xetatria.in" ?></li>
                </ul>
            </div>
        </div>
        <div class="row text-center">
            <div class="footer-widget social-widget">
                <h4>Follow Us</h4>
                <ul class="social-icons">
                    <li><a class="facebook"
                           href="#"><i
                                class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i
                                class="fa fa-twitter"></i></a></li>
                    <li><a class="google" href="#"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Start Copyright -->
        <div class="copyright-section">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2017 PlacementCell - All Rights Reserved</p>
                </div>
                <div class="col-md-6">
                    <ul class="footer-nav">
                        <li><a href="#">Sitemap</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Copyright -->
    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<div id="loader">
    <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>

<!-- important-->
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/home/ease.js"></script>
<script src="js/home/classie.js"></script>
<script src="js/home/cbpAnimatedHeader.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/home/agency.js"></script>
</body>
</html>
