<?php

namespace sistema\modelo;

use sistema\configuracoes\Conexao;
use sistema\configuracoes\Modelos;

class Tab_Categoria_Produtos extends Modelos
{




    public function __construct()
    {
        parent::__construct('cadastro_produtos');
    }






    public function cadastrarProduto(array $produto): void
    {

        $query = "INSERT INTO cadastro_produtos (produto, data_validade) 
                  VALUES (:nome, :data_validade)";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindParam(':nome', $produto['produto'], \PDO::PARAM_STR);
        $stmt->bindParam(':data_validade', $produto['validade'], \PDO::PARAM_STR);
        $stmt->execute();
    }


    public function excluirProduto(int $id): void
    {
        $query = "DELETE FROM cadastro_produtos WHERE id = :id";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }



}
