<?php

namespace sistema\configuracoes;

use PDO;
use PDOException;

class Conexao
{
    // ATRIBUTO ESTÁTICO PARA GUARDAR A INSTÂNCIA DO PDO
    private static PDO $instancia;

    /**
     * MÉTODO ESTÁTICO RESPONSÁVEL POR RETORNAR UMA INSTÂNCIA ÚNICA DE CONEXÃO
     * Implementa o padrão Singleton para garantir que só exista uma conexão com o banco de dados.
     */
    public static function getInstancia(): PDO
    {
        // Verifica se a conexão já foi criada
        if (empty(self::$instancia)) {
            try {
                // Cria uma nova conexão PDO utilizando constantes definidas no sistema
                self::$instancia = new PDO(
                    "mysql:host=" . DB_SERVIDOR . ";port=" . DB_PORTA . ";dbname=" . DB_NOME_DO_BANCO,
                    DB_USUARIO,
                    DB_SENHA,
                    [
                        // Configura o PDO para lançar exceções em caso de erro
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                        // Define que os dados retornados devem ser objetos (em vez de arrays)
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,

                        // Mantém o nome das colunas conforme estão no banco (sem converter para maiúsculas/minúsculas)
                        PDO::ATTR_CASE => PDO::CASE_NATURAL
                    ]
                );
            } catch (PDOException $e) {
                // Exibe mensagem de erro e encerra a execução caso ocorra falha na conexão
                die("Erro ao conectar ao banco de dados:: " . $e);
            }
        }

        // Retorna a instância existente (ou recém-criada)
        return self::$instancia;
    }

    /**
     * Construtor protegido para impedir que a classe seja instanciada diretamente.
     * Garante que o acesso à conexão seja feito apenas pelo método estático getInstancia().
     */
    protected function __construct() {}

    /**
     * Método clone privado para impedir que o objeto seja clonado.
     * Parte do padrão Singleton.
     */
    private function __clone(): void {}
}
