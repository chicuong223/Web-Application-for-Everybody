<?php

    echo '<div>';
    echo '<h3> Foreach loop </h3>';
    $stuffs = array(
        'name' => 'Cuong',
        'major' => 'SE'
    );

    foreach($stuffs as $k => $v){
        echo 'KEY=', $k, ' VALUE=', $v, '<br>';
    }
    echo '</div>';

    echo '<div>';
    echo '<h3> Counted for loop </h3>';
    $stuff2 = array('Cuong','Uy','Lan');
    for($i = 0; $i < count($stuff2); $i++){
        echo 'I=', $i, ' VALUE=', $stuff2[$i], '<br>';
    }
    
    echo '</div>';
?>