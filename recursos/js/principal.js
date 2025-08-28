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
            evento.preventDefault();
            const dados = new FormData(this);

            fetch('/categorias', { method: 'POST', body: dados })
            .then(resposta => resposta.json())
            .then(resultado => {
                if (resultado.sucesso) {
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

    // --- Lógica para Abrir e Preparar Modal de Subcategoria ---
    const gatilhosSubcategoria = document.querySelectorAll('[data-modal-alvo="modal-subcategoria"]');
    const inputCategoriaId = document.getElementById('subcategoria-categoria-id');

    if (gatilhosSubcategoria.length > 0 && inputCategoriaId) {
        gatilhosSubcategoria.forEach(gatilho => {
            gatilho.addEventListener('click', function() {
                const categoriaId = this.getAttribute('data-categoria-id');
                inputCategoriaId.value = categoriaId;
            });
        });
    }

    // --- Lógica para Submissão de Formulário AJAX (Subcategoria) ---
    const formSubcategoria = document.getElementById('formulario-subcategoria');

    if (formSubcategoria) {
        formSubcategoria.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);

            fetch('/subcategorias', { method: 'POST', body: dados })
            .then(resposta => resposta.json())
            .then(resultado => {
                if (resultado.sucesso) {
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

    // --- Lógica para Abrir e Preparar Modal de Pilar ---
    const modalPilar = document.getElementById('modal-pilar');
    const formPilar = document.getElementById('formulario-pilar');
    const tituloModalPilar = document.getElementById('modal-pilar-titulo');
    const inputPilarId = document.getElementById('pilar-id');

    // Preparar para CRIAR
    const botaoNovoPilar = document.getElementById('botao-novo-pilar');
    if (botaoNovoPilar) {
        botaoNovoPilar.addEventListener('click', function() {
            tituloModalPilar.textContent = 'Novo Pilar';
            formPilar.action = '/pilares/armazenar';
            formPilar.reset();
            inputPilarId.value = '';
        });
    }

    // Preparar para EDITAR
    const botoesEditarPilar = document.querySelectorAll('.botao-editar-pilar');
    botoesEditarPilar.forEach(botao => {
        botao.addEventListener('click', function(evento) {
            evento.stopPropagation(); // Impede que o link do card seja seguido

            const pilarId = this.dataset.pilarId;
            tituloModalPilar.textContent = 'Editar Pilar';
            formPilar.action = `/pilares/${pilarId}/atualizar`;

            // Preenche o formulário
            document.getElementById('pilar-id').value = pilarId;
            document.getElementById('pilar-nome').value = this.dataset.pilarNome;
            document.getElementById('pilar-descricao').value = this.dataset.pilarDescricao;
            document.getElementById('pilar-cor').value = this.dataset.pilarCor;
        });
    });

    // --- Lógica para Submissão de Formulário AJAX (Pilar) ---
    if(formPilar) {
        formPilar.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);
            const url = this.action;

            fetch(url, { method: 'POST', body: dados })
            .then(resposta => resposta.json())
            .then(resultado => {
                if (resultado.sucesso) {
                    window.location.reload();
                } else {
                    alert('Erro: ' + (resultado.mensagem || 'Ocorreu um erro.'));
                }
            })
            .catch(erro => {
                console.error('Erro na requisição:', erro);
                alert('Ocorreu um erro de comunicação. Tente novamente.');
            });
        });
    }

    // --- Lógica para Abrir e Preparar Modal de Categoria para EDIÇÃO ---
    const botoesEditarCategoria = document.querySelectorAll('.botao-editar-categoria');
    const modalCategoria = document.getElementById('modal-categoria');
    const formCategoria = document.getElementById('formulario-categoria');
    const tituloModalCategoria = document.getElementById('modal-categoria-titulo');
    const botaoNovaCategoria = document.querySelector('[data-modal-alvo="modal-categoria"]');

    // Preparar para CRIAR
    if (botaoNovaCategoria) {
        botaoNovaCategoria.addEventListener('click', function() {
            tituloModalCategoria.textContent = 'Adicionar Nova Categoria';
            formCategoria.action = '/categorias';
            formCategoria.reset();
            // O pilar_id já está no formulário
        });
    }

    botoesEditarCategoria.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.categoriaId;

            // Buscar dados da categoria via AJAX
            fetch(`/categorias/${id}`)
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        const categoria = resultado.dados;

                        // Preencher o formulário
                        tituloModalCategoria.textContent = 'Editar Categoria';
                        formCategoria.action = `/categorias/${id}/atualizar`;
                        formCategoria.querySelector('[name="nome"]').value = categoria.nome;
                        formCategoria.querySelector('[name="pilar_id"]').value = categoria.pilar_id;

                        // O modal já é aberto pelo atributo data-modal-alvo
                    } else {
                        alert(resultado.mensagem || 'Erro ao buscar dados da categoria.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Erro de comunicação.');
                });
        });
    });

    // --- Lógica para Deletar Categoria ---
    const botoesDeletarCategoria = document.querySelectorAll('.botao-deletar-categoria');
    botoesDeletarCategoria.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.categoriaId;
            if (confirm('Tem certeza que deseja deletar esta categoria e todas as suas subcategorias?')) {
                fetch(`/categorias/${id}/deletar`, { method: 'POST' })
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        window.location.reload();
                    } else {
                        alert(resultado.mensagem || 'Erro ao deletar categoria.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Erro de comunicação.');
                });
            }
        });
    });

    // --- Lógica para Abrir e Preparar Modal de Subcategoria para EDIÇÃO ---
    const botoesEditarSubcategoria = document.querySelectorAll('.botao-editar-subcategoria');
    const modalSubcategoria = document.getElementById('modal-subcategoria');
    const formSubcategoria = document.getElementById('formulario-subcategoria');
    const tituloModalSubcategoria = document.getElementById('modal-subcategoria-titulo');

    botoesEditarSubcategoria.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.subcategoriaId;

            fetch(`/subcategorias/${id}`)
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        const subcategoria = resultado.dados;

                        tituloModalSubcategoria.textContent = 'Editar Subcategoria';
                        formSubcategoria.action = `/subcategorias/${id}/atualizar`;
                        formSubcategoria.querySelector('[name="nome"]').value = subcategoria.nome;
                        formSubcategoria.querySelector('[name="categoria_id"]').value = subcategoria.categoria_id;
                    } else {
                        alert(resultado.mensagem || 'Erro ao buscar dados da subcategoria.');
                    }
                });
        });
    });

    // --- Lógica para Deletar Subcategoria ---
    const botoesDeletarSubcategoria = document.querySelectorAll('.botao-deletar-subcategoria');
    botoesDeletarSubcategoria.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.subcategoriaId;
            if (confirm('Tem certeza que deseja deletar esta subcategoria?')) {
                fetch(`/subcategorias/${id}/deletar`, { method: 'POST' })
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        window.location.reload();
                    } else {
                        alert(resultado.mensagem || 'Erro ao deletar subcategoria.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Erro de comunicação.');
                });
            }
        });
    });

    // --- Lógica para Dropdowns Dinâmicos (Formulário de Meta) ---
    const pilarSelect = document.getElementById('meta-pilar');
    const categoriaSelect = document.getElementById('meta-categoria');
    const subcategoriaSelect = document.getElementById('meta-subcategoria');

    if (pilarSelect) {
        pilarSelect.addEventListener('change', function() {
            const pilarId = this.value;
            // Limpa e desabilita os selects seguintes
            categoriaSelect.innerHTML = '<option value="">Carregando...</option>';
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma Subcategoria...</option>';
            categoriaSelect.disabled = true;
            subcategoriaSelect.disabled = true;

            if (!pilarId) return;

            fetch(`/pilares/${pilarId}/categorias`)
                .then(resposta => resposta.json())
                .then(resultado => {
                    categoriaSelect.innerHTML = '<option value="">Selecione uma Categoria...</option>';
                    if (resultado.sucesso) {
                        resultado.dados.forEach(categoria => {
                            const option = new Option(categoria.nome, categoria.id);
                            categoriaSelect.add(option);
                        });
                        categoriaSelect.disabled = false;
                    }
                });
        });
    }

    if (categoriaSelect) {
        categoriaSelect.addEventListener('change', function() {
            const categoriaId = this.value;
            subcategoriaSelect.innerHTML = '<option value="">Carregando...</option>';
            subcategoriaSelect.disabled = true;

            if (!categoriaId) return;

            fetch(`/categorias/${categoriaId}/subcategorias`)
                .then(resposta => resposta.json())
                .then(resultado => {
                    subcategoriaSelect.innerHTML = '<option value="">Selecione uma Subcategoria...</option>';
                    if (resultado.sucesso && resultado.dados.length > 0) {
                        resultado.dados.forEach(subcategoria => {
                            const option = new Option(subcategoria.nome, subcategoria.id);
                            subcategoriaSelect.add(option);
                        });
                        subcategoriaSelect.disabled = false;
                    } else {
                        // Mantém desabilitado se não houver subcategorias
                    }
                });
        });
    }

    // --- Lógica para Submissão de Formulário AJAX (Meta) ---
    const formMeta = document.getElementById('formulario-meta');
    if (formMeta) {
        formMeta.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);

            fetch('/metas', { method: 'POST', body: dados })
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        window.location.reload();
                    } else {
                        alert('Erro: ' + (resultado.mensagem || 'Ocorreu um erro.'));
                    }
                })
                .catch(erro => {
                    console.error('Erro na requisição:', erro);
                    alert('Ocorreu um erro de comunicação. Tente novamente.');
                });
        });
    }

    // --- Lógica para Edição e Deleção de Metas ---
    const botoesEditarMeta = document.querySelectorAll('.botao-editar-meta');
    const botoesDeletarMeta = document.querySelectorAll('.botao-deletar-meta');
    const formMeta = document.getElementById('formulario-meta');
    const modalMeta = document.getElementById('modal-meta');
    const tituloModalMeta = document.getElementById('modal-meta-titulo');

    // Preparar para CRIAR
    const botaoNovaMeta = document.getElementById('botao-nova-meta');
    if (botaoNovaMeta) {
        botaoNovaMeta.addEventListener('click', function() {
            tituloModalMeta.textContent = 'Nova Meta';
            formMeta.action = '/metas';
            formMeta.reset();
            document.getElementById('meta-id').value = '';
            categoriaSelect.disabled = true;
            subcategoriaSelect.disabled = true;
        });
    }

    // Preparar para EDITAR
    botoesEditarMeta.forEach(botao => {
        botao.addEventListener('click', async function() {
            const id = this.dataset.metaId;
            tituloModalMeta.textContent = 'Editar Meta';
            formMeta.action = `/metas/${id}/atualizar`;

            // Buscar dados da meta
            const resposta = await fetch(`/metas/${id}`);
            const resultado = await resposta.json();

            if (!resultado.sucesso) {
                alert(resultado.mensagem || 'Erro ao buscar dados da meta.');
                return;
            }

            const meta = resultado.dados;

            // Preencher campos simples
            formMeta.querySelector('#meta-id').value = meta.id;
            formMeta.querySelector('#meta-nome').value = meta.nome;
            formMeta.querySelector('#meta-descricao').value = meta.descricao;
            formMeta.querySelector('#meta-data-inicio').value = meta.data_inicio;
            formMeta.querySelector('#meta-data-fim').value = meta.data_fim;

            // Preencher hierarquia em cascata
            pilarSelect.value = meta.pilar_id;

            // Dispara o change do pilar para carregar categorias
            await carregarCategorias(meta.pilar_id, meta.categoria_id);

            // Dispara o change da categoria para carregar subcategorias
            if (meta.categoria_id) {
                await carregarSubcategorias(meta.categoria_id, meta.subcategoria_id);
            }
        });
    });

    async function carregarCategorias(pilarId, categoriaIdParaSelecionar) {
        categoriaSelect.innerHTML = '<option value="">Carregando...</option>';
        const resposta = await fetch(`/pilares/${pilarId}/categorias`);
        const resultado = await resposta.json();

        categoriaSelect.innerHTML = '<option value="">Selecione uma Categoria...</option>';
        if (resultado.sucesso) {
            resultado.dados.forEach(c => categoriaSelect.add(new Option(c.nome, c.id)));
            categoriaSelect.disabled = false;
            if (categoriaIdParaSelecionar) {
                categoriaSelect.value = categoriaIdParaSelecionar;
            }
        }
    }

    async function carregarSubcategorias(categoriaId, subcategoriaIdParaSelecionar) {
        subcategoriaSelect.innerHTML = '<option value="">Carregando...</option>';
        const resposta = await fetch(`/categorias/${categoriaId}/subcategorias`);
        const resultado = await resposta.json();

        subcategoriaSelect.innerHTML = '<option value="">Selecione uma Subcategoria...</option>';
        if (resultado.sucesso && resultado.dados.length > 0) {
            resultado.dados.forEach(sc => subcategoriaSelect.add(new Option(sc.nome, sc.id)));
            subcategoriaSelect.disabled = false;
            if (subcategoriaIdParaSelecionar) {
                subcategoriaSelect.value = subcategoriaIdParaSelecionar;
            }
        } else {
            subcategoriaSelect.disabled = true;
        }
    }


    // Lógica para Deletar Meta
    botoesDeletarMeta.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.metaId;
            if (confirm('Tem certeza que deseja deletar esta meta?')) {
                fetch(`/metas/${id}/deletar`, { method: 'POST' })
                    .then(r => r.json())
                    .then(res => {
                        if (res.sucesso) {
                            window.location.reload();
                        } else {
                            alert(res.mensagem || 'Erro ao deletar meta.');
                        }
                    });
            }
        });
    });
});
