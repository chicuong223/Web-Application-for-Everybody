<?php 
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=ages', 'chicuong', '879546231');
    if(isset($_POST['name'])){
        $sql = 'DELETE FROM ages WHERE name LIKE :name';
        $ps = $pdo -> prepare($sql);
        $ps->execute(array(
            ':name' => '%' . $_POST['name'] . '%'
        ));
    }
?>

<html>
    <h1>DELETE A USER</h1>
    <table border="1">
        <?php
            $resultSet = $pdo->query('SELECT * FROM ages');
            while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
            }
        ?>
    </table>
    <form method="POST">
        <input type="text" name="name"/>
        <button type="submit">Delete</button>
    </form>
</html>