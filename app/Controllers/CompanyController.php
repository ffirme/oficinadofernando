<?php

namespace App\Controllers;

use Core\MasterController;
use Core\Session;
use Core\Validator;

class CompanyController extends MasterController{
    
    private $company;

    public function __construct() {
        parent::__construct();
        $this->company = MasterController::getModel('CompanyModel');
    }

    public function index()
    {
        $this->setPageTitle('Companies');
        $this->view->companies = $this->company->All();
        $this->view->page = 'Página Companies do eSocial';
        return $this->render('company/index', 'layout');
    }
    
    public function show($id)
    {
        $this->view->companies = $this->company->find($id);
        $this->setPageTitle("{$this->view->companies->company}");
        return $this->render('company/show', 'layout');
    }
    
    public function create()
    {
        $this->setPageTitle("New Company");
        return $this->render('company/create', 'layout');
    }
    
    public function store($request)
    {
        $request->post->status = "active";
        $data = [
            'company' => $request->post->company,
            'business' => $request->post->business,
            'status' => $request->post->status
        ];
        
        if(Validator::make($data,  $this->company->rules()))
        {
            return MasterController::redirect('/company/create');
        }        
        
        try{
            $this->company->create($data);
            return MasterController::redirect('/companies', [
                'success' => ['Company criada com sucesso.']
            ]);
        } catch (\Exception $ex) {
            return MasterController::redirect('/companies', [
                'errors' => [$e->getMessage()]
            ]);
        }
//        if($this->company->create($data)){
//            return MasterController::redirect('/companies');            
//        }else{
//            return MasterController::redirect('/companies', [
//                'errors' => ['Erro ao inserir no banco de dados!']
//            ]);
//        }
    }
    
    public function edit($id)
    {   
        $this->view->company = $this->company->find($id);
        $this->setPageTitle('Edit Post - ' . $this->view->company->company);
        return $this->render('company/edit', 'layout');
    }
    
    public function update($id, $request){
        $data = [
            'company' => $request->post->company,
            'business' => $request->post->business
        ];        
        if(Validator::make($data, $this->company->rules()))
        {
            return MasterController::redirect("/company/{$id}/edit");
        }
        try{
           $this->company->update($data, $id);
           return MasterController::redirect('/companies', [
               'success' => ['Atualizado com sucesso.']
           ]);
        } catch (\Exception $ex) {
            return MasterController::redirect('/companies', [
                'errors' => [$e->getMessage()]
            ]);
        }
//        if($this->company->update($data, $id)){
//            return MasterController::redirect('/companies', [
//                'success' => ['Company atualizado com sucesso!']
//            ]);
//        }else{
//            return MasterController::redirect('/companies', [
//                'errors' => ['Erro ao atualizar!']
//            ]);
//        }
    }
    
    public function delete($id){
        try{
            $this->company->delete($id);
            return MasterController::redirect('/companies', [
                'success' => ['Company excluída com sucesso.']
            ]);
        } catch (\Exception $ex) {
            return MasterController::redirect('/companies', [
                'errors' => [$e->getMessage()]
            ]);
        }
//        if($this->company->delete($id)){
//            return MasterController::redirect('/companies');
//        }else{
//            return MasterController::redirect('/companies', [
//                'errors' => ['Erro ao excluir!']
//            ]);
//        }
    }
}
