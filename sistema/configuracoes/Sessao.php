<?php

// Define o namespace para organizar melhor o código e evitar conflitos com outras classes
namespace sistema\Configuracoes;

// Classe responsável por manipular a sessão de forma encapsulada
class Sessao
{
    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }

    public function criar(string $chave, mixed $valor): Sessao
    {
        $_SESSION[$chave] = (is_array($valor) ? (object) $valor : $valor);
        return $this;
    }
   
    public function carregar(): ?object
    {
        return  (object) $_SESSION;
    }

    public function limpar(string $chave): Sessao
    {
        if (isset($_SESSION[$chave])) {
            unset($_SESSION[$chave]);
        }
        return $this;
    }

    public function checar(string $chave): bool
    {
        return isset($_SESSION[$chave]);
    }

    public function deletar(): Sessao
    {
        session_destroy();
        return $this;
    }
}
