CREATE DATABASE IF NOT EXISTS student_feedback;

USE student_feedback;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course VARCHAR(100) NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    comments TEXT NOT NULL,
    feedback_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_feedback_student
        FOREIGN KEY (student_id) REFERENCES students(id)
        ON DELETE CASCADE
);

INSERT IGNORE INTO students (name, email, password)
VALUES (
    'Suwedhika',
    'student@gmail.com',
    '$2y$12$aI6lNhc7.9PycPEJWsS3wOXQ/MhPXIotmxd2070T4BD.vcMyL5y9G'
);

INSERT IGNORE INTO admins (username, password)
VALUES (
    'admin',
    '$2y$12$JoOD7hHQ22vF7yGq7cGWP.oJg69u/tTZA4vRSVh16TuJMpGHfT4x6'
);
