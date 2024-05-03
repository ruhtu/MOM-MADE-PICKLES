<?php
// login-handler.php

// Start a new session
session_start();

// Include database connection file
// require 'db_connect.php'; // This should be a separate PHP file that handles the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input data
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Database - Replace with your database credentials and logic
    $host = 'localhost'; // or your database host
    $db   = 'your_database'; // your database name
    $user = 'your_username'; // your database username
    $pass = 'your_password'; // your database password
    $charset = 'utf8mb4';

    // Set DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        // Create a PDO instance
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    // Replace 'users' with your actual user table name
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify user and password (assuming the password is hashed)
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, so start a new session
        $_SESSION['user_id'] = $user['id']; // Set the session with user id or any other required information
        header("Location: index.html"); // Redirect to the home page
        exit;
    } else {
        // Redirect back to the login page with an error
        header("Location: login.php?error=invalidcredentials");
        exit;
    }
} else {
    // Not a POST request, redirect to login form or display an error
    header("Location: login.php");
    exit;
}
?>
