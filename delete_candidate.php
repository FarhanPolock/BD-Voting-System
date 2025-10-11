<?php
include 'db_connect.php'; // ডাটাবেস কানেকশন ফাইল (এখানে $conn থাকে)

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // নিরাপত্তার জন্য int এ কনভার্ট

    // প্রথমে ক্যান্ডিডেটের লোগো বের করুন
    $result = $conn->query("SELECT logo FROM candidates WHERE id=$id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $logo = $row['logo'];

        // যদি লোগো ফাইল থাকে, সার্ভার থেকে ডিলিট করুন
        if (!empty($logo) && file_exists("uploads/" . $logo)) {
            unlink("uploads/" . $logo);
        }
    }

    // এখন ক্যান্ডিডেটকে ডাটাবেস থেকে ডিলিট করুন
    $sql = "DELETE FROM candidates WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // সফল হলে add_candidate.php এ ফিরে যান
        header("Location: add_candidate.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting candidate: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
