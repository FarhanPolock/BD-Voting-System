<?php
session_start();
include("db.php");

// যদি voter লগইন না থাকে তাহলে voter_login.php এ রিডাইরেক্ট করব
if (!isset($_SESSION['voter_id'])) {
    header("Location: voter_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voter_id = $_SESSION['voter_id'];
    $candidate_id = intval($_POST['candidate_id']); // নিরাপদ input

    // candidate থেকে election_id বের করি
    $sql = "SELECT election_id FROM candidates WHERE id = '$candidate_id' LIMIT 1";
    $candidate_query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($candidate_query) > 0) {
        $candidate = mysqli_fetch_assoc($candidate_query);
        $election_id = $candidate['election_id'];
    } else {
        echo "<script>
            alert('❌ Invalid candidate selected!');
            window.location.href='dashboard.php';
        </script>";
        exit();
    }

    // চেক করি voter এই election এ আগে vote দিয়েছে কি না
    $checkVote = "SELECT * FROM votes WHERE voter_id='$voter_id' AND election_id='$election_id'";
    $result = mysqli_query($conn, $checkVote);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
            alert('⚠ You have already voted in this election!');
            window.location.href='dashboard.php';
        </script>";
    } else {
        // Vote insert করি
        $sql = "INSERT INTO votes (voter_id, candidate_id, election_id) 
                VALUES ('$voter_id', '$candidate_id', '$election_id')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('✅ Vote submitted successfully!');
                window.location.href='dashboard.php';
            </script>";
        } else {
            echo "SQL Error: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
