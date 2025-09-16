<?php
// edit_roteiro.php - Permite editar um roteiro existente
session_start();
require_once 'login/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header('Location: loginpage.php');
    exit();
}

// Inicializa variáveis
$message = '';
$message_type = '';

// Busca o roteiro pelo ID passado na URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: gerenciar-roteiros.php?message=Roteiro não encontrado.&type=danger');
    exit();
}

// Busca os dados atuais do roteiro
try {
    $stmt = $pdo->prepare('SELECT * FROM roteiros WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $roteiro = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$roteiro) {
        header('Location: gerenciar-roteiros.php?message=Roteiro não encontrado.&type=danger');
        exit();
    }
} catch (PDOException $e) {
    header('Location: gerenciar-roteiros.php?message=Erro ao buscar roteiro.&type=danger');
    exit();
}

// Se o formulário foi enviado, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
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
            $stmt = $pdo->prepare('UPDATE roteiros SET
                titulo = :titulo,
                descricao = :descricao,
                imagem = :imagem,
                badge = :badge,
                caracteristica1_titulo = :caracteristica1_titulo,
                caracteristica1_texto = :caracteristica1_texto,
                caracteristica2_titulo = :caracteristica2_titulo,
                caracteristica2_texto = :caracteristica2_texto,
                caracteristica3_titulo = :caracteristica3_titulo,
                caracteristica3_texto = :caracteristica3_texto,
                caracteristica4_titulo = :caracteristica4_titulo,
                caracteristica4_texto = :caracteristica4_texto,
                topicos_titulo = :topicos_titulo,
                topico1 = :topico1,
                topico2 = :topico2,
                topico3 = :topico3,
                topico4 = :topico4,
                preco = :preco
                WHERE id = :id');
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
                ':preco' => $preco,
                ':id' => $id
            ]);
            header('Location: gerenciar-roteiros.php?message=Roteiro atualizado com sucesso!&type=success');
            exit();
        } catch (PDOException $e) {
            $message = 'Erro ao atualizar roteiro: ' . $e->getMessage();
            $message_type = 'danger';
        }
    }
} else {
    // Se não enviou, preenche o formulário com os dados atuais
    $_POST = $roteiro;
}
?>
<!doctype html>
<html lang="pt-BR" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Roteiro - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbarUI px-5 py-2">
        <div class="container-fluid">
            <a class="navbar-brand navbar-linkUI" href="index.php">
                <img src="logo-white.svg" width="100" height="100" class="d-inline-block">
            </a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Editar Roteiro</h1>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <!-- Formulário igual ao de cadastro, mas preenchido -->
        <form action="edit_roteiro.php?id=<?php echo $id; ?>" method="POST">
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
            <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($_POST['preco'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="gerenciar-roteiros.php" class="btn btn-secondary ms-3">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- Fim do edit_roteiro.php -->

