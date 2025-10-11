<?php
session_start();
include 'db.php';

// যদি admin লগইন না থাকে
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$election_id = $_GET['election_id'];

// Election info আনা
$election = $conn->query("SELECT * FROM elections WHERE id='$election_id'")->fetch_assoc();

// Candidates আনা
$candidates = $conn->query("SELECT * FROM candidates WHERE election_id='$election_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Candidates</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
  <h4>Candidates for: <span class="text-primary"><?php echo htmlspecialchars($election['title']); ?></span></h4>
  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Party</th>
        <th>Photo</th>
      </tr>
    </thead>
    <tbody>
      <?php if($candidates->num_rows > 0): $i=1; ?>
        <?php while($c = $candidates->fetch_assoc()): ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo htmlspecialchars($c['name']); ?></td>
          <td><?php echo htmlspecialchars($c['party']); ?></td>
          <td>
            <?php if(!empty($c['photo'])): ?>
              <img src="uploads/<?php echo $c['photo']; ?>" width="60">
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="4" class="text-center text-danger">No Candidates Found!</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
  <a href="view_elections.php" class="btn btn-secondary">⬅ Back</a>
</div>
</body>
</html>
