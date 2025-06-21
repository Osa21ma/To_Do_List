<?php

use Classes\Session;

require_once '../App.php';

if($request->check($request->post('submit'))){

    $title = $request->filter($request->post('title'));

    $validation->validate("title",$title,["required","str"]);
    $errors = $validation->getError();

    if($errors != false){

        Session::set("errors",$errors);
        $request->redirect("../index.php");

    }else {


    }



}else{
    $request->redirect("../index.php");
}