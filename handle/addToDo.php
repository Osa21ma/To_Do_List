<?php

use Classes\Session;

require_once '../App.php';
require_once '../inc/connection.php';

if($request->check($request->post('submit'))){

    $title = $request->filter($request->post('title'));

    $validation->validate("title",$title,["required","str"]);
    $errors = $validation->getError();

    if($errors != false){

        Session::set("errors",$errors);
        $request->redirect("../index.php");

    }else {
        $result = $conn->prepare("Insert into todo(`title`) values(:title)");
        $result->bindParam(":title",$title,PDO::PARAM_STR);
        $out = $result->execute();

        if($out){
            Session::set("success","title create");
            $request->redirect("../index.php");
        }else{
             Session::set("errors",["error while insert"]);
             $request->redirect("../index.php");
        }

    }



}else{
    $request->redirect("../index.php");
}