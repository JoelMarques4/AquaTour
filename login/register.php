<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    
    $_SESSION['error'] = 'O nome é obrigatório, o e-mail deve ser válido e a senha deve ter pelo menos 6 caracteres.';
    header('Location: ../cadastro.php');
    exit;
}

$stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
if ($stmt->fetch()) {
    $_SESSION['error'] = 'E-mail já cadastrado.';
    header('Location: ../cadastro.php');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
$stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);

$_SESSION['success'] = 'Cadastro realizado. Faça login.';
header('Location: ../loginpage.php');
exit;
