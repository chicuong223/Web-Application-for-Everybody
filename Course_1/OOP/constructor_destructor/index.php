<?php
    class Person{
        function __construct()
        {
            echo 'This is a constructor <br>';
        }

        function __destruct()
        {
            echo 'This is a destructor <br>';
        }
    }

    $cuong = new Person();
?>