<?php

namespace sistema\configuracoes;

use Exception;

class Helpers
{


    public static function redirecionar(?string $url = null): void
    {
        header('HTTP/1.1 302 Found');

        // Pega a url base que foi atribuida na função "url()" e junta com o parametro passado acima
        $local = ($url ? self::url($url) : self::url());

        // Envia a nova url para o navegador
        header("Location: {$local} ");
        exit();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    public static function urlL(?string $url = null): string
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
        //$servidor = filter_input(INPUT_SERVER, 'HTTP_HOST');

        $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

        if (str_starts_with($url, '/')) {
            return $ambiente . $url;
        }

        return $ambiente . '/' . $url;
    }
    public static function url(?string $url = null): string
    {
        //$servidor = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

        $ambiente = ($servidor === 'localhost' ? rtrim(URL_DESENVOLVIMENTO, '/') : rtrim(URL_PRODUCAO, '/'));

        if ($url) {
            $url = ltrim($url, '/');
            return $ambiente . '/' . $url;
        }

        return $ambiente;
    }
    public static function obterImagem(string $caminhoImagemBase): string
    {
        $extensoes = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        foreach ($extensoes as $ext) {
            $imagemComExtensao = $caminhoImagemBase . '.' . $ext;
            if (file_exists($imagemComExtensao)) {
                return self::url($imagemComExtensao);
            }
        }

        return self::url('sistema/Template/SiteCliente/assets/imagens/imagemPadrao.png');
    }


    ////////////////////////////////////////////////////////////////////////////////////////////

    public static function slug(string $string): string
    {
        // Mapa de caracteres com acento para sem acento
        $mapa['a'] = "ÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇÑáàâãäéèêëíìîïóòôõöúùûüçñ0123456789!#$%&'()*+,-./:;<=>?@[\]^_`{|}~§ªº°¨´`˜¹²³¼½¾¬¯¸¿¡«»×÷       ";
        $mapa['b'] = "aaaaaaaaeeeeiiiiooooouuuucnaaaaaeeeeiiiiooooouuuucn0123456789------------------------------------";

        // Substitui os caracteres com acento por suas versões sem acento
        $slug = strtr($string, $mapa['a'], $mapa['b']);

        // Remove tags HTML e espaços extras
        $slug = strip_tags(trim($slug));

        // Substitui os espaços por hífens
        $slug = str_replace(' ', '-', $slug);

        // Remove múltiplos hífens consecutivos e os converte para um único
        $slug = preg_replace('/-+/', '-', $slug);

        // Retorna o slug em minúsculas
        return strtolower($slug);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public static function validarCPF(string $cpf): bool
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            throw new Exception('O CPF deve conter 11 dígitos.');
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            throw new Exception('O CPF não pode ter todos os dígitos iguais.');
        }

        // Valida o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += ($cpf[$i] * (10 - $i));
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        if ($cpf[9] != $digito1) {
            throw new Exception('O primeiro dígito verificador do CPF está incorreto.');
        }

        // Valida o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += ($cpf[$i] * (11 - $i));
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        return ($cpf[10] == $digito2);
    }
    public static function formatarMoedaBR(float $valor): string
    {
        return number_format($valor, 2, ',', '.');
    }
}
