<?php
session_start();
require 'db_connect.php';
$user = trim($_POST['username'] ?? '');
$pass = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT id, password FROM admins WHERE username=?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows===1){
  $stmt->bind_result($id,$pwd);
  $stmt->fetch();
  if($pass === $pwd){
    $_SESSION['admin_id']=$id;
    header("Location: admin_dashboard.php"); exit;
  }
}
$_SESSION['admin_error']="Invalid credentials.";
header("Location: admin_login.php"); exit;
