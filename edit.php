<?php
require_once 'inc/header.php';
?>

<?php 

require_once 'App.php';
require_once 'inc/connection.php';

if($request->check($request->get("id"))){

    $id = $request->get("id");
}else{
        $message = "not found";

}

$result = $conn->prepare("select `title` from todo where id=:id");
$result->bindParam(":id",$id,PDO::PARAM_INT);
$result->execute();
$title = $result->fetch(PDO::FETCH_ASSOC);

if(! count($title)>0){

    $message = "not found";
}


?>


<body class="container w-50 mt-5">
    <form action="handle/edit.php?id=" method="post">
            <textarea type="text" class="form-control"  name="title" id="" placeholder="enter your note here"><?= $title['title'] ?></textarea>
            <div class="text-center">
                <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Update</button>
            </div>  
    </form>
</body>
</html>