// Espera o DOM ser completamente carregado para adicionar os ouvintes de evento
document.addEventListener('DOMContentLoaded', function() {

    // --- Lógica para o Componente Modal ---
    const gatilhosModal = document.querySelectorAll('[data-modal-alvo]');
    gatilhosModal.forEach(gatilho => {
        gatilho.addEventListener('click', function() {
            const alvoId = this.getAttribute('data-modal-alvo');
            const modal = document.getElementById(alvoId);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    const fechadoresModal = document.querySelectorAll('[data-modal-fechar]');
    fechadoresModal.forEach(fechador => {
        fechador.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    window.addEventListener('click', function(evento) {
        if (evento.target.classList.contains('modal')) {
            evento.target.style.display = 'none';
        }
    });

    // --- Lógica para Formulário AJAX (Pilar) ---
    const formPilar = document.getElementById('formulario-pilar');
    if (formPilar) {
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
                    alert('Ocorreu um erro de comunicação.');
                });
        });
    }

    const modalPilar = document.getElementById('modal-pilar');
    const tituloModalPilar = document.getElementById('modal-pilar-titulo');
    const inputPilarId = document.getElementById('pilar-id');
    const botaoNovoPilar = document.getElementById('botao-novo-pilar');
    if (botaoNovoPilar) {
        botaoNovoPilar.addEventListener('click', function() {
            tituloModalPilar.textContent = 'Novo Pilar';
            formPilar.action = '/pilares/armazenar';
            formPilar.reset();
            inputPilarId.value = '';
        });
    }
    const botoesEditarPilar = document.querySelectorAll('.botao-editar-pilar');
    botoesEditarPilar.forEach(botao => {
        botao.addEventListener('click', function(evento) {
            evento.stopPropagation();
            const pilarId = this.dataset.pilarId;
            tituloModalPilar.textContent = 'Editar Pilar';
            formPilar.action = `/pilares/${pilarId}/atualizar`;
            document.getElementById('pilar-id').value = pilarId;
            document.getElementById('pilar-nome').value = this.dataset.pilarNome;
            document.getElementById('pilar-descricao').value = this.dataset.pilarDescricao;
            document.getElementById('pilar-cor').value = this.dataset.pilarCor;
        });
    });

    // --- Lógica para Formulário AJAX (Categoria) ---
    const formCategoria = document.getElementById('formulario-categoria');
    if (formCategoria) {
        formCategoria.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);
            const url = formCategoria.action; // Use a action do formulário
            fetch(url, { method: 'POST', body: dados })
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
                    alert('Ocorreu um erro de comunicação.');
                });
        });
    }
    const botoesEditarCategoria = document.querySelectorAll('.botao-editar-categoria');
    const tituloModalCategoria = document.getElementById('modal-categoria-titulo');
    const botaoNovaCategoria = document.querySelector('[data-modal-alvo="modal-categoria"]');
    if (botaoNovaCategoria) {
        botaoNovaCategoria.addEventListener('click', function() {
            tituloModalCategoria.textContent = 'Adicionar Nova Categoria';
            formCategoria.action = '/categorias';
            formCategoria.reset();
        });
    }
    botoesEditarCategoria.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.categoriaId;
            fetch(`/categorias/${id}`)
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        const categoria = resultado.dados;
                        tituloModalCategoria.textContent = 'Editar Categoria';
                        formCategoria.action = `/categorias/${id}/atualizar`;
                        formCategoria.querySelector('[name="nome"]').value = categoria.nome;
                        formCategoria.querySelector('[name="pilar_id"]').value = categoria.pilar_id;
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

    // --- Lógica para Formulário AJAX (Subcategoria) ---
    const formSubcategoria = document.getElementById('formulario-subcategoria');
    if (formSubcategoria) {
        formSubcategoria.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);
            const url = formSubcategoria.action;
            fetch(url, { method: 'POST', body: dados })
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
                    alert('Ocorreu um erro de comunicação.');
                });
        });
    }
    const gatilhosSubcategoria = document.querySelectorAll('[data-modal-alvo="modal-subcategoria"]');
    const inputCategoriaId = document.getElementById('subcategoria-categoria-id');
    const tituloModalSubcategoria = document.getElementById('modal-subcategoria-titulo');
    gatilhosSubcategoria.forEach(gatilho => {
        gatilho.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-categoria-id');
            tituloModalSubcategoria.textContent = 'Adicionar Nova Subcategoria';
            formSubcategoria.action = '/subcategorias';
            formSubcategoria.reset();
            inputCategoriaId.value = categoriaId;
        });
    });
    const botoesEditarSubcategoria = document.querySelectorAll('.botao-editar-subcategoria');
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
                        inputCategoriaId.value = subcategoria.categoria_id;
                    } else {
                        alert(resultado.mensagem || 'Erro ao buscar dados da subcategoria.');
                    }
                });
        });
    });
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

    // --- Lógica para Formulário Dinâmico de Tarefas ---
    const radiosTipoTemporal = document.querySelectorAll('input[name="tipo_temporal"]');
    const campoPeriodo = document.getElementById('campo-periodo');
    const campoHorario = document.getElementById('campo-horario');
    function toggleCamposTemporais() {
        const selecionado = document.querySelector('input[name="tipo_temporal"]:checked').value;
        campoPeriodo.style.display = 'none';
        campoHorario.style.display = 'none';
        if (selecionado === 'periodo') {
            campoPeriodo.style.display = 'block';
        } else if (selecionado === 'hora_marcada') {
            campoHorario.style.display = 'block';
        }
    }
    if (radiosTipoTemporal.length > 0) {
        radiosTipoTemporal.forEach(radio => {
            radio.addEventListener('change', toggleCamposTemporais);
        });
        toggleCamposTemporais();
    }

    // --- Lógica para Formulário AJAX (Meta) ---
    const formMeta = document.getElementById('formulario-meta');
    if (formMeta) {
        formMeta.addEventListener('submit', function(evento) {
            evento.preventDefault();
            const dados = new FormData(this);
            const url = formMeta.action;
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
                    alert('Ocorreu um erro de comunicação.');
                });
        });
    }
    const pilarSelect = document.getElementById('meta-pilar');
    const categoriaSelect = document.getElementById('meta-categoria');
    const subcategoriaSelect = document.getElementById('meta-subcategoria');
    if (pilarSelect) {
        pilarSelect.addEventListener('change', function() {
            const pilarId = this.value;
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
                            categoriaSelect.add(new Option(categoria.nome, categoria.id));
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
                            subcategoriaSelect.add(new Option(subcategoria.nome, subcategoria.id));
                        });
                        subcategoriaSelect.disabled = false;
                    }
                });
        });
    }
    const botoesEditarMeta = document.querySelectorAll('.botao-editar-meta');
    const tituloModalMeta = document.getElementById('modal-meta-titulo');
    const botaoNovaMeta = document.getElementById('botao-nova-meta');
    if (botaoNovaMeta) {
        botaoNovaMeta.addEventListener('click', function() {
            tituloModalMeta.textContent = 'Nova Meta';
            formMeta.action = '/metas';
            formMeta.reset();
            document.getElementById('meta-id').value = '';
            categoriaSelect.innerHTML = '<option value="">Selecione uma Categoria...</option>';
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma Subcategoria...</option>';
            categoriaSelect.disabled = true;
            subcategoriaSelect.disabled = true;
        });
    }
    botoesEditarMeta.forEach(botao => {
        botao.addEventListener('click', async function() {
            const id = this.dataset.metaId;
            tituloModalMeta.textContent = 'Editar Meta';
            formMeta.action = `/metas/${id}/atualizar`;
            const resposta = await fetch(`/metas/${id}`);
            const resultado = await resposta.json();
            if (!resultado.sucesso) {
                alert(resultado.mensagem || 'Erro ao buscar dados da meta.');
                return;
            }
            const meta = resultado.dados;
            formMeta.querySelector('#meta-id').value = meta.id;
            formMeta.querySelector('#meta-nome').value = meta.nome;
            formMeta.querySelector('#meta-descricao').value = meta.descricao;
            formMeta.querySelector('#meta-data-inicio').value = meta.data_inicio;
            formMeta.querySelector('#meta-data-fim').value = meta.data_fim;
            pilarSelect.value = meta.pilar_id;
            await carregarCategorias(meta.pilar_id, meta.categoria_id);
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
    const botoesDeletarMeta = document.querySelectorAll('.botao-deletar-meta');
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

    // --- Lógica para Edição e Deleção de Tarefas ---
    const botoesEditarTarefa = document.querySelectorAll('.botao-editar-tarefa');
    const botoesDeletarTarefa = document.querySelectorAll('.botao-deletar-tarefa');
    const formTarefa = document.getElementById('formulario-tarefa');
    const tituloModalTarefa = document.getElementById('modal-tarefa-titulo');
    const botaoNovaTarefa = document.querySelector('[data-modal-alvo="modal-tarefa"]');
    if (botaoNovaTarefa) {
        botaoNovaTarefa.addEventListener('click', function() {
            tituloModalTarefa.textContent = 'Nova Tarefa';
            formTarefa.action = '/tarefas';
            formTarefa.reset();
            document.getElementById('tarefa-id').value = '';
            document.getElementById('tipo-arbitraria').checked = true;
            toggleCamposTemporais();
        });
    }
    botoesEditarTarefa.forEach(botao => {
        botao.addEventListener('click', async function() {
            const id = this.dataset.tarefaId;
            tituloModalTarefa.textContent = 'Editar Tarefa';
            formTarefa.action = `/tarefas/${id}/atualizar`;
            const resposta = await fetch(`/tarefas/${id}`);
            const resultado = await resposta.json();
            if (!resultado.sucesso) {
                alert(resultado.mensagem || 'Erro ao buscar dados da tarefa.');
                return;
            }
            const tarefa = resultado.dados;
            formTarefa.querySelector('#tarefa-id').value = tarefa.id;
            formTarefa.querySelector('#tarefa-meta').value = tarefa.meta_id;
            formTarefa.querySelector('#tarefa-nome').value = tarefa.nome;
            formTarefa.querySelector('#tarefa-data-execucao').value = tarefa.data_execucao;
            formTarefa.querySelector('#tarefa-duracao').value = tarefa.duracao;
            const radioTipo = formTarefa.querySelector(`input[name="tipo_temporal"][value="${tarefa.tipo_temporal}"]`);
            if(radioTipo) radioTipo.checked = true;
            toggleCamposTemporais();
            if(tarefa.tipo_temporal === 'periodo') {
                formTarefa.querySelector('#tarefa-periodo').value = tarefa.periodo;
            } else if (tarefa.tipo_temporal === 'hora_marcada') {
                formTarefa.querySelector('#tarefa-horario').value = tarefa.horario;
            }
        });
    });
    botoesDeletarTarefa.forEach(botao => {
        botao.addEventListener('click', function() {
            const id = this.dataset.tarefaId;
            if (confirm('Tem certeza que deseja deletar esta tarefa?')) {
                fetch(`/tarefas/${id}/deletar`, { method: 'POST' })
                    .then(r => r.json())
                    .then(res => {
                        if (res.sucesso) {
                            window.location.reload();
                        } else {
                            alert(res.mensagem || 'Erro ao deletar tarefa.');
                        }
                    });
            }
        });
    });

    // --- Lógica para Concluir Tarefa na Página do Dia ---
    const checkboxesTarefa = document.querySelectorAll('.checkbox-tarefa');
    checkboxesTarefa.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const tarefaId = this.id.split('-')[1];
            const url = `/tarefas/${tarefaId}/concluir`;
            const itemTarefa = this.closest('.item-tarefa-dia');
            fetch(url, { method: 'POST' })
                .then(resposta => resposta.json())
                .then(resultado => {
                    if (resultado.sucesso) {
                        if (resultado.novo_status === 'concluida') {
                            itemTarefa.classList.add('status-concluida');
                            itemTarefa.classList.remove('status-pendente');
                        } else {
                            itemTarefa.classList.remove('status-concluida');
                            itemTarefa.classList.add('status-pendente');
                        }
                    } else {
                        this.checked = !this.checked;
                        alert(resultado.mensagem || 'Erro ao atualizar tarefa.');
                    }
                })
                .catch(err => {
                    this.checked = !this.checked;
                    console.error('Erro de comunicação:', err);
                    alert('Erro de comunicação.');
                });
        });
    });

});
