<?php 
    namespace Medoo;
    require 'Medoo.php';

    if(!isset($database)){
        $database = new Medoo([
            // [required]
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'recipesxpro',
            'username' => 'root',
            'password' => ''
        ]);
    }
    //www.db4free.net, oscargm, 01311020osca
?>