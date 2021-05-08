<?php 
    echo '<pre>\n';
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=user', 'chicuong', '879546231');
    $sql = $pdo->query('SELECT * FROM user');
    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        print_r($row);
    }
    echo '</pre>';
?>