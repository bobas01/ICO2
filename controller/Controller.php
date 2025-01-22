<?php

namespace App\Controller;

class Controller
{
    protected function render($view, $data = [], $returnContent = false)
    {
        extract($data);
        ob_start();
        include "pages/$view.php";
        $content = ob_get_clean();
        if ($returnContent) {
            return $content;
        } else {
            echo $content;
        }
    }

    protected function renderLayout($content, $currentPage)
    {
        include "pages/layout.php";
    }

    public function renderPage($view, $pageTitle)
    {
        $currentPage = '';
        $content = $this->render($view, compact('pageTitle'), true);
        $this->renderLayout($content, $currentPage);
    }

    // Méthode pour vérifier le rôle d'administrateur
    protected function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }
}
