<?php 

require 'db.php';

$database->delete("tb_recipes", [
    "id_recipe"=>$_POST["id"]
]);



    header("location: registro-recetas.php");


?>