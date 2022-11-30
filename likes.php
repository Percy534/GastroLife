<?php 

require 'db.php';
    
if(isset($_GET)){
    $data = $database->select("tb_recipes", "*",[
        "id_recipe" => $_GET["id"]
    ]);

    $likes = $data[0]["recipe_likes"];
    $likes++;

    $database->update("tb_recipes",[
        "recipe_likes" => $likes
    ],[
        "id_recipe" => $_GET["id"]
    ]);

    header("location: registro-recetas.php");

}

?>