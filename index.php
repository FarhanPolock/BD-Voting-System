<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>BD Online Voting System</title>

  <!-- ✅ Logo (Favicon) added -->
  <link rel="icon" type="image/png" href="images/favicon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:linear-gradient(90deg,#0062E6,#33AEFF);min-height:100vh}
    .card{border-radius:16px;box-shadow:0 6px 16px rgba(0,0,0,.2);transition:.3s}
    .card:hover{transform:translateY(-6px)}
    .btn-round{border-radius:24px;font-weight:600}
    footer{color:#fff;margin-top:48px;text-align:center}
    .logo-title{display:flex;align-items:center;justify-content:center;gap:12px}
    .logo-title img{height:60px}
  </style>
</head>
<body>
  <div class="container text-center mt-5">
    
    <!-- ✅ Logo + Title -->
    <div class="logo-title mb-2">
      <img src="images/logo.png" alt="Logo">
      <h1 class="text-white fw-bold mb-0">BD Online Voting System</h1>
    </div>
    <p class="text-light mb-5">Secure • Reliable • Transparent</p>

    <div class="row justify-content-center g-4">
      <div class="col-md-3">
        <div class="card p-4">
          <h4>🗳️ Voter Login</h4>
          <p class="mb-3">Log in to cast your vote.</p>
          <a href="voter_login.php" class="btn btn-primary w-100 btn-round">Voter Login</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-4">
          <h4>📝 Voter Registration</h4>
          <p class="mb-3">Create a new voter account.</p>
          <a href="voter_register.php" class="btn btn-success w-100 btn-round">Register</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-4">
          <h4>🔑 Admin Login</h4>
          <p class="mb-3">Manage elections & results.</p>
          <a href="admin_login.php" class="btn btn-warning w-100 btn-round">Admin Panel</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Footer updated -->
  <footer>© <?php echo date('Y'); ?> BD Online Voting System • Developed by Farhan Polock</footer>
</body>
</html>
