<?php
session_start();
unset($_SESSION['AdviserID']);
header("location: ../login-adviser.php");