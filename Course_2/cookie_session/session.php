<?php 
    session_start();
    if(!isset($_SESSION['cuong'])){
        echo "<p>SESSION IS EMPTY ! </p>\n";
        $_SESSION['cuong'] = 0;
    }
    else if($_SESSION['cuong'] < 3){
        $_SESSION['cuong'] += 1;
        echo "<p>ADDED ONE ... </p> \n";
    }
    else{
        session_destroy();
        session_start();
        echo "<p>SESSION RESTARTED ! </p>\n";
    }
?>
<p><a href="session.php">Click here</a></p>
<p>Session id = <?= session_id() ?></p>
<pre>
<?php print_r($_SESSION); ?>
</pre>