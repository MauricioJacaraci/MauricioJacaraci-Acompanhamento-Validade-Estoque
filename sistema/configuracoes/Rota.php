<?php

use Pecee\SimpleRouter\SimpleRouter;

try {
   // Grupo de rotas do Cliente
   SimpleRouter::group(['namespace' => 'sistema\controladores\PainelAdministrativo'], function () {

      
      // ----------------------------------------------------------
      SimpleRouter::get(URL_SITE, 'SiteControlador@index');
      SimpleRouter::get(URL_SITE . 'index', 'SiteControlador@index');
      // ----------------------------------------------------------
      //ROTA DE CADASTRAR PRODUTO
      SimpleRouter::post(URL_SITE . 'cadastrarProduto', 'SiteControlador@cadastrarProduto');
      // ----------------------------------------------------------
      //ROTA DE EXCLUIR PRODUTO
      SimpleRouter::match(['get', 'post'], URL_SITE . 'produtoExcluir/{id}', 'SiteControlador@excluirProduto');
      // ----------------------------------------------------------
      //ROTA DE ATUALIZAR QUANTIDADE
      SimpleRouter::post(URL_SITE . 'quantidade/atualizar', 'SiteControlador@atualizarQuantidade');
      // ----------------------------------------------------------
      //ROTA DE VERIFICAR VALIDADE
      SimpleRouter::post(URL_SITE . 'verificarValidade', 'SiteControlador@verificarValidade');
      // ----------------------------------------------------------
   });

   // Executa o direcionamento das rotas
   SimpleRouter::start();
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {

   // Mostra a mensagem de erro para debug
   echo $ex->getMessage();
}
