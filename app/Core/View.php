<?php

namespace App\Core;

class View
{
    public string $viewPage;

    public function __construct(string $viewPage)
    {
        $pathToViewPage = "../app/views/pages/$viewPage.php";

        if (!file_exists($pathToViewPage)) {
            self::renderErrorCodePage(404);
        }

        $this->viewPage = $pathToViewPage;
    }

    public function renderPage(string $title, $vars): void
    {
        if (!file_exists($this->viewPage)) {
            self::renderErrorCodePage(404);
            exit();
        }

        ob_start();
        include $this->viewPage;
        $content = ob_get_clean();
        require '../app/views/layouts/default.php';
        exit();
    }

    /**
     * Render the page for code error
     * @param int $code
     * @return void
     */
    public static function renderErrorCodePage(int $code) : void
    {
        $path = "../app/views/errors/$code.php";
        $title = $code;

        if (!file_exists($path)) {
            self::renderErrorPage('It\'s error code '.$code.' but not found error page');
            exit();
        }

        ob_start();
        include $path;
        $content = ob_get_clean();
        require '../app/views/layouts/default.php';
        exit();
    }

    /**
     * Render the page for custom error
     * @param string $msgError
     * @return void
     */
    public static function renderErrorPage(string $msgError) : void
    {
        $path = "../app/views/errors/unusualError.php";
        $title = "$msgError Error";

        ob_start();
        include $path;
        $content = ob_get_clean();
        require '../app/views/layouts/default.php';
        exit();
    }
}