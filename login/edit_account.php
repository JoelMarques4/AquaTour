<?php
require 'config.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    echo json_encode([
        "success" => false,
        "message" => "Você precisa estar logado para editar a conta."
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $newpass = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? ''; // caso vá usar depois

    // validação
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "success" => false,
            "message" => "Dados inválidos."
        ]);
        exit;
    }

    // checar se email já existe em outro usuário
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email AND id != :id');
    $stmt->execute(['email' => $email, 'id' => $user_id]);
    if ($stmt->fetch()) {
        echo json_encode([
            "success" => false,
            "message" => "Email já em uso por outro usuário."
        ]);
        exit;
    }

    // atualizar dados
    try {
        if ($newpass) {
            $hash = password_hash($newpass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hash,
                'id' => $user_id
            ]);
        } else {
            $stmt = $pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'id' => $user_id
            ]);
        }

        // atualizar sessão
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        echo json_encode([
            "success" => true,
            "message" => "Conta atualizada com sucesso!"
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "success" => false,
            "message" => "Erro ao atualizar: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Método inválido."
    ]);
}
