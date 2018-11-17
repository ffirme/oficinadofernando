<?php

namespace Core;

class MasterController
{    
    protected $view;
    protected $errors;
    protected $inputs;
    protected $success;
    private $viewName;
    private $layoutName;
    private $pageTitle = null;
    
    public function __construct() {
        $this->view = new \stdClass;
        if(Session::get('errors')){
            $this->errors = Session::get('errors');
            Session::destroy('errors');
        }
        if(Session::get('inputs')){
            $this->inputs = Session::get('inputs');
            Session::destroy('inputs');
        }
        if(Session::get('success')){
            $this->success = Session::get('success');
            Session::destroy('success');
        }
    }
    
    protected function render($viewName, $layoutName = null){
        $this->viewName = $viewName;
        $this->layoutName = $layoutName;
        if($layoutName){
            return $this->layout();
        }else{
            return $this->content();
        }        
    }

    protected function content(){
        if(file_exists(__DIR__ . "/../app/Views/{$this->viewName}.html")){
            return require_once __DIR__ . "/../app/Views/{$this->viewName}.html";
        }else{
            echo "View não encontrada!";
        }
    }
    
    protected function layout(){
        if(file_exists(__DIR__ . "/../app/Views/{$this->layoutName}.html")){
            return require_once __DIR__ . "/../app/Views/{$this->layoutName}.html";
        }else{
            echo "Layout não encontrada!";
        }
    }
    
    protected function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    protected function getPageTitle($separator = null)
    {
        if($separator){
            return $this->pageTitle . " " . $separator . " ";
        }else{
            return $this->pageTitle;
        }
    }

    public function forbidden()
    {
        return Redirect::route('/login');
    }
    
    public static function newController($controller)
    {
        $objController = "App\\Controllers\\" . $controller;
        return new $objController;
    }

    public static function getModel($model)
    {
        $objModel = "\\App\\Models\\" . $model;
        return new $objModel(DataBase::getDatabase());
    }

    public static function pageNotFound(){
        if (file_exists(__DIR__ . "/public/404.html")){
            return require_once __DIR__ . "/public/404.html";
        }else{
            echo "Page not found!";
        }
    }
    
    public static function redirect($url, $msg = []){
        if(count($msg) > 0)
            foreach ($msg as $key => $value)
                Session::set ($key, $value);
                
                
        return header("location:$url");
    }
}
