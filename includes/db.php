<?php
    $host = 'localhost';
    $port = 3307;
    $db = 'tourism_db';
    $user = 'root';
    $password = 123456;

    try{
        $pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
        echo $ex->getMessage();
        die();
    }
?>