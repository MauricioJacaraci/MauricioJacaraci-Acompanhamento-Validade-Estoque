<?php

namespace sistema\controladores\Principal;

use sistema\suporte\Template;

class Controlador
{
    //ATRIBUTO
    protected Template $template;


    //CONTRUTOR
    public function __construct(string $diretorio_visao)
    {
        $this->template = new Template($diretorio_visao);
    }
}
