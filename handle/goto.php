<?php

use Classes\Session;
require_once '../inc/connection.php';
require_once '../App.php';

if ($request->check($request->get("status")) && $request->check($request->get("id"))) {
    $id = $request->get("id");
    $status = $request->get("status");
     
    $updateQuery= $conn->prepare("select title from todo where id=:id");
    $updateQuery->bindParam(":id",$id);
    $updateQuery->execute();
    if($updateQuery->rowCount()==1){




        $result = $conn->prepare("UPDATE todo SET `status` = :status WHERE id = :id");
        $result->bindParam(":status", $status);
        $result->bindParam(":id", $id);
        $out = $result->execute();

        if ($out) {
            Session::set("success", "status updated successfully");
            header("location: ../index.php");
            exit();
        } else {
            Session::set("errors", ["Error while update status"]);
            header("location: ../edit.php?id=$id");
            exit();
        }

    }else{
        Session::set("errors",["todo not found"]);
        $request->redirect("../index.php");
    }

    
}else{
    $request->redirect("../index.php");
}