<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
ini_set('magic_quotes_gpc', 0);
$osofflineim = "OpenSim Offline IM";
$version = "0.1";
$debug = TRUE;

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "<DB PASS>";
$dbname = "<DB NAME>";
$tbname = "osofflineim_message";

$useTheme = TRUE;
/* Navbar Style */
// navbar
// navbar-btn
// navbar-form
// navbar-left
// navbar-right
// navbar-default
// navbar-inverse
// navbar-collapse
// navbar-fixed-top
// navbar-fixed-bottom
$CLASS_NAVBAR = "navbar navbar-default";
$CLASS_ORDERBY_NAVBAR = "navbar navbar-default";

/* Nav Style */
// nav
// nav-tabs
// nav-pills
// navbar-nav
// nav-stacked
// nav-justified
$CLASS_NAV = "nav navbar-nav";
$CLASS_ORDERBY_NAV = "nav navbar-nav";  
?>
