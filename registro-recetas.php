

<?php
    require 'db.php';

    session_start();
    if(isset($_SESSION["isLoggedIn"])){

        // $data = $database->select("tb_recipes", "*");

    $data= $database->select("tb_recipes",[//inner
        "[>]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"]//[>] caracter para hacer el join
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name",
        "tb_recipes.recipe_time",
        "tb_recipes.recipe_image",
        "tb_recipes.recipe_likes",
        "tb_recipe_category.recipe_category"
    ]);

    }else{
        header("Location: login.php");
    }

    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro-Recetas</title>
    <!--bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <section>
        <h1>Registro de Recetas</h1>
        <form>

            <p>Ingresa el nombre de tu Receta: <input type="text" name="receta"></p>

            <label for="category">Category</label>

            <select name="category" id="">
                <?php
                    $len = count($data);
                    for($i=0; $i<$len; $i++){
                        echo '<option value="'.$data[$i]
                        ['id_recipe_category'].'">'.$data[$i]
                        ['recipe_category'].'</option>';
                    }

                ?>


            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Imagen de la receta</label>
                <input type="file" class="form-control" id="inputGroupFile01">
            </div>

            tiempo de preparación

            <input type="datetime" name="min"></p>

            <p>
                tiempo de cocción

                <input type="datetime" name="min">
            </p>

            </p>tiempo total

            <input type="datetime" name="min"></p>

            <p>
                Numero de porciones


            </p><input type="number" name="porciones">

            <p>
                complejidad

                <select name="" id="">
                    <option value="Fácil">Fácil</option>
                    <option value="Medio">Medio</option>
                    <option value="Medio">Difícil</option>
                </select>
            </p>

            <p>
            

            <p>
                Ocaciones:
            </p>
            <select name="" id="">
                <option value="Cumpleaños">Cumpleaños</option>
                <option value="Día del padre">Día del padre</option>
                <option value="Día de la madre">Día de la madre</option>
                <option value="Día del niño">Día del niño</option>
                <option value="Navidad">Navidad</option>
                <option value="Semana Santa">Semana Santa</option>
                <option value="Verano">Verano</option>
            </select>

            <p>
                Destacar Receta: <input type="radio" name="" id="">
            </p>

            <p>
                Cantidad de votos: <input type="number" name="votos">
            </p>
            <p>

                Descripcion de la receta:<br>

                <textarea name="descripcion"></textarea>

            </p>

            <p>
            <p>Ingredients</p>        
                <div id="ingredients">

                </div>    
                <button type="button" id="add-ingredient">Add ingredient</button>
            </p>

            <p>

                Instrucciones para la preparación:<br>

                <textarea name="ingredientes"></textarea>

            </p>
            <p>
                Recetas relacionadas
            </p>
            <select name="" id="">
                <option value="Cumpleaños">lasaña</option>
                <option value="Día del padre">Avena</option>
                <option value="Día de la madre">salmon</option>
                <option value="Día del niño">pinto</option>
                <option value="Navidad">nachos</option>
                <option value="Semana Santa">ponche</option>
                <option value="Verano">tarta</option>
            </select>

            </p>

            <input type="submit" value="SUBMIT">

        </form>

        <script>
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

        <div class="card-group mt-5">
            <div class="card">
                <a href="receta.php"><img src="../imgs/Recetas/Desayuno/blueberries-ga412acaf1_1920.jpg"
                        class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <div>Avena con arandanos</div>
                    <div class="d-flex ms-4">
                        <input type="submit" value="Aceptar">
                        <input type="submit" value="Rechazar">

                    </div>
                </div>
            </div>
            <div class="card">
                <a href="receta.php"><img src="../imgs/Recetas/Desayuno/waffles-gbfa9ce6a3_1920.jpg"
                        class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <div>wafles</div>
                    <div class="d-flex ms-4">
                        <input type="submit" value="Aceptar">
                        <input type="submit" value="Rechazar">

                    </div>
                </div>

            </div>
            <div class="card">
                <a href="receta.php"><img src="../imgs/Recetas/Bebidas/kiwi-coctail-gf68605e32_1920.jpg"
                        class="card-img-top" alt="...">
                </a>
                <div class="card-body">

                    </button>
                    <div class="card-title botones-verdes2">coctel de kiwi</div>
                    <div class="d-flex ms-4">
                        <input type="submit" value="Aceptar">
                        <input type="submit" value="Rechazar">

                    </div>
                    </button>
                </div>
            </div>

        </div>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style-recipes.css">
</head>
<body>

    <p>User: <?php echo $_SESSION["username"] ?></p>
    <p><a href="logout.php">Logout</a></p>
    <h1>Registered Recipes</h1>

    <table>
        <tr>
            <td>Recipe image</td>
            <td>Recipe name</td>
            <td>Recipe likes</td>
            <td>Recipe Category</td>
            <td>Prep. time</td>
            <td>Options</td>
        </tr>
        <tr>

        </tr>

        <?php

            $len = count($data);

            for($i=0; $i<$len; $i++){
                echo "<tr>";
                echo "<td><img src='./images/".$data[$i]["recipe_image"]."'class='thumb img-25'></td>";
                echo "<td>".$data[$i]["recipe_name"]."</td>";
                echo "<td>".$data[$i]["recipe_likes"]."</td>";
                echo "<td>".$data[$i]["recipe_category"]."</td>";
                echo "<td>".$data[$i]["recipe_time"]."</td>";
                echo "<td><a href='edit.php?id=".$data[$i]["id_recipe"]."'>Edit</a>
                <a href='delete.php?id=".$data[$i]["id_recipe"]."'>Delete</a> <a href='likes.php?id=".$data[$i]["id_recipe"]."'>Likes</a></td>";
                echo "</tr>";
            }

        ?>

    </section>
</body>

</html>