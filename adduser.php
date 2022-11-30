<?php

    require 'db.php';

    $pass = password_hash("pass01", PASSWORD_DEFAULT, ['cost' => 12]);//cifrar contrase;a

    // Reference: https://medoo.in/api/insert
    $database->insert("tb_users",[
        "user_name"=> "user01",
        "password"=> $pass
    ]);

?>