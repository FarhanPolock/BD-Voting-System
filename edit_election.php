<?php
session_start();
require 'db_connect.php';
if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); exit; }
$id=(int)($_GET['id']??0);
$el=$conn->query("SELECT * FROM elections WHERE id={$id}")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Election</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Edit Election</h3>
  <form method="POST" action="election_update.php">
    <input type="hidden" name="id" value="<?php echo $el['id']; ?>">
    <div class="mb-2"><input class="form-control" name="title" value="<?php echo htmlspecialchars($el['title']); ?>" required></div>
    <div class="mb-2"><input type="date" class="form-control" name="start_date" value="<?php echo $el['start_date']; ?>" required></div>
    <div class="mb-2"><input type="date" class="form-control" name="end_date" value="<?php echo $el['end_date']; ?>" required></div>
    <div class="mb-2">
      <select name="status" class="form-select">
        <option value="inactive" <?php if($el['status']=='inactive') echo 'selected'; ?>>Inactive</option>
        <option value="active" <?php if($el['status']=='active') echo 'selected'; ?>>Active</option>
      </select>
    </div>
    <button class="btn btn-primary">Update</button>
    <a class="btn btn-secondary" href="admin_dashboard.php">Back</a>
  </form>
</div>
</body>
</html>
