<?php

namespace App\Controllers;

use Core\MasterController;

class HomeController extends MasterController
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index(){
        $this->setPageTitle('eSocial');
        $this->render('home/index', 'layout');
    }
}
