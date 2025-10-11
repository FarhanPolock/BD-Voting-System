<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); exit; }
$conn->query("TRUNCATE TABLE votes");
header("Location: admin_dashboard.php");
