<?php
$page_title = "Dashboard";
$active = "home";
include 'admin_header.php';

// Quick stats
$totalVoters    = $conn->query("SELECT COUNT(*) c FROM voters")->fetch_assoc()['c'] ?? 0;
$totalElections = $conn->query("SELECT COUNT(*) c FROM elections")->fetch_assoc()['c'] ?? 0;
$totalVotes     = $conn->query("SELECT COUNT(*) c FROM votes")->fetch_assoc()['c'] ?? 0;
?>
<div class="row g-3">
  <div class="col-md-4">
    <div class="card p-4">
      <h6 class="text-muted">Total Voters</h6>
      <div class="h3"><?php echo $totalVoters; ?></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-4">
      <h6 class="text-muted">Total Elections</h6>
      <div class="h3"><?php echo $totalElections; ?></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-4">
      <h6 class="text-muted">Total Votes</h6>
      <div class="h3"><?php echo $totalVotes; ?></div>
    </div>
  </div>
</div>

<div class="card p-4 mt-4">
  <h5 class="mb-3">Quick Actions</h5>
  <a href="add_election.php" class="btn btn-primary btn-soft me-2">➕ Add Election</a>
  <a href="add_candidate.php" class="btn btn-success btn-soft me-2">👤 Add Candidate</a>
  <a href="view_elections.php" class="btn btn-outline-secondary btn-soft me-2">📋 View All</a>
  <a href="view_results.php" class="btn btn-outline-dark btn-soft">📊 Results</a>
</div>
<?php include 'admin_footer.php'; ?>
