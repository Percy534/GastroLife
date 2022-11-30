<?php

    require 'db.php';

        if($_POST){
            //var_dump($_POST);
            $user = $database-> select("tb_users","*",[
                "user_name" => $_POST["username"]
            ]);

            if(count($user) > 0){
                if(password_verify($_POST["password"], $user[0]["password"])){
                    //echo "valid username and password";

                    //init session
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["username"] = $user[0]["user_name"];
                    //redireccionar
                    header("Location: registro-recetas.php");

                }else{
                    echo "wrong username or password";
                }
            }else{
                echo "wrong username or password";
            }
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../imgs/GL.ico">
    <title>Ingresar</title>
    <!--bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/layout/ingresar.css">
</head>

<body>
<form action="ingresar.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username">
        <label for="password">Password</label>
        <input type="password" name="password">
        <input type="submit" value="LOG IN">
    </form>
</body>

</html>