<?php
    $stuffs = array(
        'name' => 'Cuong',
        'major' => 'SE' 
    );
    echo '<pre>';
    print_r($stuffs);
    echo '</pre>';

    #array_key_exist
    echo 'addr=';
    if(array_key_exists('addr', $stuffs)) echo 'exists <br>';
    else echo 'not found <br>';
    echo 'name=';
    if(array_key_exists('name', $stuffs)) echo 'exists <br>';
    else echo 'not found <br>';
    echo '<br>';

    #isset
    echo 'course=';
    echo isset($stuffs['name']) ? 'name is set <br>' : 'name is not set <br>';
    echo isset($stuffs['course']) ? 'course is set <br>' : 'course is not set <br>';
    echo '<br>';

    #count
    echo 'Array Size: ', count($stuffs);

    #ksort
    $stuffs['course'] = 'PRJ301';
    ksort($stuffs);
    echo '<pre>';
    print_r($stuffs);
    echo '</pre>';
    echo '<br>';

    #asort
    asort($stuffs);
    echo '<pre>';
    print_r($stuffs);
    echo '</pre>';
    echo '<br>';

    #sort => lose key
    sort($stuffs);
    echo '<pre>';
    print_r($stuffs);
    echo '</pre>';
    echo '<br>';

    #split string
    $string = 'This is a string';
    $temp = explode(" ", $string);
    echo $string, '<br>';
    echo '<pre>';
    print_r($temp);
    echo '</pre>';
    echo '<br>';
?>