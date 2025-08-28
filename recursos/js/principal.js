// Espera o DOM ser completamente carregado para adicionar os ouvintes de evento
document.addEventListener('DOMContentLoaded', function() {

    // --- Lógica para o Componente Modal ---

    // Encontra todos os botões que abrem modais
    const gatilhosModal = document.querySelectorAll('[data-modal-alvo]');

    // Adiciona um ouvinte de clique para cada botão gatilho
    gatilhosModal.forEach(gatilho => {
        gatilho.addEventListener('click', function() {
            const alvoId = this.getAttribute('data-modal-alvo');
            const modal = document.getElementById(alvoId);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // Encontra todos os elementos que fecham modais
    const fechadoresModal = document.querySelectorAll('[data-modal-fechar]');

    // Adiciona um ouvinte de clique para cada elemento de fechar
    fechadoresModal.forEach(fechador => {
        fechador.addEventListener('click', function() {
            // Encontra o modal pai do elemento de fechar
            const modal = this.closest('.modal');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Adiciona um ouvinte de clique na janela para fechar o modal ao clicar fora dele
    window.addEventListener('click', function(evento) {
        // Verifica se o clique foi em um modal (o fundo escuro)
        if (evento.target.classList.contains('modal')) {
            evento.target.style.display = 'none';
        }
    });


    // --- Lógica para Submissão de Formulário AJAX (Categoria) ---
    const formCategoria = document.getElementById('formulario-categoria');

    if (formCategoria) {
        formCategoria.addEventListener('submit', function(evento) {
            evento.preventDefault(); // Impede a submissão tradicional

            const dados = new FormData(this);

            fetch('/categorias', {
                method: 'POST',
                body: dados
            })
            .then(resposta => resposta.json())
            .then(resultado => {
                if (resultado.sucesso) {
                    // Simplesmente recarrega a página para mostrar a nova categoria.
                    // Uma implementação mais avançada adicionaria o item dinamicamente.
                    window.location.reload();
                } else {
                    alert('Erro: ' + resultado.mensagem);
                }
            })
            .catch(erro => {
                console.error('Erro na requisição:', erro);
                alert('Ocorreu um erro de comunicação. Tente novamente.');
            });
        });
    }

});
