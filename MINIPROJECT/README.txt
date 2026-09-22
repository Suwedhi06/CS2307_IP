STUDENT FEEDBACK MANAGEMENT SYSTEM
CS2307 - INTERNET PROGRAMMING LAB

Technology:
HTML
CSS
JavaScript
PHP
MySQL

REQUIREMENTS
1. XAMPP
2. Apache
3. MySQL
4. VS Code (or another editor)

HOW TO RUN

1. Extract this ZIP file.

2. Rename the folder to:
   StudentFeedbackManagementSystem

3. Copy the complete folder into:
   C:\xampp\htdocs\

4. Open XAMPP Control Panel.

5. Start:
   Apache
   MySQL

6. Open this address:
   http://localhost/phpmyadmin

7. Click "Import".

8. Select:
   database/student_feedback.sql

9. Click "Go".

10. Open:
    http://localhost/StudentFeedbackManagementSystem/

STUDENT DEMO LOGIN
Email:
student@gmail.com

Password:
student123

ADMIN DEMO LOGIN
Username:
admin

Password:
admin123

STUDENT FEATURES
- Registration
- Login
- Course feedback form
- JavaScript validation
- PHP processing
- MySQL storage
- View submitted feedback
- Logout

ADMIN FEATURES
- Login
- Dashboard
- Total student count
- Total feedback count
- Average rating
- View all feedback
- Logout

IMPORTANT
The MySQL password in this project assumes the default XAMPP MySQL setup:
Username: root
Password: empty

If your MySQL root account has a password, edit:
includes/db.php

and change:
$password = "";

to your MySQL password.
