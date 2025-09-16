<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>

<body class="d-flex flex-column h-100">
    <?php
    session_start();
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
                        <a class="nav-link navbar-linkUI" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="index.php#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="roteiros.php">Roteiros</a> <!-- Alterado -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="impacto.html">Impacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="index.php#contact">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="loginpage.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="cadastro.php">Cadastro</a>
                    </li>
                </ul>
                <form class="d-flex ms-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" />
                    <button class="btn btn-primaryNav" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
       <section class="login-section d-flex align-items-center justify-content-center flex-grow-1">
    <div class="login-card p-5 shadow-lg">
      <h2 class="text-center mb-4">Entrar</h2>
      <form action="login/login.php" method="POST">
        <p class="text-danger">
            <?php 
                if(isset($_SESSION['error'])) {
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                }
            ?>
        </p>
        <p class="text-success">
            <?php 
                if(isset($_SESSION['success'])) {
                    echo htmlspecialchars($_SESSION['success']);
                    unset($_SESSION['success']);
                }
            ?>
        </p>
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
      <p class="text-center mt-4">
        Não tem conta? <a href="cadastro.php" class="signup-link">Cadastre-se</a>
      </p>
    </div>
  </section>
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
    <script src="script.js"></script>
</body>

</html>