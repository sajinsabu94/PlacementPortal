<?php
session_start();
unset($_SESSION['AdminID']);
header("location: ../login-admin.php");