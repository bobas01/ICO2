<?php

namespace App\Controller;

class InscriptionController extends Controller
{
    public function index()
    {   
        $currentPage = 'inscription';
        $pageTitle = "Inscription - ICO Board Game";
        $content = $this->render('inscription/index', compact('pageTitle'), true);
        $this->renderLayout($content, $currentPage);
    }
}