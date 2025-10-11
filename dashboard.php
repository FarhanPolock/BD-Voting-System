<?php
session_start();
include("db.php");

if (!isset($_SESSION['voter_id'])) {
    header("Location: voter_login.php");
    exit();
}

$voter_id = $_SESSION['voter_id'];

// Voter info
$voter_sql = "SELECT name FROM voters WHERE id='$voter_id'";
$voter_result = mysqli_query($conn, $voter_sql);
$voter = mysqli_fetch_assoc($voter_result);

// Current election
$sql = "SELECT * FROM elections WHERE start_date <= CURDATE() AND end_date >= CURDATE() LIMIT 1";
$election = mysqli_query($conn, $sql);
$electionData = mysqli_fetch_assoc($election);

// Candidates
$candidates = [];
if ($electionData) {
    $election_id = $electionData['id'];
    $candidateQuery = "SELECT * FROM candidates WHERE election_id='$election_id'";
    $candidates = mysqli_query($conn, $candidateQuery);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voter Dashboard</title>

    <!-- ✅ Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- ✅ Custom Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <style>
        body {
            background: #f8f9fa;
        }
        .dashboard-header {
            background: linear-gradient(90deg, #007bff, #6610f2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .candidate-card {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
            background: white;
            display: flex;
            align-items: center;
        }
        .candidate-card:hover {
            border-color: #007bff;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }
        .candidate-logo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }
        .vote-btn {
            margin-left: auto;
        }
    </style>
</head>
<body class="container mt-4">

    <!-- Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <!-- Left side -->
        <div>
            <h2>🗳️ Voter Dashboard</h2>
            <h5>Welcome, <?php echo htmlspecialchars($voter['name']); ?> 👋</h5>
        </div>
        <!-- Right side (Logo) -->
        <div>
            <img src="images/logo.png" alt="Logo" style="height:70px;">
        </div>
    </div>

    <?php if ($electionData): ?>
        <div class="mb-4">
            <h4>📢 Current election: <strong><?php echo $electionData['title']; ?></strong></h4>
            <p>🗓 Date: <?php echo $electionData['start_date']; ?> ➝ <?php echo $electionData['end_date']; ?></p>
        </div>

        <form method="POST" action="vote.php">
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($candidates)) { ?>
                    <div class="col-md-6">
                        <div class="candidate-card">
                            <!-- Candidate Logo -->
                            <?php if (!empty($row['logo'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['logo']); ?>" class="candidate-logo" alt="Candidate Logo">
                            <?php else: ?>
                                <img src="uploads/default.png" class="candidate-logo" alt="No Logo">
                            <?php endif; ?>

                            <!-- Candidate Info -->
                            <div>
                                <input type="radio" name="candidate_id" value="<?php echo $row['id']; ?>" required>
                                <label>
                                    <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                                    <?php if (!empty($row['party'])) echo " ({$row['party']})"; ?>
                                </label>
                            </div>

                            <!-- Vote Button -->
                            <button type="submit" class="btn btn-success vote-btn">✅ Vote</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">⚠ No election is running right now.</div>
    <?php endif; ?>

</body>
</html>
