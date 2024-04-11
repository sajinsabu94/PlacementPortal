<!DOCTYPE html>
<html>
<head>

    <title>PlacementCell | Company Sign In </title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/open-sans.css">

    <!-- BootstrapValidator -->
    <script type="text/javascript" src="js/bootstrapValidator.min.js"></script>

    <!-- CSS-->
    <link href="css/login-style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo/favicon.ico">
</head>

<body class="login-company">
    <div class="box-top effect3" style="margin-top:5%;">
        <a href="index.php"><img src="images/logo/PlacementCell-logo.png" title="PlacementCell - Home" style="width:70%;height:70%;"></a>
        <br>
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if ($id == 1) {
                    echo '
                            <div class="alert alert-success" id="success-alert" width = "70%">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><span class="fa fa-info-circle"></span> You have successfully created an account wait for the admin to accept your account before you may log in.</strong>
                            </div>
                            ';
                } 
            }
        ?>
    </div>
    
    <div class="box-bottom effect3" style="margin-top:1%;">
        <h2 class="register-title">Sign In</h2>
        <form id="myForm" action="login.php" method="POST" autocomplete="off">
            <div id="message" style="color:#d95c5c;font-weight:600;"></div>
            <fieldset class="register-fieldset">
                <input type="text" class="form-control register-input" value="" placeholder="Email" id="CompanyEmail" name="CompanyEmail"/>
            </fieldset>
            <fieldset class="register-fieldset">
                <input type="password" class="form-control register-input" value="" placeholder="Password" id="password" name="password"/>
            </fieldset>
        </form>
        <div class="text-center">
            <p class="register-terms"><a href="" target="_blank">Forgot your password?</a></p>
        </div>

        <button type="submit" class="button btn--green register-submit text-center" id="button"><center>Sign In</center></button>
        
        <p class="register-terms">Don't have an account? Get started <a href="registration-company.php">here</a>.</p>
    </div>
</body>
</html>

<script type="text/javascript">
    $("button#button").click(function () {

        $.post($("#myForm").attr("action"),
            $("#myForm :input").serializeArray(),
            function (data) {
                $("div#message").html(data);
            });

        $("#myForm").submit(function () {
            return false;
        });
    });
</script>