document.addEventListener('DOMContentLoaded', function() {

    // --- LÓGICA DOS FILTROS RÁPIDOS ---
    const filterButtons = document.querySelectorAll('.filter-btn');
    const roteiros = document.querySelectorAll('.roteiro-detalhado');

    if (filterButtons.length > 0 && roteiros.length > 0) {
        // Nada a mapear por ID agora; filtro por badge via data-attribute

        // Adiciona o evento de clique a cada botão de filtro
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove a classe 'active' de todos os botões
                filterButtons.forEach(b => b.classList.remove('active'));
                // Adiciona a classe 'active' apenas ao botão que foi clicado
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                roteiros.forEach(roteiro => {
                    // Mostra ou esconde o roteiro com base no filtro selecionado (usa classe e data-attr)
                    if (filter === 'all') {
                        roteiro.style.display = '';
                        return;
                    }

                    const badgeAttr = (roteiro.getAttribute('data-badge') || '').toLowerCase();
                    const hasClass = roteiro.classList.contains(filter);

                    if (badgeAttr === filter || hasClass) {
                        roteiro.style.display = '';
                    } else {
                        roteiro.style.display = 'none';
                    }
                });
            });
        });
    }


    const smoothScrollLinks = document.querySelectorAll('a.footer-link[href^="#"]');

    smoothScrollLinks.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault(); 
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Rola a página suavemente até o elemento alvo
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

});
