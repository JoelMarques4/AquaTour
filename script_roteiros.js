document.addEventListener('DOMContentLoaded', function() {

    // --- LÓGICA DOS FILTROS RÁPIDOS ---
    const filterButtons = document.querySelectorAll('.filter-btn');
    const roteiros = document.querySelectorAll('.roteiro-detalhado');

    if (filterButtons.length > 0 && roteiros.length > 0) {
        // Adiciona as classes de categoria para os filtros funcionarem
        const diveElement = document.getElementById('dive');
        if (diveElement) diveElement.classList.add('mergulho');

        const turtlesElement = document.getElementById('turtles');
        if (turtlesElement) turtlesElement.classList.add('observacao', 'noturno');
        
        const whalesElement = document.getElementById('whales');
        if (whalesElement) whalesElement.classList.add('observacao');

        // Adiciona o evento de clique a cada botão de filtro
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove a classe 'active' de todos os botões
                filterButtons.forEach(b => b.classList.remove('active'));
                // Adiciona a classe 'active' apenas ao botão que foi clicado
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                roteiros.forEach(roteiro => {
                    // Mostra ou esconde o roteiro com base no filtro selecionado
                    if (filter === 'all' || roteiro.classList.contains(filter)) {
                        roteiro.style.display = 'block';
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
