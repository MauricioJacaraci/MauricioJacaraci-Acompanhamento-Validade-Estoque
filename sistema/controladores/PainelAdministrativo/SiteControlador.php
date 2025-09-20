<?php

namespace sistema\controladores\PainelAdministrativo;

use sistema\controladores\Principal\Controlador;
use sistema\modelo\Tab_Categoria_Produtos;
use sistema\configuracoes\Helpers;

class SiteControlador extends Controlador
{

    // =====================================================
    // CONSTRUTOR
    // =====================================================
    public function __construct()
    {
        parent::__construct('sistema/template/painel/views');
    }
   

    



    // Página inicial (login)
    public function index()
    {

        
        $resultado = (new Tab_Categoria_Produtos())->buscarTodas()->ordem('data_validade ASC')->resultado(true);

        if($resultado){
            foreach ($resultado as $key => $value) {
                $resultado[$key]['dias_restantes'] = (strtotime($value['data_validade']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
            }
        }

        echo $this->template->renderizar('index.html', [
            'nome_pagina' => 'Dashboard - ' . NOME_SITE,
            'rota_atual' => 'index',
            'produtos' => $resultado,

        ]);
    }


    public function cadastrarProduto()
    {
        $produto = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($produto && isset($produto['produto']) && isset($produto['validade'])) {
            $tabCategoriaProdutos = new Tab_Categoria_Produtos();
            $tabCategoriaProdutos->cadastrarProduto($produto);

        }
        Helpers::redirecionar('index');

    }


    // Exclui um produto pelo ID
    public function excluirProduto(int $id)
    {
        (new Tab_Categoria_Produtos())->excluirProduto($id);
        
        Helpers::redirecionar('index');
    }
    





}
