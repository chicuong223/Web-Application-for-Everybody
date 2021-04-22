<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Fibonacci</title>
</head>

<body>
    <h1>Webpage to generate a Fibonacci sequence</h1>
    <form method="POST" action="fibonacci.php">
        Number of elements: <input type="number" name="x" min="0" max="69" value="<?= htmlentities(isset($_POST["x"]) ? $_POST["x"] : '')?>"/>
        <input type="submit" value="Submit" />
    </form>
    <?php
    function Fibo($n)
    {
        $memo = array();
        if($n <= 1){
            $memo[] = 0;
            return $memo;
        }
        $memo[0] = 0;
        $memo[1] = 1;
        for ($i = 2; $i < $n; $i++) {
            $memo[$i] = $memo[$i - 1] + $memo[$i - 2];
        }
        return $memo;
    }

    if ($_POST == null || strlen($_POST["x"]) < 1 || !is_numeric($_POST["x"])) {
        echo 'Nothing was inputted </br>';
    } else {
        $x = $_POST["x"];
        if ($x > 69) {
            echo 'OUT OF MEMORY RANGE <br>';
        } else {
            $fibo = Fibo($x);
            echo '<pre>';
            print_r($fibo);
            echo '</pre>';
        }
    }
    ?>
    <a href="fibonacci.php">Reset</a>
</body>

</html>