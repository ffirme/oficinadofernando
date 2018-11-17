<?php

namespace App\Models;

use Core\MasterModel;

class UserModel extends MasterModel{
    
    protected $table = "users";
    protected $fillable = ['name', 'email', 'password'];
    
    public function rulesCreate()
    {
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:UserModel:email',
            'password' => 'min:6|max:16'
        ];
    }
    
    public function rulesUpdate($id)
    {
        return [
            'name' => 'min:4|max:255',
            'email' => "email|unique:UserModel:email:$id",
            'password' => 'min:6|max:16'
        ];
    }
     
}
