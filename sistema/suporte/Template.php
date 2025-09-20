<?php

namespace sistema\suporte;

use Twig\Lexer;

use sistema\configuracoes\Helpers;

class Template
{

    //ATRIBUTO
    private \Twig\Environment $twig;


    //CONSTRUTOR
    public function __construct(string $diretorio_visao)
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio_visao);
        $this->twig = new \Twig\Environment($loader);

        $lexer = new Lexer($this->twig, array(
            $this->helpers()
        ));

        $this->twig->setLexer($lexer);
    }


    //METODOS
    public function renderizar(string $visao, array $dados)
    {
        return $this->twig->render($visao, $dados);
    }

    private function helpers(): void
    {
        // Função URL
        $this->twig->addFunction(
            new \Twig\TwigFunction('url', function (?string $url = null) {
                return Helpers::url($url);
            })
        );

        // Função obterImagem
        $this->twig->addFunction(
            new \Twig\TwigFunction('obterImagem', function (string $caminhoImagemBase) {
                return Helpers::obterImagem($caminhoImagemBase);
            })
        );
    }
}
