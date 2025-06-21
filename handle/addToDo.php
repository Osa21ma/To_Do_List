<?php

require_once '../App.php';

if($request->check($request->post('submit'))){

    $title = $request->filter($request->post('title'));

    $validation->validate("title",$title,["required","str"]);
    $validation->getError();



}else{
    $request->redirect("../index.php");
}