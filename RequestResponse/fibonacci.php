<?php
    function Fibo($n)
    {
        $memo = array();
        if ($n <= 1) {
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

    $msg = "";

    if ($_POST == null || strlen($_POST["x"]) < 1) {
        $msg = "Nothing was inputted";
    }
    else if(!is_numeric($_POST["x"])){
        $msg = "Was not a number";
    } else {
        $x = $_POST["x"];
        if ($x > 69) {
            $msg = 'OUT OF MEMORY RANGE';
        } else {
            foreach(Fibo($x) as $k => $v){
                $msg = $msg . "[" . $k . "]" . " => " . $v . "<br>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Fibonacci</title>
</head>

<body>
    <h1>Webpage to generate a Fibonacci sequence</h1>
    <form method="POST" action="fibonacci.php">
        Number of elements: <input type="number" name="x" min="0" max="69" value="<?= htmlentities(isset($_POST["x"]) ? $_POST["x"] : '') ?>" />
        <input type="submit" value="Submit" />
    </form>
    <p style="word-wrap: break-word;"><?= $msg ?></p>
    <a href="fibonacci.php">Reset</a> <br>
</body>

</html>