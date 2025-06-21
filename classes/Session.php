<?php

namespace Classes;

    class Session{

    public function __construct(){
        session_start();
    }


    public static function  set($key,$value){
        $_SESSION[$key] = $value;
    }
     public static function  get($key){
        if(isset($_SESSION[$key])){

            return $_SESSION[$key];
        }else{
            return false;
        }
    }

     public static function  remove($key){
        unset ($_SESSION[$key]);
    }

    public function destroy(){
        session_destroy();
    }



}