<?php

    // Optional local overrides: copy config/db.example.php to config/db.php
    // and set $host / $port / $db / $user / $password there. That file is
    // git-ignored so credentials stay out of the repository.
    $dbConfig = __DIR__ . '/../config/db.php';
    if(file_exists($dbConfig)){
        include $dbConfig;
    }

    // Environment variables take precedence, then the local config above,
    // then sensible defaults for a standard XAMPP / WAMP install.
    $host     = getenv('DB_HOST') ?: ($host ?? 'localhost');
    $port     = getenv('DB_PORT') ?: ($port ?? '3306');
    $db       = getenv('DB_NAME') ?: ($db ?? 'tourism_db');
    $user     = getenv('DB_USER') ?: ($user ?? 'root');
    $password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : ($password ?? '');

    try{
        $pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
        // Log details server-side, show a generic message to the user.
        error_log('DB connection failed: ' . $ex->getMessage());
        die('Database connection failed. Please check your database configuration.');
    }
?>