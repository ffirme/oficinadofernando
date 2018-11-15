<?php

namespace Core;

class Validator {

    public static function make(array $data, array $rules) {
        $errors = null;
        foreach ($rules as $ruleKey => $ruleValue) {
            if (strpos($ruleValue, ":")) {
                $items = explode(":", $ruleValue);
                foreach ($data as $dataKey => $dataValue) 
                {
                    if($ruleKey == $dataKey)
                    {
                        switch ($items[0]) {
                            case 'min':
                                if(strlen($dataValue) < $items[1])
                                {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve ter um mínimo de {$items[1]} caracteres.";
                                }
                                break;
                            case 'max':
                                if(strlen($dataValue) > $items[1])
                                {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve ter um máximo de {$items[1]} caracteres.";
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            } else {


                foreach ($data as $dataKey => $dataValue) {
                    if ($ruleKey == $dataKey) {
                        switch ($ruleValue) {
                            case 'required':
                                if ($dataValue == '' || empty($dataValue)) {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve ser preenchido";
                                }
                                break;
                            case 'email':
                                if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} não é válido";
                                }
                                break;
                            case 'float':
                                if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT)) {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve conter número decimal";
                                }
                                break;
                            case 'int':
                                if (!filter_var($dataValue, FILTER_VALIDATE_INT)) {
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve conter número inteiro";
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }
        if ($errors) {
            Session::set('errors', $errors);
            Session::set('inputs', $data);
            return true;
        } else {
            Session::destroy(['errors', 'inputs']);
            return false;
        }
    }

}
