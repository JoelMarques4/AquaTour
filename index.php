<!doctype html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaTour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php
    session_start();
    if (isset($_SESSION['success_delete'])) {
        echo '<div class="alert alert-danger text-center m-0" role="alert">' . htmlspecialchars($_SESSION['success_delete']) . '</div>';
        unset($_SESSION['success_delete']);
    }
    ?>

    <nav class="navbar navbar-expand-lg navbarUI px-5 py-2">
        <div class="container-fluid">
            <a class="navbar-brand navbar-linkUI" href="#">
                <img src="logo-white.svg" width="100" height="100" class="d-inline-block">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-linkUI" href="roteiros.php">Roteiros</a> <!-- Alterado -->
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
                <form class="d-flex ms-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" />
                    <button class="btn btn-primaryNav" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="ocean-background">
        </div>
        <div class="container text-center hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">
                        <span>Aqua</span><span>Tour</span>
                    </h1>
                    <p class="hero-subtitle">Turismo Sustentável e Conservação Marinha</p>

                    <!-- Contador de impacto -->
                    <div class="impact-counter">
                        <div class="counter-box">
                            <div class="counter-number">125</div>
                            <div class="counter-label">Roteiros Sustentáveis</div>
                        </div>
                    </div>

                    <div class="hero-buttons">
                        <a href="#tours" class="btn btn-primary btn-lg me-3">
                            Explorar Roteiros
                        </a>
                        <a href="#about" class="btn btn-outline-light btn-lg">
                            Saiba Mais
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title ">Protegendo Nossos Oceanos</h2>
                    <p class="lead">O AquaTour conecta turistas, operadores e comunidades locais, promovendo atividades
                        turísticas sustentáveis que respeitam e protegem os ecossistemas marinhos.</p>

                    <div class="feature-list">
                        <div class="feature-item">
                            <div>
                                <h5>Turismo de Baixo Impacto</h5>
                                <p>Incentivamos práticas que preservam a vida marinha</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div>
                                <h5>Comunidades Locais</h5>
                                <p>Apoiamos a geração de renda sustentável</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div>
                                <h5>Monitoramento</h5>
                                <p>Sistema de denúncia e acompanhamento ambiental</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="turtle.jpg" alt="Tartaruga" class="img-fluid rounded-5">
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Section -->
    <section id="tours" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Roteiros Sustentáveis</h2>
                <p class="lead">Descubra experiências únicas que respeitam a natureza</p>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <a href="roteiros.html#dive" class="text-decoration-none">
                        <div class="tour-card" id="dive">
                            <div class="tour-image">
                                <img src="corais.jpg" alt="Mergulho em Recifes">
                                <div class="tour-badge">Certificado</div>
                            </div>
                            <div class="tour-content">
                                <h4>Mergulho em Recifes</h4>
                                <p>Explore a biodiversidade marinha com guias especializados em conservação.</p>
                                <div class="tour-features">
                                    <span><i class="fas fa-leaf"></i> Eco-friendly</span>
                                    <span><i class="fas fa-users"></i> Grupos pequenos</span>
                                </div>
                                <div class="tour-price">A partir de R$ 180</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 mb-4">
                    <a href="roteiros.html#turtles" class="text-decoration-none">
                        <div class="tour-card" id="turtles">
                            <div class="tour-image">
                                <img src="tartarugas.jpg" alt="Observação de Tartarugas">
                                <div class="tour-badge">Popular</div>
                            </div>
                            <div class="tour-content">
                                <h4>Observação de Tartarugas</h4>
                                <p>Acompanhe o ciclo de vida das tartarugas marinhas em seu habitat natural.</p>
                                <div class="tour-features">
                                    <span><i class="fas fa-moon"></i> Noturno</span>
                                    <span><i class="fas fa-camera"></i> Fotografia</span>
                                </div>
                                <div class="tour-price">A partir de R$ 120</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 mb-4">
                    <a href="roteiros.html#whales" class="text-decoration-none">
                        <div class="tour-card" id="whales">
                            <div class="tour-image">
                                <img src="baleia.jpg" alt="Observação de Baleias">
                                <div class="tour-badge">Sazonal</div>
                            </div>
                            <div class="tour-content">
                                <h4>Observação de Orcas</h4>
                                <p>Encontro respeitoso com os gigantes dos oceanos durante a temporada de migração.</p>
                                <div class="tour-features">
                                    <span><i class="fas fa-ship"></i> Embarcação</span>
                                    <span><i class="fas fa-binoculars"></i> Avistamento</span>
                                </div>
                                <div class="tour-price">A partir de R$ 250</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section id="impact" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nosso Impacto</h2>
                <p class="lead">Juntos, estamos fazendo a diferença para os oceanos</p>
            </div>

            <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="impact-stat">
                        <a href="impacto.html#tartarugas" class="text-decoration-none">
                            <div class="stat-icon">🐢</div>
                            <div class="stat-number">+350</div>
                            <div class="stat-label">Tartarugas Resgatadas</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="impact-stat">
                        <a href="impacto.html#corais" class="text-decoration-none">
                            <div class="stat-icon">🪸</div>
                            <div class="stat-number">+4 mil</div>
                            <div class="stat-label">Fragmentos de Corais Plantados</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="impact-stat">
                        <a href="impacto.html#turistas" class="text-decoration-none">
                            <div class="stat-icon">👥</div>
                            <div class="stat-number">+50</div>
                            <div class="stat-label">Comunidades Locais Envolvidas</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="impact-stat">
                        <a href="impacto.html#lixo" class="text-decoration-none">
                            <div class="stat-icon">♻️</div>
                            <div class="stat-number">+18</div>
                            <div class="stat-label">Toneladas de Lixo Removidos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Contato</h2>
            <p class="lead text-center">Entre em contato conosco para dúvidas, sugestões ou parcerias.</p>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="mensagem" rows="4" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Denúncias Section -->
    <section id="report" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Denúncias</h2>
            <p class="lead text-center">Ajude-nos a monitorar e preservar os oceanos, reportando atividades suspeitas ou
                prejudiciais.</p>
            <div class="text-center">
                <a href="#report" class="btn btn-primary btn-lg me-3">
                    Fazer uma Denúncia
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">FAQ</h2>
            <p class="lead text-center">Perguntas Frequentes</p>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="q1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1"
                            aria-expanded="true" aria-controls="a1">
                            Como posso reservar um roteiro?
                        </button>
                    </h2>
                    <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Basta acessar a seção <strong>Roteiros</strong>, escolher a atividade desejada e clicar em
                            reservar.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="q2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#a2" aria-expanded="false" aria-controls="a2">
                            Os roteiros são adequados para crianças?
                        </button>
                    </h2>
                    <div id="a2" class="accordion-collapse collapse" aria-labelledby="q2"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Sim! Muitos roteiros são voltados para toda a família. Verifique as recomendações em cada
                            atividade.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="section-title text-center">Faça Parte da Mudança</h2>
                    <p class="lead text-center">Junte-se a nós na missão de proteger nossos oceanos através do turismo sustentável.</p>
                    <div class="cta-buttons">
                        <a href="cadastro.php" class="btn btn-primary btn-lg me-3  align-items-center justify-content-center gap-2">
                            <img src="user.svg" alt="" width="20" height="20" class="img-fluid"> 
                            Cadastre-se
                        </a>
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
                        <li><a class="footer-link" href="#about">Nossa Missão</a></li>
                        <li><a class="footer-link" href="#impact">Impacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="footerTitle">Suporte</h6>
                    <ul class="list-unstyled">
                        <li><a class="footer-link" href="#contact">Contato</a></li>
                        <li><a class="footer-link" href="#report">Denúncias</a></li>
                        <li><a class="footer-link" href="#faq">FAQ</a></li>
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