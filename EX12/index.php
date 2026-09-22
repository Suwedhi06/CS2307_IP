<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grade Report</title>
    <style>
        /* General body background and typography */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 40px;
            color: #333;
        }
        
        /* Heading styling */
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            width: 50%;
            margin-bottom: 20px;
        }

        /* Modern table styling layout */
        table {
            width: 60%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Table header styles */
        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* Table cell data styles */
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eeeeee;
            font-size: 15px;
        }

        /* Zebra striping for even rows */
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Interactivity hover effect on rows */
        tr:hover {
            background-color: #f1f2f6;
        }

        /* Visual pill-badge styles for student pass/fail status */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        
        /* Green status badge for pass */
        .badge-pass {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Red status badge for fail */
        .badge-fail {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <h2>Student Grade Report</h2>

    <?php
    // Load and parse the local XML data file safely
    $xml = simplexml_load_file("students.xml") or die("Error: Cannot load student configuration data.");
    
    // Begin printing structured HTML output table
    echo "<table>";
    echo "<thead>";
    echo "<tr><th>ID</th><th>Student Name</th><th>Grade</th><th>Status</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    
    // Parse through the dataset loop structure
    foreach ($xml->student as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student->id) . "</td>";
        echo "<td>" . htmlspecialchars($student->name) . "</td>";
        echo "<td>" . htmlspecialchars($student->grade) . "</td>";
        
        // Dynamically assign conditional color layout flags according to grades
        if (trim($student->status) === "Pass") {
            echo "<td><span class='badge badge-pass'>" . htmlspecialchars($student->status) . "</span></td>";
        } else {
            echo "<td><span class='badge badge-fail'>" . htmlspecialchars($student->status) . "</span></td>";
        }
        
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    ?>

</body>
</html>
