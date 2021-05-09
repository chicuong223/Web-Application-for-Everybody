<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
    return;
}
require_once "pdo.php";
$ps = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
$ps->execute(array(
    ':id' => $_GET['id']
));
$rs = $ps->fetch(PDO::FETCH_ASSOC);
if ($rs === false) {
    $_SESSION['error'] = "Not found";
    header('Location: delete.php');
    return;
}

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $ps = $pdo->prepare("DELETE FROM autos WHERE autos_id=:id");
    $ps->execute(array(
        ':id' => htmlentities($_POST['id'])
    ));
    $_SESSION['success'] = "Record deleted";
    header('Location: view.php');
    return;
}

if(isset($_POST['cancel'])){
    header('Location: view.php');
    return;
}

?>

<html>

<head>
    <title>CuongTCSE150676's Autos</title>
    <meta charset="UTF-8" />
</head>

<body>
    <p>Confirm: Deleting <?= $rs['make'] ?></p>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>" readonly />
        <button type="submit" name="delete">Delete</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>

</html>