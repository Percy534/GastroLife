<?php
   
    require 'db.php';
    
    $categories = $database->select("tb_recipe_category", "*");

    if(isset($_GET)){
    $data = $database->select("tb_recipes", "*", [
        "id_recipe" => $_GET["id"]
        ]);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Edit Recipe</h1>
    <form action="update.php" method="post" enctype="multipart/form-data"> <!--atributo para enviar archivos desde el form-->

        <label for="recipe">Recipe</label>
        <input type="text" name="recipe" value="<?php echo $data[0]["recipe_name"]; ?>">
        <label for="category">Category</label>
        <select name="category" id="">
            <?php
                $len = count($categories);
                for($i=0; $i<$len; $i++){
                    if($data[0]["id_recipe_category"] === $categories[$i] ['id_recipe_category']){
                        echo '<option value="'.$categories[$i]
                        ['id_recipe_category'].'"selected>'.$categories[$i]
                        ['recipe_category'].'</option>';
                        } else{
                            echo '<option value="'.$categories[$i]
                            ['id_recipe_category'].'">'.$categories[$i]
                            ['recipe_category'].'</option>';
                    }
                }

            ?>

        </select>
        <label for="time">Prep. time</label>
        <input type="text" name="time" value="<?php echo $data[0]["recipe_time"]; ?>">

        <br>
        <label for="recipe_image">Imagen principal</label>
        <img id="preview" src="./images/<?php echo $data[0]["recipe_image"]; ?>" width="125" height="125" alt="Preview">
        <input id="recipe_image" type="file" name="recipe_image" onchange="readURL(this)">
        <br>

        <p>Ingredients</p>        
        <div id="ingredients">
            <?php
                $ingredients = [];
                $ingredients = explode(",", $data[0]["recipe_ingredients"]);
                //echo count($ingredients);
                foreach ($ingredients as $ingredient) {
                    echo "<div>";
                    echo "<label>Ingredient</label>";
                    echo "<input type='text' name='ingredients[]' value='$ingredient'>";
                    echo "<button onclick='click(event);'>remove</button>";
                    echo "</div>";
                }
            ?>    
        </div>    
        <button type="button" id="add-ingredient">Add ingredient</button>
        <br>

        <input type="hidden" name="id" value="<?php echo $data[0]["id_recipe"]; ?>">
        <input type="submit" value="SUBMIT">
    </form>

    <script>

        function click(){
            event.preventDefault();
        };

       function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.querySelector('#add-ingredient').addEventListener('click', function(){
            
            event.preventDefault();
            let ingredient = document.createElement("div");
            let id = "ingredient-"+Date.now();
            ingredient.id = id;
            document.querySelector('#ingredients').appendChild(ingredient);

            let label = document.createElement("label");
            label.innerText = "Ingredient";
            label. setAttribute('for', 'ingredient')
            document.querySelector('#'+id).appendChild(label);

            let input = document.createElement("input");
            input.type = "text";
            input.setAttribute('name', 'ingredients[]');
            document.querySelector('#'+id).appendChild(input);

            let btn = document.createElement("button");
            btn.innerText = "remove";
            btn.addEventListener("click", function(){
                document.querySelector('#'+id).remove();
            });
            document.querySelector('#'+id).appendChild(btn);

        });

   </script>

</body>
</html>