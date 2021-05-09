<?php
session_start();
if (!isset($_SESSION['name'])) {
    die('ACCESS DENIED');
    return;
}

if (isset($_POST['cancel'])) {
    header('Location: view.php');
    return;
}

require_once "pdo.php";
$ps = $pdo->prepare("SELECT * FROM autos WHERE autos_id=:id");
$ps->execute(array(
    ':id' => $_GET['id']
));
$rs = $ps->fetch(PDO::FETCH_ASSOC);
if ($rs === false) {
    $_SESSION['error'] = "Data not found";
    header('Location: view.php');
    return;
}

$error = false;
$succ = false;
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
        $error = "All fields are required";
    } else if (!is_numeric($_POST['year'])) {
        $error = "Year must be an integer";
    } else if (!is_numeric($_POST['mileage'])) {
        $error = "Mileage must be an integer";
    } else {
        $make = htmlentities($_POST['make']);
        $model = htmlentities($_POST['model']);
        $year = htmlentities($_POST['year']);
        $mileage = htmlentities($_POST['mileage']);
        $id = $_POST['id'];

        $ps = $pdo->prepare("UPDATE autos SET make=:make, model=:model, year=:year, mileage=:mileage WHERE autos_id=:id");
        $ps->execute(array(
            ':make' => $make,
            ':model' => $model,
            ':year' => $year,
            ':mileage' => $mileage,
            ':id' => $id
        ));
        $succ = "Record edited";
    }
    if ($error !== false) {
        $_SESSION['error'] = $error;
        header('Location: add.php');
        return;
    }
    if ($succ !== false) {
        $_SESSION['success'] = $succ;
        header('Location: view.php');
        return;
    }
}


?>

<html>

<head>
    <title>CuongTCSE150676's Edit</title>
</head>

<body>
    <h1>Editing Automobile</h1>
    <?php if (isset($_SESSION['error'])) : ?>
        <p style="color:red"><?= $_SESSION['error'] ?></p>
    <?php endif; unset($_SESSION['error']); ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
        <div>
            <label for="make">Make</label>
            <input type="text" id="make" name="make" value="<?= htmlentities($rs['make']) ?>"/>
        </div>
        <div>
            <label for="model">Model</label>
            <input type="text" id="model" name="model" value="<?= htmlentities($rs['model']) ?>"/>
        </div>
        <div>
            <label for="year">Year</label>
            <input type="text" id="year" name="year" value="<?= htmlentities($rs['year']) ?>"/>
        </div>
        <div>
            <label for="mileage">Mileage</label>
            <input type="text" id="mileage" name="mileage" value="<?= htmlentities($rs['mileage']) ?>"/>
        </div>
        <div>
            <button type="submit">Save</button>
            <button type="submit" name="cancel">Cancel</button>
        </div>
    </form>
</body>

</html>