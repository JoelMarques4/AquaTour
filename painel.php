<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="painel.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 admin-bg">
    <?php
        session_start();
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: loginpage.php');
            exit();
        }

    ?>

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
        <div class="text-center mb-5">
            <h1>Painel de Controle</h1>
            <p class="lead">Gerencie as informações do site AquaTour.</p>
        </div>
        <div class="row">
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="gerenciar-roteiros.php" class="dashboard-card">
                        <div class="card-body">
                            <div class="dashboard-icon"><i class="fas fa-map-signs"></i></div>
                            <h5 class="card-title">Gerenciar Roteiros</h5>
                            <p class="card-text">Adicione, edite ou remova roteiros turísticos.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="usuarios.php" class="dashboard-card">
                        <div class="card-body">
                            <div class="dashboard-icon"><i class="fas fa-users"></i></div>
                            <h5 class="card-title">Gerenciar Usuários</h5>
                            <p class="card-text">Visualize e exclua usuários do sistema.</p>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="perfil.php" class="dashboard-card">
                    <div class="card-body">
                        <div class="dashboard-icon"><i class="fas fa-user-edit"></i></div>
                        <h5 class="card-title">Editar Perfil</h5>
                        <p class="card-text">Atualize seus dados pessoais e senha.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="login/logout.php" class="dashboard-card">
                    <div class="card-body">
                        <div class="dashboard-icon"><i class="fas fa-sign-out-alt"></i></div>
                        <h5 class="card-title">Sair</h5>
                        <p class="card-text">Fazer logout e retornar para a página inicial.</p>
                    </div>
                </a>
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
                        <li><a class="footer-link" href="impacto.php">Impacto</a></li>
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
