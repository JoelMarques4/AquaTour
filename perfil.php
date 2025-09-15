<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Perfil - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <link href="painel.css" rel="stylesheet">
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("editForm");
    const msgBox = document.getElementById("msg");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("login/edit_account.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                msgBox.innerHTML = `<div class="alert alert-success">${result.message}</div>`;

                const navUser = document.getElementById("navbarUser");
                if (navUser) navUser.textContent = "Bem-vindo, " + formData.get("name");
            } else {
                msgBox.innerHTML = `<div class="alert alert-danger">${result.message}</div>`;
            }

        } catch (error) {
            msgBox.innerHTML = `<div class="alert alert-danger">Erro: ${error}</div>`;
        }
    });
});
</script>



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
                        <a class="nav-link navbar-linkUI" href="painel.php">Painel</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-linkUI" id="navbarUser" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Bem-vindo, <?php echo htmlspecialchars($_SESSION['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item active" href="perfil.php">Meu Perfil</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="login/logout.php">Sair</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 d-flex justify-content-center">
                <div class="login-card p-5 shadow-lg w-100">
                    <h2 class="text-center mb-4">Editar Perfil</h2>
                    <form id="editForm">
                        <p class="text-center text-success">
                            <div id="msg"></div>
                        </p>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nova Senha (opcional )</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Deixe em branco para não alterar">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <h5 class="text-danger">Excluir Conta</h5>
                        <p class="text-muted">Esta ação é permanente e não pode ser desfeita.</p>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Excluir Minha Conta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Confirmar Exclusão</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Você tem certeza de que deseja excluir sua conta? Todos os seus dados serão perdidos permanentemente.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form action="login/delete_account.php" method="POST" class="d-inline">
                <button type="submit" class="btn btn-danger">Excluir Conta</button>
            </form>
          </div>
        </div>
      </div>
    </div>

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
