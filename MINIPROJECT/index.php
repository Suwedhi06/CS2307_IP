<?php
session_start();

if (isset($_SESSION["student_id"])) {
    header("Location: student/feedback.php");
    exit();
}

if (isset($_SESSION["admin_id"])) {
    header("Location: admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Management System</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header class="site-header">

    <div class="header-inner">

        <h1>Student Feedback Management System</h1>

        <p>Course and Faculty Feedback Portal</p>

    </div>

</header>


<main class="container">

    <section class="welcome">

        <h2>Student Feedback Management System</h2>

        <p>
            A simple portal for students to share their course
            and faculty feedback.
        </p>


        <div class="home-buttons">

            <a href="student/login.php" class="btn">
                Student Login
            </a>

            <a href="student/register.php" class="btn btn-light">
                New Student
            </a>

            <a href="admin/login.php" class="btn btn-dark">
                Admin Login
            </a>

        </div>

    </section>


    <section class="info-grid">

        <div class="info-card">

            <h3>Student</h3>

            <p>
                Login and share your feedback about
                courses and faculty.
            </p>

        </div>


        <div class="info-card">

            <h3>Feedback</h3>

            <p>
                Give a rating and write your comments
                in a simple form.
            </p>

        </div>


        <div class="info-card">

            <h3>Management</h3>

            <p>
                View submitted feedback and keep track
                of responses.
            </p>

        </div>

    </section>

</main>


<footer class="site-footer">

    <p>
        Student Feedback Management System
    </p>

</footer>

</body>

</html>