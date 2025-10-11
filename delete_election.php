<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); exit; }
$id=(int)($_GET['id']??0);
$conn->query("DELETE FROM elections WHERE id={$id}");
header("Location: admin_dashboard.php");
