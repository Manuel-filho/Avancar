<?php

namespace App\Controladores;

use App\Modelos\Usuario;

class AutenticacaoControlador {

    // Redireciona o usuário para uma URL
    private function redirecionar(string $url): void {
        header('Location: ' . URL_BASE . $url);
        exit();
    }

    // Exibe a página de login
    public function login(): string {
        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/paginas/login.php';
        return ob_get_clean(); // Retorna como string para ser usada em um layout de autenticação
    }

    // Exibe a página de registo
    public function registo(): string {
        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/paginas/registo.php';
        return ob_get_clean();
    }

    // Processa a tentativa de registo
    public function registar() {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmar_senha = $_POST['confirmar_senha'] ?? '';

        if ($senha !== $confirmar_senha) {
            // TO-DO: Adicionar mensagens de erro na sessão (flash messages)
            $this->redirecionar('/registo');
            return;
        }

        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = $senha;

        if (Usuario::buscarPorEmail($email)) {
            // TO-DO: Adicionar mensagem de erro (email já existe)
            $this->redirecionar('/registo');
            return;
        }

        if ($usuario->criar()) {
            $this->redirecionar('/login');
        } else {
            // TO-DO: Adicionar mensagem de erro
            $this->redirecionar('/registo');
        }
    }

    // Processa a tentativa de login
    public function entrar() {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuario = Usuario::buscarPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario->senha)) {
            // TO-DO: Adicionar mensagem de erro (credenciais inválidas)
            $this->redirecionar('/login');
            return;
        }

        // Armazena informações do usuário na sessão
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;

        $this->redirecionar('/pilares'); // Redireciona para a página principal após o login
    }

    // Realiza o logout do usuário
    public function sair() {
        session_unset();
        session_destroy();
        $this->redirecionar('/login');
    }
}
