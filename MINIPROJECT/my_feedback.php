<?php
session_start();

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$student_id = $_SESSION["student_id"];

$stmt = $conn->prepare(
    "SELECT course, faculty, rating, comments, feedback_date
     FROM feedback
     WHERE student_id = ?
     ORDER BY feedback_date DESC"
);
$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Feedback</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="navbar">
    <a href="feedback.php">Give Feedback</a> |
    <a href="my_feedback.php">My Feedback</a> |
    <a href="logout.php">Logout</a>
</div>

<div class="dashboard-box">
    <h2>My Submitted Feedback</h2>

    <div class="table-wrap">
        <table>
            <tr>
                <th>Course</th>
                <th>Faculty</th>
                <th>Rating</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>

            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["course"]); ?></td>
                        <td><?php echo htmlspecialchars($row["faculty"]); ?></td>
                        <td><?php echo $row["rating"]; ?>/5</td>
                        <td><?php echo htmlspecialchars($row["comments"]); ?></td>
                        <td><?php echo $row["feedback_date"]; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">No feedback submitted yet.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
<?php $stmt->close(); ?>
