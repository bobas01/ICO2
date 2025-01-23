<?php

namespace App\Controller;

use App\Model\CardModel;

class BackofficeController extends Controller
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = new CardModel();
    }

    protected function renderLayoutBackoffice($content)
    {
        include "pages/layoutbackoffice.php";
    }

    public function index()
    {
        $pageTitle = "Backoffice - ICO Board Game";
        $cards = $this->cardModel->getAllCards();
        $content = $this->render('backoffice/index', ['cards' => $cards, 'pageTitle' => $pageTitle], true);
        $this->renderLayoutBackoffice($content);
    }
}