<?php
// delete_roteiro.php - Exclui um roteiro do banco de dados
session_start();
require_once 'login/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header('Location: loginpage.php');
    exit();
}

// Obtém o ID do roteiro a ser excluído
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: gerenciar-roteiros.php?message=Roteiro não encontrado.&type=danger');
    exit();
}

try {
    // Prepara e executa a exclusão do roteiro
    $stmt = $pdo->prepare('DELETE FROM roteiros WHERE id = :id');
    $stmt->execute([':id' => $id]);
    header('Location: gerenciar-roteiros.php?message=Roteiro excluído com sucesso!&type=success');
    exit();
} catch (PDOException $e) {
    header('Location: gerenciar-roteiros.php?message=Erro ao excluir roteiro.&type=danger');
    exit();
}
