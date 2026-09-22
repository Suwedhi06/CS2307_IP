<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .result-container {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        h2 {
            color: #1a1a1a;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 24px;
        }
        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            text-align: center;
        }
        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        
        /* Styled summary data table */
        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
            text-align: left;
        }
        .summary-title {
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px dashed #edf2f7;
        }
        .summary-row:last-child {
            border-bottom: none;
        }
        .summary-label {
            font-weight: 600;
            color: #718096;
        }
        .summary-value {
            color: #2d3748;
            font-weight: 500;
        }

        .error-list {
            list-style-type: none;
            padding-left: 0;
        }
        .error-list li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }
        .error-list li::before {
            content: "•";
            color: #dc2626;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
        }
        .btn-link-container {
            text-align: center;
        }
        .btn-link {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3182ce;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }
        .btn-link:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Validation Results</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();

        // Safely fetch all inputs submitted from register.html
        $username  = isset($_POST['username']) ? $_POST['username'] : '';
        $password  = isset($_POST['password']) ? $_POST['password'] : '';
        $name      = isset($_POST['name']) ? $_POST['name'] : '';
        $education = isset($_POST['education']) ? $_POST['education'] : '';
        $experience= isset($_POST['experience']) ? $_POST['experience'] : '';
        $skills    = isset($_POST['skills']) ? $_POST['skills'] : '';
        $ccnumber  = isset($_POST['ccnumber']) ? $_POST['ccnumber'] : '';
        $email     = isset($_POST['email']) ? $_POST['email'] : '';
        $phone     = isset($_POST['phone']) ? $_POST['phone'] : '';

        // 1. Password Rules Regex
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            $errors[] = "Password must be at least 8 characters long and contain uppercase, lowercase, and a number.";
        }

        // 2. Credit Card Rules Regex
        if (!preg_match("/^\d{16}$/", $ccnumber)) {
            $errors[] = "Credit Card Number must be exactly 16 digits.";
        }

        // 3. Email Rules Regex
        if (!preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $email)) {
            $errors[] = "The email address format is invalid.";
        }

        // 4. Phone Number Rules Regex
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $errors[] = "Phone Number must be a valid 10-digit mobile number.";
        }

        // Check if errors array is empty
        if (empty($errors)) {
            // Display clean Success Banner
            echo '<div class="alert alert-success">';
            echo '<strong>Registered Successfully!</strong> Profile registered successfully.';
            echo '</div>';

            // Print the human-readable summary of the exact values submitted
            echo '<div class="summary-box">';
            echo '<div class="summary-title">Submitted Candidate Profile</div>';
            
            echo '<div class="summary-row"><span class="summary-label">Username:</span><span class="summary-value">' . htmlspecialchars($username) . '</span></div>';
            echo '<div class="summary-row"><span class="summary-label">Full Name:</span><span class="summary-value">' . htmlspecialchars($name) . '</span></div>';
            echo '<div class="summary-row"><span class="summary-label">Highest Education:</span><span class="summary-value">' . htmlspecialchars($education) . '</span></div>';
            echo '<div class="summary-row"><span class="summary-label">Experience:</span><span class="summary-value">' . htmlspecialchars($experience) . '</span></div>';
            echo '<div class="summary-row"><span class="summary-label">Key Skills:</span><span class="summary-value">' . htmlspecialchars($skills) . '</span></div>';
            
            // Masking credit card digits except the last 4 digits for standard web privacy layout
            $masked_cc = '************' . substr($ccnumber, -4);
            echo '<div class="summary-row"><span class="summary-label">Credit Card:</span><span class="summary-value">' . htmlspecialchars($masked_cc) . '</span></div>';
            
            echo '<div class="summary-row"><span class="summary-label">Email Address:</span><span class="summary-value">' . htmlspecialchars($email) . '</span></div>';
            echo '<div class="summary-row"><span class="summary-label">Phone Number:</span><span class="summary-value">' . htmlspecialchars($phone) . '</span></div>';
            echo '</div>';

            echo '<div class="btn-link-container"><a href="register.html" class="btn-link" style="background-color: #166534;">Create Another Profile</a></div>';
        } else {
            // Display Errors lists block if validation rules fail
            echo '<div class="alert alert-danger">';
            echo '<ul class="error-list">';
            foreach ($errors as $error) {
                echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            echo '</ul>';
            echo '</div>';
            echo '<div class="btn-link-container"><a href="register.html" class="btn-link">Go Back & Fix Errors</a></div>';
        }
    } else {
        echo '<div class="alert alert-danger" style="text-align:center;">Invalid request method. Please fill the form first.</div>';
        echo '<div class="btn-link-container"><a href="register.html" class="btn-link">Go to Form</a></div>';
    }
    ?>
</div>

</body>
</html>
