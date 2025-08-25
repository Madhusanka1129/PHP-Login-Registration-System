<?php
session_start();
require_once 'config.php';

if (isset($_POST['register_btn'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_email = $conn->query("SELECT email FROM users WHERE email='$email'");
    if ($check_email->num_rows > 0) {
        $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Email already registered.'];
        $_SESSION['active_from'] = 'register';
    } else {
        $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
        $_SESSION['alerts'][] = ['type' => 'success', 'message' => 'Registration successful. Please log in.'];
        $_SESSION['active_from'] = 'login';
    }
    header("Location: index.php");
    exit();
}

if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['alerts'][] = ['type' => 'success', 'message' => 'Login successful. Welcome back!'];
        } else {
            $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Incorrect password.'];
            $_SESSION['active_from'] = 'login';
        }
    } else {
        $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Email not found.'];
        $_SESSION['active_from'] = 'login';
    }
    header("Location: index.php");
    exit();
}
