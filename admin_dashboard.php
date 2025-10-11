<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- ✅ Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-light">

<div class="container mt-5 text-center">

    <!-- ✅ Logo Section -->
    <div style="text-align:center; margin-bottom:15px;">
        <img src="images/logo.png" alt="Logo" style="height:120px;">
    </div>

    <h2>Welcome, Admin</h2>

    <div class="mt-4">
        <a href="add_election.php" class="btn btn-primary m-2">🗳 Add Election</a>
        <a href="add_candidate.php" class="btn btn-success m-2">👤 Add Candidate</a>
        <a href="view_results.php" class="btn btn-info m-2">📊 View Results</a>
        <a href="view_voters.php" class="btn btn-warning m-2">👥 View Voters</a>
        <a href="logout.php" class="btn btn-secondary m-2">🚪 Logout</a>
    </div>

    <hr class="my-4">

    <form action="reset_votes.php" method="post">
        <button type="submit" name="reset" class="btn btn-danger">
            🔄 Reset All Votes
        </button>
    </form>
</div>

</body>
</html>
