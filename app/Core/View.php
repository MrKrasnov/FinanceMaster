<?php

namespace App\Core;

class View
{
    public static string $errorPage = 'customError.php';
    public static string $layout = 'default';

    /**
     * Render the page for custom error
     * @param string $msgError
     * @return void
     */
    public static function renderErrorPage(string $msgError) : void
    {
        $path = '../app/views/errors/'.self::$errorPage;
        $title = 'Custom Error';
        (new self)->renderPage($title, $path);
    }

    /**
     * Render the page for code error
     * @param int $code
     * @return void
     */
    public static function renderErrorCodePage(int $code) : void
    {
        $path = '../app/views/errors/'.$code.'.php';
        (new self)->renderPage('error '.$code, $path);
    }

    private function renderPage(string $title, string $path): void
    {
        if (file_exists($path)) {
            ob_start();
            include $path;
            $content = ob_get_clean();
            require '../app/views/layouts/'.self::$layout.'.php';
        } else {
            require '../app/views/errors/unusualError.php';
        }
    }
}