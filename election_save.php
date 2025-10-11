<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); exit; }

$title = trim($_POST['title'] ?? '');
$sd    = $_POST['start_date'] ?? '';
$ed    = $_POST['end_date'] ?? '';
$status= $_POST['status'] ?? 'inactive';

$stmt=$conn->prepare("INSERT INTO elections(title,start_date,end_date,status) VALUES(?,?,?,?)");
$stmt->bind_param("ssss",$title,$sd,$ed,$status);
$stmt->execute();
header("Location: view_elections.php");
