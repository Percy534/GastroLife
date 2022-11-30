<?php
require 'db.php';

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $randomString;
    }

    //$file_name = $_FILES["recipe_image"]["name"];
    //echo $file_name

    $data = $database->select("tb_recipes", "*", [
        "id_recipe" => $_POST["id"]
    ]);

    if($_FILES["recipe_image"]["name"] == ""){
        //echo "no files";
        $img = $data[0]["recipe_image"];
    } else {
        //echo "files";
            if(isset($_FILES["recipe_image"])){
                $error = array();
                $file_name = $_FILES["recipe_image"]["name"];
                $file_size = $_FILES["recipe_image"]["size"];
                $file_tmp = $_FILES["recipe_image"]["tmp_name"];
                $file_type = $_FILES["recipe_image"]["type"];
                $file_ext_arr = explode(".", $_FILES["recipe_image"]["name"]); //explote descompone el string
    
                $file_ext = end($file_ext_arr);
                $img_ext = array("jpeg","png", "jpg", "gif");
    
                if(!in_array($file_ext, $img_ext)){
                    $errors[] = "File type is not supported";
                }
    
                if(empty($errors)){
                    $img = "recipe-upload-".generateRandomString().".".$file_ext;//genera el nombre
                    move_uploaded_file($file_tmp, "images/".$img);

                }
    
    
            }

    }

    $ingredients = "";
            foreach($_POST["ingredients"] as $key => $ingredient){
                if($key == array_key_last($_POST["ingredients"])){
                    $ingredients.= $ingredient;
                } else{
                    $ingredients.= $ingredient.",";
                }
            }


    $database->update("tb_recipes", [
        "recipe_name"=>$_POST["recipe"],
        "id_recipe_category"=>$_POST["category"],
        "recipe_time"=>$_POST["time"],
        "recipe_image"=>$img,
        "recipe_ingredients"=> $ingredients
    ],[
        "id_recipe"=>$_POST["id"]
    ]);

    header("location: registro-recetas.php");

/* $database->update("tb_recipes", [
    "recipe_name"=>$_POST["recipe"],
    "recipe_category"=>$_POST["category"],
    "recipe_time"=>$_POST["time"]
],[
    "id_recipe"=>$_POST["id"]
]);

    header("location: recipes.php");
 */
?>