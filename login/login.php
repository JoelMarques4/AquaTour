<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT id, name, password, admin FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $email;
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['logged'] = true;
    header('Location: ../painel.php');
    exit;
} else {
    $_SESSION['error'] = 'Login/senha inválidos.';
    header('Location: ../loginpage.php');
    exit;
}
