<?php
$page_title = "View Results";
$active = "view_res";
include 'admin_header.php';
$q = "SELECT e.title AS election, c.name AS candidate, COUNT(v.id) AS votes
      FROM candidates c
      JOIN elections e ON e.id=c.election_id
      LEFT JOIN votes v ON v.candidate_id=c.id
      GROUP BY c.id
      ORDER BY e.id DESC, votes DESC";
$res=$conn->query($q);
?>
<div class="card p-3">
  <div class="d-flex justify-content-between align-items-center">
    <h5 class="m-0">Results</h5>
    <a class="btn btn-outline-warning btn-sm" href="reset_votes.php"
       onclick="return confirm('Reset ALL votes?')">Reset All Votes</a>
  </div>
  <table class="table table-sm mt-2">
    <thead><tr><th>Election</th><th>Candidate</th><th>Votes</th></tr></thead>
    <tbody>
    <?php while($row=$res->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['election']); ?></td>
        <td><?php echo htmlspecialchars($row['candidate']); ?></td>
        <td><?php echo (int)$row['votes']; ?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include 'admin_footer.php'; ?>
