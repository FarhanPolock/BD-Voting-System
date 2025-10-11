<?php
require 'db_connect.php';
session_start();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $nid   = trim($_POST['nid'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if ($name === "" || $nid === "" || $email === "" || $pass === "") {
        $msg = "❌ All fields are required.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT id FROM voters WHERE nid=? OR email=?");
            $stmt->bind_param("ss", $nid, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $msg = "❌ NID or Email already registered.";
            } else {
                $hashed = password_hash($pass, PASSWORD_BCRYPT);
                $ins = $conn->prepare("INSERT INTO voters(name, nid, email, password) VALUES(?,?,?,?)");
                $ins->bind_param("ssss", $name, $nid, $email, $hashed);
                $ins->execute();
                $msg = "✅ Registration successful! Please login.";
            }
            $stmt->close();
        } catch (Exception $e) {
            $msg = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voter Registration</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ✅ Custom Favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4 col-md-6 offset-md-3">

    <!-- ✅ Logo Center -->
    <div class="text-center">
      <img src="images/logo.png" alt="Logo" width="120" class="mb-3">
    </div>

    <h3 class="text-center mb-3">📝 Voter Registration</h3>

    <?php if($msg){ echo "<div class='alert alert-info text-center'>$msg</div>"; } ?>

    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">NID Number</label>
        <input name="nid" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success w-100">Register</button>
    </form>

    <p class="mt-3 text-center">Already registered? <a href="voter_login.php">Login</a></p>
  </div>
</div>
</body>
</html>
