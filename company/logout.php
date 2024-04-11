<?php
session_start();
unset($_SESSION['CompanyID']);
header("location: ../login-company.php");