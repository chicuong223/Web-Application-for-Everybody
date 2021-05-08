<?php

$arr = array('name' => 'Cuong',
        'course' => 'WA4E');
echo '<h3> print_r </h3>';
echo '<pre>';
print_r($arr);
echo '</pre>';
echo '<h3>var_dump</h3>';
var_dump($arr);
echo '<br> <br>';

echo '<h3> Printing FALSE variable</h3>';
$thing = FALSE;
print_r($thing);
var_dump($thing);
?>

<!-- print_r does not print FALSE value, whereas var_dump does !-->
