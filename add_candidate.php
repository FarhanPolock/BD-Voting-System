<?php
$page_title = "Add Candidate";
$active = "add_cand";
include 'admin_header.php';

// সব Election লোড করা
$els = $conn->query("SELECT id, title FROM elections ORDER BY id DESC");
?>
<div class="card p-4 col-lg-8">
  <!-- File upload করতে enctype="multipart/form-data" দিতে হবে -->
  <form method="POST" action="candidate_save.php" class="row g-3" enctype="multipart/form-data">
    <div class="col-md-6">
      <label class="form-label">Candidate Name</label>
      <input class="form-control" name="name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Election</label>
      <select name="election_id" class="form-select" required>
        <option value="">Select Election</option>
        <?php while($e=$els->fetch_assoc()): ?>
        <option value="<?php echo $e['id']; ?>">
          <?php echo htmlspecialchars($e['title']); ?>
        </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-12">
      <label class="form-label">Candidate Logo</label>
      <input type="file" name="logo" class="form-control" accept="image/*">
    </div>
    <div class="col-12">
      <button class="btn btn-success">Add</button>
      <a href="view_elections.php" class="btn btn-light">View Elections</a>
    </div>
  </form>
</div>

<div class="card p-3 mt-4">
  <h6>All Candidates</h6>
  <table class="table table-sm table-bordered align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Logo</th>
        <th>Name</th>
        <th>Election</th>
        <th>Action</th> <!-- ✅ Delete Column -->
      </tr>
    </thead>
    <tbody>
      <?php
        $cand=$conn->query("SELECT c.id,c.name,c.logo,e.title 
                            FROM candidates c 
                            JOIN elections e ON e.id=c.election_id 
                            ORDER BY c.id DESC");
        while($c=$cand->fetch_assoc()):
      ?>
      <tr>
        <td><?php echo $c['id']; ?></td>
        <td>
          <?php if(!empty($c['logo'])): ?>
            <img src="uploads/<?php echo $c['logo']; ?>" 
                 width="40" height="40" class="rounded-circle">
          <?php else: ?>
            <span class="text-muted">No Logo</span>
          <?php endif; ?>
        </td>
        <td><?php echo htmlspecialchars($c['name']); ?></td>
        <td><?php echo htmlspecialchars($c['title']); ?></td>
        <td>
          <a href="delete_candidate.php?id=<?php echo $c['id']; ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('Are you sure you want to delete this candidate?');">
             🗑 Delete
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include 'admin_footer.php'; ?>
