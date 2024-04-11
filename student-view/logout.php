<?php
session_start();
unset($_SESSION['StudentID']);
header("location: ../login-student.php");