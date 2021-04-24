<?php
    function equation($a, $b, $c){
        $result = "";
        if($a == 0){
            if($b == 0){
                $result = "No solutions";
            }
            else{
                $result = "x = " . -$c/$b;
            }
        }
        else{
            $d = $b * $b - 4 * $a * $c;
            if($d < 0){
                $result = "No solutions";
            }
            else if($d == 0){
                $result = "x = " . -$b/(2*$a);
            }
            else{
                $result = "x1 = " . (-$b + sqrt($d))/(2*$a) . "; x2 = " . (-$b - sqrt($d))/(2*$a);
            }
        }
        return $result;
    }

    $r = "";
    if($_GET == null){
        $r = "";
    }
    else{
        $arr = $_GET;
        if(!is_numeric($arr['a']) || !is_numeric($arr['b']) || !is_numeric($arr['c'])){
            $r = "INVALID DATA";
        }
        else{
            $r = equation($arr['a'], $arr['b'], $arr['c']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Quadratic Equation</title>
    </head>
    <body>
        <h1>Programme to solve a quadratic equation</h1>
        <form action="index.php" method="GET">
            <table>
                <tr>
                    <th>a </th>
                    <td><input type="text" name="a"/></td>
                </tr>
                <tr>
                    <th>b </th>
                    <td><input type="text" name="b"/></td>
                </tr>
                <tr>
                    <th>c </th>
                    <td><input type="text" name="c"/></td>
                </tr>
            </table>
            <input type="submit" value="Solve"/>
        </form>
            <h2>Result: <?= $r ?></h2>
        </form>
    </body>
</html>