<?php

namespace sistema\modelo;

use sistema\configuracoes\Conexao;
use sistema\configuracoes\Modelos;

class Tab_Produtos extends Modelos
{




    public function __construct()
    {
        parent::__construct('cadastro_produtos');
    }






    public function cadastrarProduto(array $produto): void
    {

        $query = "INSERT INTO cadastro_produtos (produto, data_validade, quantidade) VALUES (:produto, :data_validade, :quantidade)";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindValue(':produto', $produto['produto'], \PDO::PARAM_STR);
        $stmt->bindValue(':data_validade', $produto['validade'], \PDO::PARAM_STR);
        $stmt->bindValue(':quantidade', $produto['quantidade'] ?? 0, \PDO::PARAM_INT); // 0 se não vier
        $stmt->execute();
    }


    public function excluirProduto(int $id): void
    {
        $query = "DELETE FROM cadastro_produtos WHERE id = :id";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function atualizarQuantidade(int $id, int $quantidade): void
    {
        $query = "UPDATE cadastro_produtos SET quantidade = :quantidade WHERE id = :id";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindParam(':quantidade', $quantidade, \PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }



}
