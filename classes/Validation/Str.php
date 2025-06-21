<?php

namespace Classes\Validation;

use Classes\Validation\Validator;
class Str implements Validator{

    public function check($key,$value){

        if(is_numeric($value)){
            return "$key must be string";
        }else
        {
            return false;
        }
    }
}