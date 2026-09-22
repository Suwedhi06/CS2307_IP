<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$total_feedback = 0;
$total_students = 0;
$average_rating = 0;

$count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM feedback");
if ($count_result) {
    $row = mysqli_fetch_assoc($count_result);
    $total_feedback = $row["total"];
}

$student_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
if ($student_result) {
    $row = mysqli_fetch_assoc($student_result);
    $total_students = $row["total"];
}

$rating_result = mysqli_query($conn, "SELECT AVG(rating) AS average FROM feedback");
if ($rating_result) {
    $row = mysqli_fetch_assoc($rating_result);
    $average_rating = $row["average"] ? number_format($row["average"], 1) : "0.0";
}

$sql = "SELECT feedback.id,
               feedback.course,
               feedback.faculty,
               feedback.rating,
               feedback.comments,
               feedback.feedback_date,
               students.name,
               students.email
        FROM feedback
        INNER JOIN students
        ON feedback.student_id = students.id
        ORDER BY feedback.feedback_date DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="navbar">
    Admin: <?php echo htmlspecialchars($_SESSION["admin_username"]); ?> |
    <a href="dashboard.php">Dashboard</a> |
    <a href="logout.php">Logout</a>
</div>

<div class="container">

    <div class="info-grid">
        <div class="info-card">
            <h3>Total Students</h3>
            <p><?php echo $total_students; ?></p>
        </div>

        <div class="info-card">
            <h3>Total Feedback</h3>
            <p><?php echo $total_feedback; ?></p>
        </div>

        <div class="info-card">
            <h3>Average Rating</h3>
            <p><?php echo $average_rating; ?>/5</p>
        </div>
    </div>

    <div class="dashboard-box">
        <h2>Student Feedback Details</h2>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Faculty</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th>Date</th>
                </tr>

                <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["email"]); ?></td>
                            <td><?php echo htmlspecialchars($row["course"]); ?></td>
                            <td><?php echo htmlspecialchars($row["faculty"]); ?></td>
                            <td><?php echo $row["rating"]; ?>/5</td>
                            <td><?php echo htmlspecialchars($row["comments"]); ?></td>
                            <td><?php echo $row["feedback_date"]; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7">No feedback available.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</div>

</body>
</html>
