<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ✅ Favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4 col-md-5 offset-md-3">

    <!-- ✅ Logo -->
    <div class="text-center mb-3">
      <img src="images/admin_logo.png" alt="Admin Logo" width="120">
    </div>

    <h3 class="text-center mb-3">🔑 Admin Login</h3>

    <?php 
      if(!empty($_SESSION['admin_error'])){ 
        echo "<div class='alert alert-danger text-center'>".$_SESSION['admin_error']."</div>"; 
        unset($_SESSION['admin_error']); 
      } 
    ?>

    <form method="POST" action="admin_login_action.php" autocomplete="off">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>
</body>
</html>
