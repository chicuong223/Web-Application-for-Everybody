<?php

// Demand a GET parameter
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

if (strpos($_GET['name'], '@') === false) {
    die('Name parameter is wrong');
}

// If the user requested logout go back to index.php
if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}
?>

<?php
require_once "pdo.php";

//a variable to store error message
$msg = false;
$msgColor = "";

if (isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['make'])) {
    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $msg = 'Mileage and year must be numeric';
        $msgColor = 'red';
    } else if (strlen($_POST['make']) < 1) {
        $msg = 'Make is required';
        $msgColor = 'red';
    } else {
        $make = htmlentities($_POST['make']);
        $year = htmlentities($_POST['year']);
        $mileage = htmlentities($_POST['mileage']);

        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(
            array(
                ':mk' => $make,
                ':yr' => $year,
                ':mi' => $mileage
            )
        );

        $msg = 'Record inserted';
        $msgColor = 'green';
    }
}

$autoLst = [];
$rs = $pdo->query('SELECT * FROM autos');
while ($auto = $rs->fetch(PDO::FETCH_ASSOC)) {
    $autoLst[] = $auto;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>CuongTCSE150676</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Tracking Autos for <?= htmlentities($_GET['name']); ?></h1>
        <?php if ($msg !== false){?>
            <p style="color: <?= $msgColor ?>"><?= $msg ?></p>
        <?php }?>
        <form method="post">
            <p>Make:
                <input type="text" name="make" size="60" />
            </p>
            <p>Year:
                <input type="text" name="year" />
            </p>
            <p>Mileage:
                <input type="text" name="mileage" />
            </p>
            <input type="submit" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>
        <h2>Automobiles</h2>
        <ul>
            <?php foreach ($autoLst as $auto){?>
            <li> <?= $auto['year']; ?> <?= $auto['make']; ?>/<?= $auto['mileage']; ?></li>
            <?php }?>
        </ul>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
</body>

</html>