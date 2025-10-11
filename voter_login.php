<?php
require 'db_connect.php';
session_start();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    try {
        $stmt = $conn->prepare("SELECT id, name, password FROM voters WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $name, $hash);
            $stmt->fetch();
            if (password_verify($pass, $hash)) {
                $_SESSION['voter_id'] = $id;
                $_SESSION['voter_name'] = $name;
                header("Location: dashboard.php");
                exit;
            } else {
                $msg = "❌ Invalid password.";
            }
        } else {
            $msg = "❌ No voter found with this email.";
        }
        $stmt->close();
    } catch (Exception $e) {
        $msg = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voter Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- ✅ Add favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4 col-md-6 offset-md-3">

    <!-- Logo Center -->
    <div class="text-center">
      <img src="images/logo.png" alt="Logo" width="120" class="mb-3">
    </div>

    <h3 class="text-center mb-3">🗳️ Voter Login</h3>

    <?php if($msg){ echo "<div class='alert alert-danger text-center'>$msg</div>"; } ?>

    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>

    <p class="mt-3 text-center">New voter? <a href="voter_register.php">Register</a></p>
  </div>
</div>
</body>
</html>
