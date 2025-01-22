<?php

namespace App\Controller;

class BackofficeController extends Controller
{
    protected function renderLayoutBackoffice($content)
    {
        include "pages/layoutbackoffice.php";
    }
    public function index()
    {   
        $pageTitle = "Backoffice - ICO Board Game";
        $content = $this->render('backoffice/index', compact('pageTitle'), true);
        $this->renderLayoutBackoffice($content);
    }
}