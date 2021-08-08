<?php // Do not put any HTML above this line
session_start();
require_once "pdo.php";

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing autos_id";
    header('Location: index.php');
    return;
}

$profile_id = $_GET['profile_id'];
$stmt = $pdo->prepare("SELECT * FROM Profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $profile_id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt1 = $pdo->prepare("SELECT * FROM Position WHERE profile_id = :abc ORDER BY rank");
$stmt1->execute(array(":abc" => $profile_id));
$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>CuongTCSE150676 Login Page</title>
</head>
<body>
<div class="container">
    <h1>Profile information</h1>
    <p>First Name: <?php echo($row['first_name']); ?></p>
    <p>Last Name: <?php echo($row['last_name']); ?></p>
    <p>Email: <?php echo($row['email']); ?></p>
    <p>Headline:<br/> <?php echo($row['headline']); ?></p>
    <p>Summary: <br/><?php echo($row['summary']); ?></p>
    <p>Position: </p>
    <?php 
    foreach($row1 as $r){
        echo '<li>' .$r['year'].':'.$r['description'].'</li>';
    }
    ?>
    <a href="index.php">Done</a>
</div>
</body>
</html>
