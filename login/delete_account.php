<?php
require 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../loginpage.php'); exit; }
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute(['id' => $user_id]);
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['success_delete'] = 'Sentimos vê-lo partir. Sua conta foi excluída com sucesso.';
    header('Location: ../index.php');
    exit;
}