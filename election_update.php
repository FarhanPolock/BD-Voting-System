<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); exit; }

$id=(int)($_POST['id']??0);
$title=trim($_POST['title']??'');
$sd=$_POST['start_date']??'';
$ed=$_POST['end_date']??'';
$status=$_POST['status']??'inactive';

$stmt=$conn->prepare("UPDATE elections SET title=?, start_date=?, end_date=?, status=? WHERE id=?");
$stmt->bind_param("ssssi",$title,$sd,$ed,$status,$id);
$stmt->execute();
header("Location: admin_dashboard.php");
