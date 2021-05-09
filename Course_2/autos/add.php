<?php
session_start();
require_once "pdo.php";
if (isset($_POST['cancel'])) {
    header('Location: view.php');
    return;
}
if (isset($_SESSION['name'])) {
    //a variable to store error message
    $msg = false;
    $succ = false;

    if (isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['make'])) {
        if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $msg = 'Mileage and year must be numeric';
        } else if (strlen($_POST['make']) < 1) {
            $msg = 'Make is required';
        } else {
            $make = htmlentities($_POST['make']);
            $year = htmlentities($_POST['year']);
            $mileage = htmlentities($_POST['mileage']);

            $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)');
            $stmt->execute(
                array(
                    ':mk' => $make,
                    ':yr' => $year,
                    ':mi' => $mileage
                )
            );
            $succ = "Record inserted";
        }
        if ($succ !== false) {
            $_SESSION['success'] = $succ;
            header('Location: view.php');
            return;
        }
        if ($msg !== false) {
            $_SESSION['error'] = $msg;
            header('Location: add.php');
            return;
        }
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
            <?php if (isset($_SESSION['error'])) { ?>
                <p style="color:red"><?= $_SESSION['error'] ?></p>
            <?php }
            unset($_SESSION['error']);
            ?>
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
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
    <?php } ?>
</body>

</html>