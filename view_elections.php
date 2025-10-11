<?php
$page_title = "View All Elections";
$active = "view_el";
include 'admin_header.php';
$res=$conn->query("SELECT * FROM elections ORDER BY id DESC");
?>
<div class="card p-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="m-0">All Elections</h5>
    <a class="btn btn-primary btn-sm" href="add_election.php">➕ Add Election</a>
  </div>
  <table class="table table-hover table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Dates</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($r=$res->fetch_assoc()): ?>
      <tr>
        <td><?php echo $r['id']; ?></td>
        <td><?php echo htmlspecialchars($r['title']); ?></td>
        <td><?php echo $r['start_date'].' — '.$r['end_date']; ?></td>
        <td>
          <span class="badge bg-<?php echo $r['status']=='active'?'success':'secondary'; ?>">
            <?php echo ucfirst($r['status']); ?>
          </span>
        </td>
        <td>
          <a class="btn btn-sm btn-outline-secondary" 
             href="edit_election.php?id=<?php echo $r['id']; ?>">Edit</a>

          <a class="btn btn-sm btn-outline-danger" 
             href="delete_election.php?id=<?php echo $r['id']; ?>" 
             onclick="return confirm('Delete this election?');">Delete</a>

          <!-- ✅ New Candidates Button -->
          <a class="btn btn-sm btn-outline-info" 
             href="view_candidates.php?election_id=<?php echo $r['id']; ?>">Candidates</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include 'admin_footer.php'; ?>
