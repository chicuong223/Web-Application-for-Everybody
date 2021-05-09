<?php session_start(); ?>
<html>
    <h1>Login - Logout Demo</h1>
    <body>
        <?php
        if(isset($_SESSION['SUCCESS'])){
            echo '<p style="color:green">' . $_SESSION['SUCCESS'] . '</p>' . "\n";
            unset($_SESSION['SUCCESS']);
        }

        if(!isset($_SESSION['acc'])){?>
            <p>Please <a href="login.php">Login</a></p>
        <?php } else { ?>
            <p>Please <a href="logout.php">Logout</a> when you are done</p>
        <?php }?>
    </body>
</html>
