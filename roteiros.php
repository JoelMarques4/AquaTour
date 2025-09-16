<?php
session_start();
require_once 'login/config.php';

$roteiros = [];
try {
    $stmt = $pdo->query('SELECT * FROM roteiros ORDER BY created_at DESC');
    $roteiros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao carregar roteiros: ' . $e->getMessage() . '</div>';
}
?>

<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roteiros Sustentáveis - AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script defer src="script_roteiros.js"></script>
    <script defer src="script.js"></script>        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="roteiros.css" rel="stylesheet">
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
                        <a class="nav-link navbar-linkUI" href="index.php#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI active" href="roteiros.php">Roteiros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="impacto.php">Impacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="index.php#contact">Contato</a>
                    </li>
                    <?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']): ?>
                        <li class="nav-item">
                            <a class="nav-link navbar-linkUI" href="loginpage.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navbar-linkUI" href="cadastro.php">Cadastro</a>
                        </li>
                    <?php endif; ?>
                    <?php
                    // Adiciona o link do Painel se o usuário estiver logado
                    if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                            echo '<li class="nav-item"><a class="nav-link navbar-linkUI" href="painel.php">Painel (Admin)</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link navbar-linkUI" href="painel.php">Painel</a></li>';
                        }
                    }
                    ?>
                </ul>
                <?php if (isset($_SESSION['logged']) && $_SESSION['logged']): ?>
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
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="roteiros-hero">
        <div class="hero-overlay"></div>
        <div class="container text-center hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="hero-title">Roteiros Sustentáveis</h1>
                    <p class="hero-subtitle">Experiências únicas que conectam você com a vida marinha de forma responsável</p>
                    
                    <!-- Filtros rápidos -->
                    <div class="quick-filters">
                        <button class="filter-btn active" data-filter="all">Todos</button>
                        <button class="filter-btn" data-filter="certificado">Certificado</button>
                        <button class="filter-btn" data-filter="popular">Popular</button>
                        <button class="filter-btn" data-filter="sazonal">Sazonal</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Roteiros Detalhados -->
    <section class="py-5">
        <div class="container">
            
            <?php if (empty($roteiros)): ?>
                <div class="alert alert-info text-center" role="alert">
                    Nenhum roteiro cadastrado ainda. Adicione roteiros através do painel de gerenciamento.
                </div>
            <?php else: ?>
                <?php foreach ($roteiros as $roteiro): ?>
                    <?php $badgeFilterClass = strtolower(trim($roteiro["badge"] ?? '')); ?>
                    <div class="roteiro-detalhado mb-5 <?php echo $badgeFilterClass ? htmlspecialchars($badgeFilterClass) : ''; ?>" id="roteiro-<?php echo htmlspecialchars($roteiro["id"]); ?>" data-badge="<?php echo strtolower(trim($roteiro["badge"])) ?: 'no-badge'; ?>">
                        <div class="row align-items-center">
                            <div class="col-lg-6 <?php echo ($roteiro["id"] % 2 == 0) ? 'order-lg-2' : ''; ?>">
                                <div class="roteiro-image-container">
                                    <img src="<?php echo htmlspecialchars($roteiro["imagem"]); ?>" alt="<?php echo htmlspecialchars($roteiro["titulo"]); ?>" class="img-fluid rounded-4">
                                    <?php if (!empty($roteiro["badge"])): ?>
                                        <div class="roteiro-badge <?php echo htmlspecialchars($roteiro["badge"]); ?>">
                                            <?php 
                                            // Define a classe com base no tipo de badge
                                            $badgeClass = '';
                                            switch (htmlspecialchars($roteiro["badge"])) {
                                                case 'Certificado':
                                                    $badgeClass = 'badge-verde'; // Classe para badge verde
                                                    break;
                                                case 'Popular':
                                                    $badgeClass = 'badge-amarelo'; // Classe para badge amarelo
                                                    break;
                                                case 'Sazonal':
                                                    $badgeClass = 'badge-roxo'; // Classe para badge roxo
                                                    break;
                                                default:
                                                    $badgeClass = 'badge-default'; // Classe padrão, se necessário
                                                    break;
                                            }
                                            ?>
                                            <span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($roteiro["badge"]); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 <?php echo ($roteiro["id"] % 2 == 0) ? 'order-lg-1' : ''; ?>">
                                <div class="roteiro-content">
                                    <h2 class="roteiro-title"><?php echo htmlspecialchars($roteiro["titulo"]); ?></h2>
                                    <p class="roteiro-description">
                                        <?php echo nl2br(htmlspecialchars($roteiro["descricao"])); ?>
                                    </p>
                                    
                                    <?php if (!empty($roteiro["topicos_titulo"])): ?>
                                        <div class="roteiro-highlights">
                                            <h5><?php echo htmlspecialchars($roteiro["topicos_titulo"]); ?>:</h5>
                                            <ul>
                                                <?php if (!empty($roteiro["topico1"])): ?><li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($roteiro["topico1"]); ?></li><?php endif; ?>
                                                <?php if (!empty($roteiro["topico2"])): ?><li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($roteiro["topico2"]); ?></li><?php endif; ?>
                                                <?php if (!empty($roteiro["topico3"])): ?><li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($roteiro["topico3"]); ?></li><?php endif; ?>
                                                <?php if (!empty($roteiro["topico4"])): ?><li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($roteiro["topico4"]); ?></li><?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <div class="roteiro-info">
                                        <div class="info-grid">
                                            <?php if (!empty($roteiro["caracteristica1_titulo"])): ?>
                                                <div class="info-item">
                                                    <strong><?php echo htmlspecialchars($roteiro["caracteristica1_titulo"]); ?>:</strong> <?php echo htmlspecialchars($roteiro["caracteristica1_texto"]); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($roteiro["caracteristica2_titulo"])): ?>
                                                <div class="info-item">
                                                    <strong><?php echo htmlspecialchars($roteiro["caracteristica2_titulo"]); ?>:</strong> <?php echo htmlspecialchars($roteiro["caracteristica2_texto"]); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($roteiro["caracteristica3_titulo"])): ?>
                                                <div class="info-item">
                                                    <strong><?php echo htmlspecialchars($roteiro["caracteristica3_titulo"]); ?>:</strong> <?php echo htmlspecialchars($roteiro["caracteristica3_texto"]); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($roteiro["caracteristica4_titulo"])): ?>
                                                <div class="info-item">
                                                    <strong><?php echo htmlspecialchars($roteiro["caracteristica4_titulo"]); ?>:</strong> <?php echo htmlspecialchars($roteiro["caracteristica4_texto"]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="roteiro-pricing">
                                        <div class="price-tag">
                                            <span class="price">A partir de R$ <?php echo number_format($roteiro["preco"], 2, ",", "."); ?></span>
                                            <span class="price-note">por pessoa</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Seção de Compromisso Sustentável -->
    <section class="sustainability-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="section-title">Nosso Compromisso Sustentável</h2>
                    <p class="lead mb-5">Cada roteiro é cuidadosamente planejado para minimizar o impacto ambiental e maximizar a conservação</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="sustainability-card">
                                <div class="sustainability-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h5>Baixo Impacto</h5>
                                <p>Grupos pequenos e práticas que respeitam o habitat natural</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="sustainability-card">
                                <div class="sustainability-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h5>Educação</h5>
                                <p>Conscientização sobre conservação marinha em cada experiência</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="sustainability-card">
                                <div class="sustainability-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <h5>Comunidade</h5>
                                <p>Apoio às comunidades locais e projetos de conservação</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



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
                        <li><a class="footer-link" href="#dive">Mergulho</a></li>
                        <li><a class="footer-link" href="#turtles">Tartarugas</a></li>
                        <li><a class="footer-link" href="#whales">Baleias</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="footerTitle">Sobre</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="index.php#about">Nossa Missão</a></li>
                        <li><a class="footer-link" href="index.php#impact">Impacto</a></li>
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
                    <p class="footerText mb-0">&copy; 2025 AquaTour. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
