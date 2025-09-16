<?php
session_start();
// Incluir o arquivo de configuração do banco de dados
require_once 'login/config.php';

$message = '';
$message_type = '';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $imagem = trim($_POST['imagem'] ?? '');
    $badge = trim($_POST['badge'] ?? '');
    $caracteristica1_titulo = trim($_POST['caracteristica1_titulo'] ?? '');
    $caracteristica1_texto = trim($_POST['caracteristica1_texto'] ?? '');
    $caracteristica2_titulo = trim($_POST['caracteristica2_titulo'] ?? '');
    $caracteristica2_texto = trim($_POST['caracteristica2_texto'] ?? '');
    $caracteristica3_titulo = trim($_POST['caracteristica3_titulo'] ?? '');
    $caracteristica3_texto = trim($_POST['caracteristica3_texto'] ?? '');
    $caracteristica4_titulo = trim($_POST['caracteristica4_titulo'] ?? '');
    $caracteristica4_texto = trim($_POST['caracteristica4_texto'] ?? '');
    $topicos_titulo = trim($_POST['topicos_titulo'] ?? '');
    $topico1 = trim($_POST['topico1'] ?? '');
    $topico2 = trim($_POST['topico2'] ?? '');
    $topico3 = trim($_POST['topico3'] ?? '');
    $topico4 = trim($_POST['topico4'] ?? '');
    $preco = filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT);

    // Validação básica
    if (empty($titulo) || empty($descricao) || empty($imagem) || $preco === false) {
        $message = 'Por favor, preencha todos os campos obrigatórios (Título, Descrição, Imagem, Preço).';
        $message_type = 'danger';
    } else {
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO roteiros (
                    titulo, descricao, imagem, badge,
                    caracteristica1_titulo, caracteristica1_texto,
                    caracteristica2_titulo, caracteristica2_texto,
                    caracteristica3_titulo, caracteristica3_texto,
                    caracteristica4_titulo, caracteristica4_texto,
                    topicos_titulo, topico1, topico2, topico3, topico4, preco
                ) VALUES (
                    :titulo, :descricao, :imagem, :badge,
                    :caracteristica1_titulo, :caracteristica1_texto,
                    :caracteristica2_titulo, :caracteristica2_texto,
                    :caracteristica3_titulo, :caracteristica3_texto,
                    :caracteristica4_titulo, :caracteristica4_texto,
                    :topicos_titulo, :topico1, :topico2, :topico3, :topico4, :preco
                )'
            );

            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':imagem' => $imagem,
                ':badge' => !empty($badge) ? $badge : NULL,
                ':caracteristica1_titulo' => !empty($caracteristica1_titulo) ? $caracteristica1_titulo : NULL,
                ':caracteristica1_texto' => !empty($caracteristica1_texto) ? $caracteristica1_texto : NULL,
                ':caracteristica2_titulo' => !empty($caracteristica2_titulo) ? $caracteristica2_titulo : NULL,
                ':caracteristica2_texto' => !empty($caracteristica2_texto) ? $caracteristica2_texto : NULL,
                ':caracteristica3_titulo' => !empty($caracteristica3_titulo) ? $caracteristica3_titulo : NULL,
                ':caracteristica3_texto' => !empty($caracteristica3_texto) ? $caracteristica3_texto : NULL,
                ':caracteristica4_titulo' => !empty($caracteristica4_titulo) ? $caracteristica4_titulo : NULL,
                ':caracteristica4_texto' => !empty($caracteristica4_texto) ? $caracteristica4_texto : NULL,
                ':topicos_titulo' => !empty($topicos_titulo) ? $topicos_titulo : NULL,
                ':topico1' => !empty($topico1) ? $topico1 : NULL,
                ':topico2' => !empty($topico2) ? $topico2 : NULL,
                ':topico3' => !empty($topico3) ? $topico3 : NULL,
                ':topico4' => !empty($topico4) ? $topico4 : NULL,
                ':preco' => $preco
            ]);

            $message = 'Roteiro cadastrado com sucesso!';
            $message_type = 'success';
            // Limpar os campos do formulário após o sucesso
            $_POST = array();

        } catch (PDOException $e) {
            $message = 'Erro ao cadastrar roteiro: ' . $e->getMessage();
            $message_type = 'danger';
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaTour - Cadastrar Roteiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            margin-bottom: 30px;
        }
        h1 {
            color: #0056b3;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
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
                        <a class="nav-link navbar-linkUI" href="#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="roteiros.php">Roteiros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="impacto.html">Impacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="#contact">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="loginpage.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="cadastro.php">Cadastro</a>
                    </li>
                    <?php
                        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                            echo '<li class="nav-item"><a class="nav-link navbar-linkUI" href="painel.php">Painel</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Cadastrar Novo Roteiro</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="add_roteiro.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Roteiro</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">URL da Imagem</label>
                <input type="text" class="form-control" id="imagem" name="imagem" value="<?php echo htmlspecialchars($_POST['imagem'] ?? ''); ?>" required>
                <small class="form-text text-muted">Ex: baleia.jpg, https://example.com/imagem.jpg</small>
            </div>
            <div class="mb-3">
                <label for="badge" class="form-label">Badge</label>
                <select class="form-select" id="badge" name="badge">
                    <option value="">Nenhum</option>
                    <option value="Certificado" <?php echo (($_POST['badge'] ?? '') == 'Certificado') ? 'selected' : ''; ?>>Certificado</option>
                    <option value="Popular" <?php echo (($_POST['badge'] ?? '') == 'Popular') ? 'selected' : ''; ?>>Popular</option>
                    <option value="Sazonal" <?php echo (($_POST['badge'] ?? '') == 'Sazonal') ? 'selected' : ''; ?>>Sazonal</option>
                </select>
            </div>

            <hr>
            <h4>Características do Roteiro</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="caracteristica1_titulo" class="form-label">Característica 1 - Título</label>
                    <input type="text" class="form-control" id="caracteristica1_titulo" name="caracteristica1_titulo" value="<?php echo htmlspecialchars($_POST['caracteristica1_titulo'] ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="caracteristica1_texto" class="form-label">Característica 1 - Texto</label>
                    <input type="text" class="form-control" id="caracteristica1_texto" name="caracteristica1_texto" value="<?php echo htmlspecialchars($_POST['caracteristica1_texto'] ?? ''); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="caracteristica2_titulo" class="form-label">Característica 2 - Título</label>
                    <input type="text" class="form-control" id="caracteristica2_titulo" name="caracteristica2_titulo" value="<?php echo htmlspecialchars($_POST['caracteristica2_titulo'] ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="caracteristica2_texto" class="form-label">Característica 2 - Texto</label>
                    <input type="text" class="form-control" id="caracteristica2_texto" name="caracteristica2_texto" value="<?php echo htmlspecialchars($_POST['caracteristica2_texto'] ?? ''); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="caracteristica3_titulo" class="form-label">Característica 3 - Título</label>
                    <input type="text" class="form-control" id="caracteristica3_titulo" name="caracteristica3_titulo" value="<?php echo htmlspecialchars($_POST['caracteristica3_titulo'] ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="caracteristica3_texto" class="form-label">Característica 3 - Texto</label>
                    <input type="text" class="form-control" id="caracteristica3_texto" name="caracteristica3_texto" value="<?php echo htmlspecialchars($_POST['caracteristica3_texto'] ?? ''); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="caracteristica4_titulo" class="form-label">Característica 4 - Título</label>
                    <input type="text" class="form-control" id="caracteristica4_titulo" name="caracteristica4_titulo" value="<?php echo htmlspecialchars($_POST['caracteristica4_titulo'] ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="caracteristica4_texto" class="form-label">Característica 4 - Texto</label>
                    <input type="text" class="form-control" id="caracteristica4_texto" name="caracteristica4_texto" value="<?php echo htmlspecialchars($_POST['caracteristica4_texto'] ?? ''); ?>">
                </div>
            </div>

            <hr>
            <h4>Tópicos de Vivência</h4>
            <div class="mb-3">
                <label for="topicos_titulo" class="form-label">Título Geral dos Tópicos</label>
                <input type="text" class="form-control" id="topicos_titulo" name="topicos_titulo" value="<?php echo htmlspecialchars($_POST['topicos_titulo'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="topico1" class="form-label">Tópico 1</label>
                <textarea class="form-control" id="topico1" name="topico1" rows="2"><?php echo htmlspecialchars($_POST['topico1'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="topico2" class="form-label">Tópico 2</label>
                <textarea class="form-control" id="topico2" name="topico2" rows="2"><?php echo htmlspecialchars($_POST['topico2'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="topico3" class="form-label">Tópico 3</label>
                <textarea class="form-control" id="topico3" name="topico3" rows="2"><?php echo htmlspecialchars($_POST['topico3'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="topico4" class="form-label">Tópico 4</label>
                <textarea class="form-control" id="topico4" name="topico4" rows="2"><?php echo htmlspecialchars($_POST['topico4'] ?? ''); ?></textarea>
            </div>

            <hr>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($_POST['preco'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Roteiro</button>
            <a href="roteiros.php" class="btn btn-secondary">Voltar</a> <!-- Alterado -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

