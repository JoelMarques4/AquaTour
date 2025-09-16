<?php
session_start();
require_once 'login/config.php'; // Incluir o arquivo de configuração do banco de dados

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header('Location: loginpage.php');
    exit();
}

$roteiros = [];
try {
    $stmt = $pdo->query('SELECT * FROM roteiros ORDER BY created_at DESC');
    $roteiros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Em um ambiente de produção, você registraria o erro em vez de exibi-lo diretamente
    echo '<div class="alert alert-danger">Erro ao carregar roteiros: ' . $e->getMessage() . '</div>';
}
?>

<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Roteiros - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="painel.css" rel="stylesheet"> <!-- CSS externo para o painel -->
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
                        <a class="nav-link navbar-linkUI" href="painel.php">Painel</a>
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
            <h1>Gerenciar Roteiros</h1>
            <a href="add_roteiro.php" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar Novo Roteiro</a>
        </div>

        <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
            <div class="alert alert-<?php echo htmlspecialchars($_GET['type']); ?>" role="alert">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nome do Roteiro</th>
                                <th scope="col">Preço</th>
                                <th scope="col" class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($roteiros)): ?>
                                <tr>
                                    <td colspan="3" class="text-center">Nenhum roteiro cadastrado ainda.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($roteiros as $roteiro): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($roteiro['titulo']); ?></td>
                                        <td>R$ <?php echo number_format($roteiro['preco'], 2, ',', '.'); ?></td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary table-action-btn" title="Editar" 
                                                    data-id="<?php echo $roteiro['id']; ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger table-action-btn" title="Excluir"
                                                    data-id="<?php echo $roteiro['id']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h5 class="footerTitle">AquaTour</h5>
                    <p class="footerText">Conectando pessoas aos oceanos de forma sustentável e responsável.</p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="footerTitle">Roteiros</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="roteiros.html#dive">Mergulho</a></li>
                        <li><a class="footer-link" href="roteiros.html#turtles">Tartarugas</a></li>
                        <li><a class="footer-link" href="roteiros.html#whales">Baleias</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="footerTitle">Sobre</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="index.php#about">Nossa Missão</a></li>
                        <li><a class="footer-link" href="impacto.html">Impacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="footerTitle">Suporte</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="index.php#contact">Contato</a></li>
                        <li><a class="footer-link" href="index.php#report">Denúncias</a></li>
                        <li><a class="footer-link" href="index.php#faq">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 AquaTour. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>
</html>
