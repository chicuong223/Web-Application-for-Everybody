<?php
session_start();
require_once "pdo.php";
if (isset($_SESSION['name'])) {
    $autoLst = [];
    $rs = $pdo->query('SELECT * FROM autos');
    while ($auto = $rs->fetch(PDO::FETCH_ASSOC)) {
        $autoLst[] = $auto;
    }
}
?>

<html>

<head>
    <title>CuongTCSE150676</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
    <?php if (!isset($_SESSION['name'])) { ?>
        <p>Not logged in</p>
    <?php } else { ?>
        <div class="container">
            <h1>Tracking Automobiles for <?= $_SESSION['name'] ?></h1>
            <h2>Automobiles</h2>
            <ul>
                <?php foreach ($autoLst as $auto) { ?>
                    <li> <?= $auto['year']; ?> <?= $auto['id']; ?>/<?= $auto['mileage']; ?></li>
                <?php } ?>
            </ul>
            <p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
        </div>
    <?php } ?>
</body>

</html>