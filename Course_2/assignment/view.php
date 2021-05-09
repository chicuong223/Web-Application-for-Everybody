<?php
session_start();
require_once "pdo.php";
if (isset($_SESSION['name'])) {
    $lst = [];
    $rs = $pdo->query('SELECT * FROM autos');
    while ($auto = $rs->fetch(PDO::FETCH_ASSOC)) {
        $lst[] = $auto;
    }
} else {
    header('Location: index.php');
}
?>

<html>

<head>
    <title>CuongTCSE150676's Autos</title>
    <meta charset="UTF-8" />
</head>

<body>
    <h1>Welcome to Automobiles Database</h1>
    <?php if(isset($_SESSION['success'])){
        echo '<p style="color:green">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']);
    }
    ?>
    <?php if (sizeof($lst) < 1) { ?>
        <p>No rows found</p>
    <?php } else { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Mileage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lst as $auto) {?>
            <tr>
                <td><?= $auto['make'] ?></td>
                <td><?= $auto['model'] ?></td>
                <td><?= $auto['year'] ?></td>
                <td><?= $auto['mileage'] ?></td>
                <td><a href="edit.php?id=<?= $auto['autos_id'] ?>">Edit</a>/<a href="delete.php?id=<?= $auto['autos_id'] ?>">Delete</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <p><a href="add.php">Add New Entry</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>