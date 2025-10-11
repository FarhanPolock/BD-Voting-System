<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php"); 
    exit;
}

$name = trim($_POST['name'] ?? '');
$election_id = (int)($_POST['election_id'] ?? 0);
$logo = "";

// ==== File Upload Handle ====
if (!empty($_FILES['logo']['name'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    // unique name দিতে time() ব্যবহার
    $logo = time() . "_" . basename($_FILES['logo']['name']);
    $target_file = $target_dir . $logo;

    if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
        // uploaded successfully
    } else {
        $logo = ""; // upload fail হলে ফাঁকা থাকবে
    }
}

// ==== Insert into database ====
$stmt = $conn->prepare("INSERT INTO candidates(name, election_id, logo) VALUES(?,?,?)");
$stmt->bind_param("sis", $name, $election_id, $logo);
$stmt->execute();

// redirect
header("Location: add_candidate.php");
exit;
?>
