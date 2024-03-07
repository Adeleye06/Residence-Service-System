<?php
session_start();

$_SESSION['studentEmail'] = "test@test.com";
$_SESSION['U_ID'] = "1";

die("session set up successful");
?>