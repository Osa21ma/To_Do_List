<?php

use Classes\Session;

require_once 'inc/header.php';
?>

<?php 

require_once 'App.php';
require_once 'inc/connection.php';

if($request->check($request->get("id"))){

    $id = $request->get("id");
}else{
    $request->redirect("../index.php");

}

$result = $conn->prepare("select `title` from todo where id=:id");
$result->bindParam(":id",$id,PDO::PARAM_INT);
$result->execute();
$title = $result->fetch(PDO::FETCH_ASSOC);

if(! count($title)>0){

    $request->redirect("../index.php");

}


?>


<body class="container w-50 mt-5">

                            <?php
                        if (Session::get("errors")) {
                            
                            foreach(Session::get("errors") as $error) {
                            
                            ?>

                            <div class="alert alert-danger"> <?= $error ?></div>
                        <?php } }
                        
                        Session::remove("errors");
                        
                        ?>

    <form action="handle/edit.php?id=<?= $id ?>" method="post">
            <textarea type="text" class="form-control"  name="title" id="" placeholder="enter your note here"><?= $title['title'] ?></textarea>
            <div class="text-center">
                <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Update</button>
            </div>  
    </form>
</body>
</html>