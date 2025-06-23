<?php
use Classes\Session;

require_once '../inc/connection.php';
require_once '../App.php' ;

if($request->check($request->get("id"))){

    $id=$request->get("id");
    
    $result=$conn->prepare("select `title` from todo where id=:id");
    $result->bindParam(":id",$id,PDO::PARAM_INT);
    $result->execute();
    $title = $result->fetch(PDO::FETCH_ASSOC);

    if(count($title)>0){
        $result=$conn->prepare("delete from todo where id=:id");
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        $out = $result->execute();

        if($out){
            Session::set("success","deleted successfully");
            $request ->redirect("../index.php");

        }
      
    

    }else{
        Session::set("errors",["not found"]);
        $request->redirect("../index.php");
    }
}else{
    $request->redirect("../index.php");
}