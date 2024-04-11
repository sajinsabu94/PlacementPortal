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
    <meta name="description" content="Margo - Responsive HTML5 Template">
    <meta name="author" content="iThemesLab">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js" ></script>

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
    <div id="container">
        <!-- Start Header Section -->
        <div class="hidden-header"></div>
        <header class="clearfix">

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
                            <img src="images/PlacementCell.png">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="middle-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="mid-list">
                            &nbsp;
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
                        $CompanyID = $_GET['id'];
                        $companyinfo_tbl =
                            GSecureSQL::query(
                                "SELECT CompanyName,Description,ProfileImage FROM companyinfotbl WHERE CompanyID = ?",
                                TRUE,
                                "s",
                                $CompanyID
                            );                        
                        $CompanyName = $companyinfo_tbl[0][0];
                        $Description = $companyinfo_tbl[0][1];                        
                        $Pic = $companyinfo_tbl[0][2];                                               
        ?>
        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 page-content">
                        <div class="hr4" style="margin-bottom:35px;"></div>
                        <div class = "service-boxed">
                        <div class="classic-testimonials text-center">
                            <img src="./company/<?php echo $Pic?>">
                        </div>
                        </div>
                        <div class="hr4" style="margin-top:35px;margin-bottom:35px;"></div>  
                    </div>

                    <h1 class="text-center"><?php echo $CompanyName ?></h1>

                    <label style="text-align:justify;">
                        <?php echo $Description ?>
                    </label>

                    <div class="hr5" style="margin-top:35px;margin-bottom:35px;"></div>                    
                </div>
            </div>
        </div>  
        <!-- End Content -->
        <script type="text/javascript" src="js/script.js"></script>


        <!-- Start Footer Section -->
        <footer>
            <div class="container">
                <!-- Start Copyright -->
                <div class="copyright-section">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy;PlacementCell - All Rights Reserved</p>
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
    </div>

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</body>
</html>
