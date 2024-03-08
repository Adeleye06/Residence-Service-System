<?php
session_start();

$_SESSION['USER_TYPE'] = 1;
$_SESSION['studentEmail'] = "test@test.com";
$_SESSION['F_NAME'] = "Testing User";
$_SESSION['U_ID'] = "1";

die("session set up successful");