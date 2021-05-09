<?php
    session_start();
    if (isset($_POST['acc']) && isset($_POST['pw'])) {
        unset($_SESSION['acc']); //logout current user
        if ($_POST['pw'] == 'abcde') {
            $_SESSION['acc'] = $_POST['acc'];
            $_SESSION['SUCCESS'] = 'Login Successfully';
            header('Location: index.php');
            return;
        } else {
            $_SESSION['error'] = 'Login failed';
            header('Location: login.php');
            return;
        }
    }
?>

<html>

<head></head>

<body>
    <h1>Login</h1>
    <?php if (isset($_SESSION['error'])) : ?>
        <p style="color:red"><?= $_SESSION['error'] ?></p>
    <?php endif; 
    unset($_SESSION['error']);
    ?>
    <form method="post">
        <div>
            Name: <input type="text" name="acc" />
        </div>
        <div>
            Password: <input type="password" name="pw" />
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>

</html>