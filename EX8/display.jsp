<%@page contentType="text/html" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: green;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        td:first-child {
            font-weight: bold;
            width: 45%;
        }
    </style>

</head>

<body>

<div class="container">

    <h2>Registration Successful!</h2>

    <table>

        <tr>
            <td>User Name</td>
            <td><%= request.getParameter("username") %></td>
        </tr>

        <tr>
            <td>Name</td>
            <td><%= request.getParameter("name") %></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><%= request.getParameter("email") %></td>
        </tr>

        <tr>
            <td>Password</td>
            <td><%= request.getParameter("password") %></td>
        </tr>

        <tr>
            <td>Credit Card Number</td>
            <td><%= request.getParameter("cardnumber") %></td>
        </tr>

        <tr>
            <td>Mobile Number</td>
            <td><%= request.getParameter("mobile") %></td>
        </tr>

        <tr>
            <td>Job Profile Title</td>
            <td><%= request.getParameter("jobtitle") %></td>
        </tr>

        <tr>
            <td>Total Experience</td>
            <td><%= request.getParameter("experience") %> Years</td>
        </tr>

    </table>

</div>

</body>
</html>