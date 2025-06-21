<?php

namespace Classes\Validation;

class Validation {

    private $errors =[];

    public function validate($key,$value,$roles){
        foreach($roles as $role){
            $role = "Classes\Validation\\".$role;
            $object =new $role;
            $out = $object->check($key,$value);
            if($out != false){
                $this->errors[]=$out;
            }
        }
    }

    public function getError(){
        return $this->errors;
    }
}