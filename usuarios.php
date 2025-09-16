<?php
session_start();
require_once 'login/config.php';

if (!isset($_SESSION['logged']) || !$_SESSION['logged'] || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header('Location: loginpage.php');
    exit();
}

// Excluir usuário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    if ($deleteId > 0) {
        // Evitar que o admin exclua a si mesmo sem querer
        if ($deleteId === (int)$_SESSION['user_id']) {
            $_SESSION['error'] = 'Você não pode excluir a si mesmo.';
            header('Location: usuarios.php');
            exit();
        }
        try {
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute([':id' => $deleteId]);
            $_SESSION['success'] = 'Usuário excluído com sucesso.';
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Erro ao excluir usuário.';
        }
        header('Location: usuarios.php');
        exit();
    }
}

// Buscar todos os usuários
try {
    $stmt = $pdo->query('SELECT id, name, email, admin FROM users ORDER BY id DESC');
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $usuarios = [];
}
?>
<!doctype html>
<html lang="pt-BR" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Usuários - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="painel.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100 admin-bg">

    <nav class="navbar navbar-expand-lg navbarUI px-5 py-2">
        <div class="container-fluid">
            <a class="navbar-brand navbar-linkUI" href="index.php">
                <img src="logo-white.svg" width="100" height="100" class="d-inline-block">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="index.php">Ver Site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="#">Painel</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-linkUI" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Bem-vindo, <?php echo htmlspecialchars($_SESSION['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="perfil.php">Meu Perfil</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="login/logout.php">Sair</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="m-0">Usuários</h1>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr><td colspan="5" class="text-center">Nenhum usuário encontrado.</td></tr>
                    <?php else: foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?php echo (int)$u['id']; ?></td>
                            <td><?php echo htmlspecialchars($u['name']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo ($u['admin'] == 1) ? 'Admin' : 'Usuário'; ?></td>
                            <td class="text-end">
                                <?php if ((int)$u['id'] !== (int)$_SESSION['user_id']): ?>
                                <form method="post" class="d-inline" onsubmit="return confirm('Excluir este usuário?');">
                                    <input type="hidden" name="delete_id" value="<?php echo (int)$u['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                                <?php else: ?>
                                    <span class="text-muted">Você</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h5 class="footerTitle">AquaTour</h5>
                    <p class="footerText">Conectando pessoas aos oceanos de forma sustentável e responsável.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>
</html>

