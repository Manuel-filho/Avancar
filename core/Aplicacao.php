<?php

namespace App\Core;

class Aplicacao {
    // Armazena a instância do roteador
    private Roteamento $roteamento;
    // Armazena a instância da requisição
    private Requisicao $requisicao;
    // Armazena a instância da resposta
    private Resposta $resposta;

    // Inicializa as classes do núcleo da aplicação
    public function __construct(Roteamento $roteamento, Requisicao $requisicao, Resposta $resposta) {
        $this->roteamento = $roteamento;
        $this->requisicao = $requisicao;
        $this->resposta = $resposta;
    }

    // Executa o ciclo de vida da requisição
    public function executar(): void {
        $metodo = $this->requisicao->metodo();
        $uri = $this->requisicao->uri();

        $acao = $this->roteamento->encontrar($metodo, $uri);

        if ($acao) {
            $conteudo = call_user_func($acao);
            $this->resposta->enviar($conteudo);
        } else {
            $this->resposta->definirCodigo(404);
            $this->resposta->enviar("Página não encontrada.");
        }
    }
}
