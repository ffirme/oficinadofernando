<?php

namespace App\Models;

use Core\MasterModel;

class CompanyModel extends MasterModel
{
    protected $table = "companies";
    
    public function rules()
    {
        return [
            'company' => 'required|email',
            'business' => 'min:30|max:300'
        ];
    }
}