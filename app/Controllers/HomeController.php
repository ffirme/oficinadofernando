<?php

namespace App\Controllers;

use Core\MasterController;

class HomeController extends MasterController
{
    public function index(){
        $this->setPageTitle('Index');
        $this->view->page = 'Página Index do eSocial';
        $this->render('home/index', 'layout');
    }
}
