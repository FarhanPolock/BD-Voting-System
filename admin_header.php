<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: admin_login.php"); exit; }
require 'db_connect.php';
$page_title = $page_title ?? 'Admin';
$active = $active ?? ''; // 'home' | 'add_el' | 'add_cand' | 'view_el' | 'view_res'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($page_title); ?> • Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --sidebar:#0f172a; --sidebar-hover:#1e293b; }
    body { background:#f6f7fb; }
    .sidebar {
      min-height: 100vh; background:var(--sidebar); color:#e2e8f0; padding:20px 12px; position: sticky; top:0;
    }
    .brand { font-weight:700; letter-spacing:.3px; }
    .nav-link {
      color:#cbd5e1; padding:10px 12px; border-radius:12px; margin-bottom:6px; display:flex; align-items:center; gap:10px;
      text-decoration: none;
    }
    .nav-link:hover { background:var(--sidebar-hover); color:#fff; }
    .nav-link.active { background:#2563eb; color:#fff; }
    .content { padding:24px; }
    .card { border-radius:16px; box-shadow:0 6px 16px rgba(0,0,0,.06); }
    .btn-soft { border-radius:12px; }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <aside class="col-md-3 col-lg-2 sidebar">
      <div class="brand h4 text-white mb-4 text-center">Admin Panel</div>
      <a class="nav-link <?php echo $active==='home'?'active':''; ?>" href="admin_home.php">🏠 Dashboard</a>
      <a class="nav-link <?php echo $active==='add_el'?'active':''; ?>" href="add_election.php">➕ Add Election</a>
      <a class="nav-link <?php echo $active==='add_cand'?'active':''; ?>" href="add_candidate.php">👤 Add Candidate</a>
      <a class="nav-link <?php echo $active==='view_el'?'active':''; ?>" href="view_elections.php">📋 View All Elections</a>
      <a class="nav-link <?php echo $active==='view_res'?'active':''; ?>" href="view_results.php">📊 View Results</a>
      <a class="nav-link text-danger mt-2" href="logout.php">🚪 Logout</a>
    </aside>

    <!-- Page Content -->
    <main class="col-md-9 col-lg-10 content">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0"><?php echo htmlspecialchars($page_title); ?></h3>
      </div>
