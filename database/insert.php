<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=ages', 'chicuong', '879546231');
if (isset($_POST['name']) && isset($_POST['age'])) {
    $sql = 'INSERT INTO ages(name, age)
            VALUES(:name, :age)';
    $ps = $pdo->prepare($sql);
    $ps->execute(array(
        ':name' => $_POST['name'],
        ':age' => $_POST['age']
    ));
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Insert database Demo</title>
</head>

<body>
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
        Name: <input type="text" name="name" /> <br>
        Age: <input type="number" name="age" /> <br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>