<?php 

use Classes\Session;
require_once 'inc/header.php';
require_once 'inc/connection.php';
?>
<body>
    
    <div class="container my-3 ">    
        <div class="row d-flex justify-content-center">
               
                <div class="container mb-5 d-flex justify-content-center">
                    <div class="col-md-4">
                        <?php
                        if (Session::get("errors")) {
                            
                            foreach(Session::get("errors") as $error) {
                            
                            ?>

                            <div class="alert alert-danger"> <?= $error ?></div>
                        <?php } }
                        
                        Session::remove("errors");
                        
                        ?>
                        <form action="handle/addToDo.php" method="post">
                        <textarea type="text" class="form-control" rows="3" name="title" id="" placeholder="enter your note here"></textarea>
                        <div class="text-center">
                            <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Add To Do</button>
                        </div>
                        </form>
                    </div>
                </div>
               

        </div>
        <div class="row d-flex justify-content-between">   
            <!-- all -->
            <div class="col-md-3 "> 
                <h4 class="text-white">All Notes</h4>

                
                <div class="m-2  py-3">
                    <div class="show-to-do">


                    <?php 
                    
                        $result = $conn->query("select * from todo where status='all' order by id desc");
                        $allnotes = $result->fetchAll(PDO::FETCH_ASSOC);
                        if(count($allnotes)>0){
                            
                            foreach($allnotes as $all){
                            
                            
                            ?>

                                <div class="alert alert-info p-2">
                                    <h4 ><?= $all['title'] ?></h4>
                                    <h5><?= $all['created_at'] ?></h5>
                                    <div class="d-flex justify-content-between mt-3">
                                    <a href="edit.php?id=<?= $all['id']?>"class="btn btn-info p-1 text-white" >edit</a>
                                   
                                    <a href="handle/goto.php?status=doing&id=<?= $all['id'] ?>"class="btn btn-info p-1 text-white" >doing</a>
                                </div>
                            
                        </div>

                        <?php }}
                        else{ ?>


                                <div class="item">
                                    <div class="alert-info text-center ">
                                    empty to do
                                    </div>
                                </div>
                        <?php }
                    
                    
                    
                    ?>

                          
                    

                    </div>
                </div>

            </div>

            <!-- doing -->
            <div class="col-md-3 ">
            
                <h4 class="text-white">Doing</h4>

                
                <div class="m-2 py-3">
                    <div class="show-to-do">

                    <?php
                    
                        $result = $conn->query("select * from todo where status='doing' order by id desc");
                        $allnotes = $result->fetchAll(PDO::FETCH_ASSOC);
                        if(count($allnotes)>0){
                            
                            foreach ($allnotes as  $doing) {
                                
                            
                            
                            ?>
                                 <div class="alert alert-success p-2">
                                    <h4 ><?=$doing['title']?></h4>
                                    <h5><?=$doing['created_at']?></h5>
                                    <div class="d-flex justify-content-between mt-3">
                                    <a></a>
                                    <a href="handle/goto.php?status=done&id=<?= $doing['id'] ?>"class="btn btn-success p-1 text-white" >Done</a>
                                </div>
                            
                        </div>



                        <?php }} else{ ?>
                                <div class="item">
                                    <div class="alert-success text-center ">
                                    empty to do
                                    </div>
                                </div>



                        <?php }
      
                    ?>

                   
                         
                    

                    </div>
                </div>
            
            </div>
           
            <!-- done -->
            <div class="col-md-3">
                <h4 class="text-white">Done</h4>

                <div class="m-2 py-3">
                    <div class="show-to-do">

                               <?php
                    
                        $result = $conn->query("select * from todo where status='done' order by id desc");
                        $allnotes = $result->fetchAll(PDO::FETCH_ASSOC);
                        if(count($allnotes)>0){
                            
                            foreach($allnotes as $done){
                            
                            ?>
                            
                                    <div class="alert alert-warning p-2">
                                    <a href="handle/delete.php?id=<?=$done['id']?>" onclick="confirm('are your sure')"  class="remove-to-do text-dark d-flex justify-content-end " ><i class="fa fa-close" style="font-size:16px;"></i></a>                                                                
                                    <h4 ><?=$done['title']?></h4>
                                    <h5><?=$done['created_at']?></h5>
                                
                            
                        </div>
                            
                       <?php }}else{?>


                                <div class="item">
                                    <div class="alert-warning text-center ">
                                    empty to do
                                    </div>
                                </div>

                        <?php }
                        
                        
                        
                        ?>


                          
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>