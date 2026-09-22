<?php
session_start();
include("../includes/db.php");

$message = "";
$message_type = "";

if (isset($_POST["register"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name === "" || $email === "" || $password === "") {
        $message = "Please fill all fields.";
        $message_type = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must contain at least 6 characters.";
        $message_type = "error";
    } else {
        $check = $conn->prepare("SELECT id FROM students WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "This email is already registered.";
            $message_type = "error";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO students (name, email, password) VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $message = "Registration successful. You can now login.";
                $message_type = "success";
            } else {
                $message = "Registration failed.";
                $message_type = "error";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validate.js"></script>
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="form-box">
    <h2>Student Registration</h2>

    <?php if ($message !== "") { ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php } ?>

    <form method="post" onsubmit="return validateRegister();">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" name="register" value="Register">
    </form>

    <p><a href="login.php">Already have an account? Login</a></p>
    <p><a href="../index.php">Back to Home</a></p>
</div>

</body>
</html>
