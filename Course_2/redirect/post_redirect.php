<?php
session_start();
if (isset($_POST['guess'])) {
    $guess = $_POST['guess'] + 0;
    $_SESSION['guess'] = $guess;
    if ($guess < 42) {
        $_SESSION['message'] = "Too low";
    } else if ($guess == 42) {
        $_SESSION['message'] = "Great job";
    } else {
        $_SESSION['message'] = "Too high";
    }
    header("Location: post_redirect.php");
    return;
}
?>

<html>

<body>
    <h1 style="text-transform: capitalize;">guess</h1>
    <?php
    $guess = isset($_SESSION['guess']) ? $_SESSION['guess'] : "";
    $msg = isset($_SESSION['message']) ? $_SESSION['message'] : false;
    ?>
    <?php if ($msg !== false) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
    <form method="POST">
        <p>Guess</p>
        <input type="number" name="guess" / value="<?= $guess ?>"> <br>
        <button type="submit">Submit</button>
    </form>
    <?php session_destroy(); ?>
</body>

</html>