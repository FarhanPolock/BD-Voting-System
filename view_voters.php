<?php
session_start();
include 'db.php';

// শুধু admin লগইন করলে দেখতে পারবে
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$res = $conn->query("SELECT * FROM voters ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Voters</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card p-3 shadow">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h5 class="m-0">🗳️ All Voters</h5>
      <a href="admin_dashboard.php" class="btn btn-sm btn-secondary">⬅ Back</a>
    </div>
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>NID</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($r = $res->fetch_assoc()): ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo htmlspecialchars($r['name']); ?></td>
          <td><?php echo htmlspecialchars($r['email']); ?></td>
          <td><?php echo htmlspecialchars($r['nid']); ?></td>
          <td>
            <a class="btn btn-sm btn-outline-danger" 
               href="delete_voter.php?id=<?php echo $r['id']; ?>"
               onclick="return confirm('Are you sure you want to delete this voter?');">
               🗑 Delete
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
