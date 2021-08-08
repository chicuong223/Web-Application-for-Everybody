<?php

try{
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=profiles', 'cuong', '123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    die();
}