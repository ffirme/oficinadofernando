<?php

namespace App\Models;

use Core\MasterModel;

class CompanyModel extends MasterModel
{
    protected $table = "companies";
    protected $fillable = ['company', 'business'];


    public function rules()
    {
        return [
            'company' => 'min:2|max:30',
            'business' => 'max:255'
        ];
    }
}