<?php

use Classes\Session;

require_once '../inc/connection.php';
require_once '../App.php';

if($request->check($request->post("submit")) && $request->check($request->get("id"))){

    $id = $request->get("id");
    $title = $request->filter($request->post("title"));

    $validation->validate("title",$title,["Required","Str"]);
    $errors = $validation->getError();

    if (empty($errors) ) {

            $result = $conn->prepare("select `title` from todo where id=:id");
            $result->bindParam(":id",$id,PDO::PARAM_INT);
            $result->execute();
            $out = $result->fetch(PDO::FETCH_ASSOC);

            if($out){

                //update
                $result = $conn->prepare("update todo set title=:title where id=:id");
                $result->bindParam(":title",$title,PDO::PARAM_STR);
                $result->bindParam(":id",$id,PDO::PARAM_INT);
                $out = $result->execute();

                if($out){
                    Session::set("success","title updated successfully");
                    $request->redirect("../index.php");
                    exit();
                }else{
                    Session::set("errors",["error while updating"]);
                    $request->redirect("../edit.php?id=$id");
                    exit();
                }

            }else{
                Session::set("errors",["title not found"]);
                $request->redirect("../index.php");
                exit();
            }
    
    }else{

        Session::set("errors",$errors);
        $request->redirect("../edit.php?id=$id");
        exit();
    }

}
else {
    $request->redirect("../index.php");

}
