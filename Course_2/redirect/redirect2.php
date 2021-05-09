<?php
    if(isset($_POST['where'])){
        $x = $_POST['where'];
        if($x == 1){
            header('Location: redirect1.php');
            return;
        }
        else if($x == 2){
            header('Location: redirect2.php?parm=123');
            return;
        }
        else{
            header('Location: https://www.youtube.com/');
            return;
        }
    }
?>

<html>
    <body>
        <h1>Redirect 2</h1>
        <h3><?= $_GET['parm'] ?></h3>
        <form method="POST">
            <p><label for="where">Where to go </label>
            <input name="where" id="where"/></p>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>