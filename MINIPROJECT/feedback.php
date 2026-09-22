<?php
session_start();

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$message = "";
$message_type = "";

if (isset($_POST["submit_feedback"])) {
    $student_id = $_SESSION["student_id"];
    $course = trim($_POST["course"]);
    $faculty = trim($_POST["faculty"]);
    $rating = (int) $_POST["rating"];
    $comments = trim($_POST["comments"]);

    if ($course === "" || $faculty === "" || $rating < 1 || $rating > 5 || $comments === "") {
        $message = "Please fill all feedback fields correctly.";
        $message_type = "error";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO feedback (student_id, course, faculty, rating, comments)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "issis",
            $student_id,
            $course,
            $faculty,
            $rating,
            $comments
        );

        if ($stmt->execute()) {
            $message = "Feedback submitted successfully.";
            $message_type = "success";
        } else {
            $message = "Unable to submit feedback.";
            $message_type = "error";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validate.js"></script>
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="navbar">
    Welcome, <?php echo htmlspecialchars($_SESSION["student_name"]); ?> |
    <a href="feedback.php">Give Feedback</a> |
    <a href="my_feedback.php">My Feedback</a> |
    <a href="logout.php">Logout</a>
</div>

<div class="form-box">
    <h2>Course Feedback Form</h2>

    <?php if ($message !== "") { ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php } ?>

    <form method="post" onsubmit="return validateFeedback();">

        <label for="course">Course</label>
        <select name="course" id="course">
            <option value="">Select Course</option>
            <option value="Internet Programming">Internet Programming</option>
            <option value="Database Management Systems">Database Management Systems</option>
            <option value="Artificial Intelligence">Artificial Intelligence</option>
            <option value="Computer Networks">Computer Networks</option>
            <option value="Software Engineering">Software Engineering</option>
        </select>

        <label for="faculty">Faculty Name</label>
        <input type="text" name="faculty" id="faculty">

        <label for="rating">Rating</label>
        <select name="rating" id="rating">
            <option value="">Select Rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Average</option>
            <option value="1">1 - Poor</option>
        </select>

        <label for="comments">Comments</label>
        <textarea name="comments" id="comments" placeholder="Write your feedback"></textarea>

        <input type="submit" name="submit_feedback" value="Submit Feedback">
    </form>
</div>

</body>
</html>
