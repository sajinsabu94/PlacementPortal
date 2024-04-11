<?php
include('../connection.php');

if (isset($_POST['JobID'])) {
    $JobID = $_POST['JobID'];
}

$JobParticipation =
    GSecureSQL::query(
        "SELECT * FROM jobfairtbl WHERE id = ?",
        TRUE,
        "s",
        $JobID
    );

$CompanyName = $JobParticipation[0][1];
$CompanyAddress = $JobParticipation[0][2];
$City = $JobParticipation[0][3];
$Website = $JobParticipation[0][4];
$ContactPerson = $JobParticipation[0][5];
$Designation = $JobParticipation[0][6];
$Email = $JobParticipation[0][7];
$Phone1 = $JobParticipation[0][8];
$Phone2 = $JobParticipation[0][9];
$Phone3 = $JobParticipation[0][10];
$MobileNumber = $JobParticipation[0][11];
$FaxNumber = $JobParticipation[0][12];
$Industry = $JobParticipation[0][13];
$Representative1 = $JobParticipation[0][14];
$Representative2 = $JobParticipation[0][15];
$MarketingMaterials = $JobParticipation[0][16];
$Others = $JobParticipation[0][17];
$Extras = $JobParticipation[0][18];
$OthersExtra = $JobParticipation[0][19];
$RoomForExam = $JobParticipation[0][20];
$DoorPrizes = $JobParticipation[0][21];
$ItemDescription = $JobParticipation[0][22];
$Participate = $JobParticipation[0][23];
$Requirements = $JobParticipation[0][24];

$Extras = explode("- ", $Extras);
$MarketingMaterials = explode("- ", $MarketingMaterials);
$Requirements = explode("- ", $Requirements);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>PlacementCell | Job Fair Participation</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content=" - Responsive HTML5 Template">
    <link rel="shortcut icon" href="../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css" media="screen">

    <!-- PlacementCell CSS  -->
    <link rel="stylesheet" type="text/css" href="../css/PlacementCell-style.css" media="screen">

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

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>

<body>
<div id="container">
    <div class="page-banner no-subtitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">JOB FAIR PARTICIPATION CONFIRMATION FORM</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="call-action call-action-boxed call-action-style2 clearfix">
                <img src="../images/forms/banner.jpg">

                <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>
                <div class="row">
                    <div class="text-center"><label>Required Fields <span>(*)</span></label></div>
                    <div class="col-md-6">
                        <label>Company Name <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $CompanyName; ?>" disabled>
                        </div>

                        <label>Company Address <span>(*)</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                Street Address
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $CompanyAddress; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                City <span>(*)</span>
                                <div class="form-group">
                                    <select class="form-control" disabled>
                                        <option value=""></option>
                                        <option <?php if ($City == "City of Manila") echo "selected='selected'" ?> value="City of Manila">City of Manila</option>
                                        <option <?php if ($City == "Caloocan") echo "selected='selected'" ?> value="Caloocan">Caloocan</option>
                                        <option <?php if ($City == "Las Piñas") echo "selected='selected'" ?> value="Las Piñas">Las Piñas</option>
                                        <option <?php if ($City == "Makati") echo "selected='selected'" ?> value="Makati">Makati</option>
                                        <option <?php if ($City == "Malabon") echo "selected='selected'" ?> value="Malabon">Malabon</option>
                                        <option <?php if ($City == "Mandaluyong") echo "selected='selected'" ?> value="Mandaluyong">Mandaluyong</option>
                                        <option <?php if ($City == "Marikina") echo "selected='selected'" ?> value="Marikina">Marikina</option>
                                        <option <?php if ($City == "Muntinlupa") echo "selected='selected'" ?> value="Muntinlupa">Muntinlupa</option>
                                        <option <?php if ($City == "Navotas") echo "selected='selected'" ?> value="Navotas">Navotas</option>
                                        <option <?php if ($City == "Parañaque") echo "selected='selected'" ?> value="Parañaque">Parañaque</option>
                                        <option <?php if ($City == "Pasay") echo "selected='selected'" ?> value="Pasay">Pasay</option>
                                        <option <?php if ($City == "Pasig") echo "selected='selected'" ?> value="Pasig">Pasig</option>
                                        <option <?php if ($City == "Quezon City") echo "selected='selected'" ?> value="Quezon City">Quezon City</option>
                                        <option <?php if ($City == "San Juan") echo "selected='selected'" ?> value="San Juan">San Juan</option>
                                        <option <?php if ($City == "Taguig") echo "selected='selected'" ?> value="Taguig">Taguig</option>
                                        <option <?php if ($City == "Valenzuela") echo "selected='selected'" ?> value="Valenzuela">Valenzuela</option>
                                        <option <?php if ($City == "Others") echo "selected='selected'" ?> value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <label>Website <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $Website; ?>" disabled>
                        </div>

                        <label>Contact Person <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $ContactPerson; ?>" disabled>
                        </div>

                        <label>Designation <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $Designation; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Email Address <span>(*)</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $Email; ?>" disabled>
                        </div>

                        <label>Telephone No. <span>(*)</span></label>
                        <div class="row">
                            <div class="col-md-4">
                                Phone No. 1
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $Phone1; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                Phone No. 2
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $Phone2; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                Phone No. 3
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $Phone3; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <label>Mobile No.</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $MobileNumber; ?>" disabled>
                        </div>

                        <label>Fax No.</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $FaxNumber; ?>" disabled>
                        </div>

                        <label>Type of Industry <span>(*)</span></label>
                        <div class="form-group">
                            <select class="form-control" disabled>
                                <option value=""></option>
                                <option <?php if ($Industry == "Accounting") echo "selected='selected'" ?> value="Accounting">Accounting</option>
                                <option <?php if ($Industry == "Admin / Human Resources") echo "selected='selected'" ?> value="Admin / Human Resources">Admin / Human Resources</option>
                                <option <?php if ($Industry == "Banking / Financial / Insurance") echo "selected='selected'" ?> value="Banking / Financial / Insurance">Banking / Financial / Insurance</option>
                                <option <?php if ($Industry == "Beauty / Health Care / Social Assistance") echo "selected='selected'" ?> value="Beauty / Health Care / Social Assistance">Beauty / Health Care / Social Assistance</option>
                                <option <?php if ($Industry == "Business Process Outsourcing (BPO) / Call Center") echo "selected='selected'" ?> value="Business Process Outsourcing (BPO) / Call Center">Business Process Outsourcing (BPO) / Call Center</option>
                                <option <?php if ($Industry == "Building / Construction") echo "selected='selected'" ?> value="Building / Construction">Building / Construction</option>
                                <option <?php if ($Industry == "Computer/ IT (Hardware)") echo "selected='selected'" ?> value="Computer/ IT (Hardware)">Computer/ IT (Hardware)</option>
                                <option <?php if ($Industry == "Computer/ IT (Network/Sys/DB)") echo "selected='selected'" ?> value="Computer/ IT (Network/Sys/DB)">Computer/ IT (Network/Sys/DB)</option>
                                <option <?php if ($Industry == "Computer/ IT (Software)") echo "selected='selected'" ?> value="Computer/ IT (Software)">Computer/ IT (Software)</option>
                                <option <?php if ($Industry == "Education / Training and Development") echo "selected='selected'" ?> value="Education / Training and Development">Education / Training and Development</option>
                                <option <?php if ($Industry == "Engineering") echo "selected='selected'" ?> value="Engineering">Engineering</option>
                                <option <?php if ($Industry == "Government") echo "selected='selected'" ?> value="Government">Government</option>
                                <option <?php if ($Industry == "Hospitality / F & B") echo "selected='selected'" ?> value="Hospitality / F &amp; B">Hospitality / F &amp; B</option>
                                <option <?php if ($Industry == "Management") echo "selected='selected'" ?> value="Management">Management</option>
                                <option <?php if ($Industry == "Manufacturing") echo "selected='selected'" ?> value="Manufacturing">Manufacturing</option>
                                <option <?php if ($Industry == "Marketing / Public Relations") echo "selected='selected'" ?> value="Marketing / Public Relations">Marketing / Public Relations</option>
                                <option <?php if ($Industry == "Medical Services") echo "selected='selected'" ?> value="Medical Services">Medical Services</option>
                                <option <?php if ($Industry == "Merchandising / Purchasing") echo "selected='selected'" ?> value="Merchandising / Purchasing">Merchandising / Purchasing</option>
                                <option <?php if ($Industry == "Printing") echo "selected='selected'" ?> value="Printing">Printing</option>
                                <option <?php if ($Industry == "Professional Services") echo "selected='selected'" ?> value="Professional Services">Professional Services</option>
                                <option <?php if ($Industry == "Property / Real Estate") echo "selected='selected'" ?> value="Property / Real Estate">Property / Real Estate</option>
                                <option <?php if ($Industry == "Sales / Customer Service") echo "selected='selected'" ?> value="Sales / Customer Service">Sales / Customer Service</option>
                                <option <?php if ($Industry == "Sciences / Lab / R & D") echo "selected='selected'" ?> value="Sciences / Lab / R &amp; D">Sciences / Lab / R &amp; D</option>
                                <option <?php if ($Industry == "Telecommunications") echo "selected='selected'" ?> value="Telecommunications">Telecommunications</option>
                                <option <?php if ($Industry == "Transportation / Logistics") echo "selected='selected'" ?> value="Transportation / Logistics">Transportation / Logistics</option>
                                <option <?php if ($Industry == "Wholesale / Retail Trade") echo "selected='selected'" ?> value="Wholesale / Retail Trade">Wholesale / Retail Trade</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Name of Company Representative/s <span>(*)</span></label> <i data-toggle="tooltip" title data-original-title="Due to limited space, maximum of two company representatives are allowed to man the booth." class="fa fa-question-circle"></i>
                        <div class="row">
                            <div class="col-md-6">
                                Name of Representative 1
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $Representative1; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                Name of Representative 2
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $Representative2; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <label>List of Marketing Materials to bring <span>(*)</span></label> <i data-toggle="tooltip" title data-original-title="Companies may bring in and use any of the equipment only during the Job Fair. Promotional items as your freebies are encouraged."
                                                                                                class="fa fa-question-circle"></i>
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                foreach ($MarketingMaterials as $value) {
                                    $Material = $value;
                                    ?>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                        <label for="checkbox3"><b><?php echo $Material; ?></b></label>
                                    </div>
                                    <?php
                                }

                                if (!empty($Others)) {
                                    ?>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                        <label for="checkbox3"><b>Others</b></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $Others; ?>" disabled>

                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>The STI Caloocan Alumni and Placement Office will provide each company partner with a table, 2 chairs for the company representatives, 2 chairs for the applicants and number label. Please indicate if you have additional equipment or special service.</label>
                        <?php
                        foreach ($Extras as $value) {
                            $Extra = $value;
                            if($Extra == ""){
                                ?>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" class="styled" type="checkbox" disabled>
                                    <label for="checkbox3"><b>Extra Table</b></label>
                                </div>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" class="styled" type="checkbox" disabled>
                                    <label for="checkbox3"><b>Electrical power</b></label>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                    <label for="checkbox3"><b><?php echo $Extra; ?></b></label>
                                </div>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                    <label for="checkbox3"><b><?php echo $Extra; ?></b></label>
                                </div>
                                <?php
                            }

                        }

                        if (!empty($OthersExtra)) {
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                <label for="checkbox3"><b>Others</b></label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $OthersExtra; ?>" disabled placeholder="Others: Please Specify">
                            </div>
                            <?php
                        }
                        ?>

                        <label>Our company would like to schedule a room for examination (This is a free service for employers.)</label>
                        <?php
                        if($RoomForExam == 'on'){
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                <label for="checkbox3"><b>Yes</b></label>
                            </div>
                        <?php
                        }else{
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" disabled>
                                <label for="checkbox3"><b>Yes</b></label>
                            </div>
                        <?php
                        }
                        ?>

                        <label>Our company can provide an item for door prizes.</label>
                        <?php
                        if($DoorPrizes == 'on'){
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                <label for="checkbox3"><b>Yes</b></label>
                            </div>
                            Item Description:
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $ItemDescription; ?>" disabled placeholder="">
                            </div>
                        <?php
                        }
                        else{
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" disabled>
                                <label for="checkbox3"><b>Yes</b></label>
                            </div>
                            Item Description:
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $ItemDescription; ?>" disabled placeholder="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                <div class="row">
                    <h1 class="text-center">PARTICIPATION CONFIRMATION</h1>
                    <div class="col-md-12">
                        <label>Please check <span>(*)</span></label>
                        <div class="checkbox checkbox-success">
                            <input id="checkbox3" class="styled" type="checkbox" <?php if($Participate == 'on') echo "checked"; ?> disabled>
                            <label for="checkbox3"><b>YES, We will participate in Job Fair 2015</b></label>
                        </div>
                        <label>In order to complete the process, you are requested to forward the following requirements <span>(*)</span>:</label><br>
                        Please email at <u>jobplacement@caloocan.sti.edu</u>
                        <?php
                        foreach($Requirements as $value){
                            $Requirement = $value;
                            ?>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" class="styled" type="checkbox" checked disabled>
                                <label for="checkbox3"><b><?php echo $Requirement; ?></b></label>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                <div class="row text-center">
                    <h1 class="text-center">CONTACT US</h1>
                    <p>If you would like more information about the Jobs Fair, please contact:</p>

                    <label>MS. ANNABELLE O. VILLEGAS</label>
                    <p>Alumni and Job Placement Officer</p>
                    <p>STI College – Caloocan</p>
                    <p>Contact No.: (02) 294 - 4001 to 02 loc. 110-111</p>
                    <p>Mobile no. : 0932-8436642</p>
                    Email adds.: <span class="accent-color">annabelle.villegas@caloocan.sti.edu</span> and <span class="accent-color">jobplacement@caloocan.sti.edu</span>
                </div>

                <img src="../images/forms/banner2.jpg">

                <div class="hr1" style="margin-top:20px;margin-bottom:20px;"></div>
                <div class="text-center">
                    <a href="job-fair.php" class="btn-system btn-large">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<script type="text/javascript" src="../js/script.js"></script>

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
                        <li><a href="../contact.php">Contact</a>
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
</body>
</html>