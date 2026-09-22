<?php
session_start();
include("../includes/db.php");

$message = "";

if (isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin["password"])) {
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_username"] = $admin["username"];

            header("Location: dashboard.php");
            exit();
        }
    }

    $message = "Invalid username or password.";
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="form-box">
    <h2>Admin Login</h2>

    <?php if ($message !== "") { ?>
        <div class="message error">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php } ?>

    <form method="post">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" name="login" value="Login">
    </form>

    <p class="small-note">
        Demo account: admin / admin123
    </p>

    <p>
        <a href="../index.php">Back to Home</a>
    </p>
</div>

</body>
</html>
