<?php

namespace App\Controllers;

use Core\MasterController;
use Core\Validator;

class UserController extends MasterController
{
    private $user;

    public function __construct() {
        parent::__construct();
        $this->user = MasterController::getModel('UserModel');
    }

        public function create()
    {
        $this->setPageTitle('New User');
        return $this->render('user/create', 'layout');
    }
    
    public function store($request)
    {
        $data = [
            'name' => $request->post->name,
            'email' => $request->post->email,
            'password' => $request->post->password
        ];
        
        if(Validator::make($data, $this->user->rules()))
        {
            return MasterController::redirect('/user/create');
        }
        
        $data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);
        
        try{
            $this->user->create($data);
            return MasterController::redirect('/', [
                'success' => ['Usuário criado com sucesso.']
            ]);
        } catch (\Exception $ex) {
            return MasterController::redirect('/', [
                'errors' => [$e->getMessage()]
            ]);
        }
    }
}
