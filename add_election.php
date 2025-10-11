<?php
$page_title = "Add Election";
$active = "add_el";
include 'admin_header.php';
?>
<div class="card p-4 col-lg-6">
  <form method="POST" action="election_save.php" autocomplete="off">
    <div class="mb-3">
      <label class="form-label">Election Title</label>
      <input class="form-control" name="title" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Start Date</label>
      <input type="date" class="form-control" name="start_date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">End Date</label>
      <input type="date" class="form-control" name="end_date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="inactive">Inactive</option>
        <option value="active">Active</option>
      </select>
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="view_elections.php" class="btn btn-light">View All</a>
  </form>
</div>
<?php include 'admin_footer.php'; ?>
