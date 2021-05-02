<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=ages', 'chicuong', '879546231');
if (isset($_POST['delete'])) {
    $sql = 'DELETE FROM ages WHERE name LIKE :name';
    $ps = $pdo->prepare($sql);
    $ps->execute(array(
        ':name' => '%' . $_POST['delName'] . '%'
    ));
}
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

<html>
<head>
    <title>Name management</title>
</head>
<body>
    <table border="1">
        <?php
        $resultSet = $pdo->query('SELECT * FROM ages');
        while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo  '<td>';
            echo ('<form method="POST">');
            echo ('<input type="hidden" name="delName" value="' . $row['name'] . '"/>');
            echo ('<button type="submit" name="delete">Delete</button>');
            echo ('</form>');
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <form method="POST">
        <fieldset>
            <legend>
                <h2>Add</h2>
            </legend>
            <div>
                <p>Name: </p>
                <input type="text" name="name" />
            </div>
            <div>
                <p>Age: </p>
                <input type="number" name="age" />
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </fieldset>
    </form>
</body>

</html>