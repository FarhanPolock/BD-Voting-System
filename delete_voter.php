<?php
session_start();
include 'db.php';

// শুধু admin allowed
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM voters WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        header("Location: view_voters.php?msg=Voter Deleted Successfully");
    } else {
        header("Location: view_voters.php?msg=Error deleting voter");
    }
} else {
    header("Location: view_voters.php");
}
