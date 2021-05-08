<?php
    class Person{
        public $fullname = false;
        public $firstname = false;
        public $lastname = false;
        public $room = false;

        function getName(){
            if($this->fullname !== false) return $this->fullname;
            if($this->firstname !== false && $this->lastname !== false) return $this->firstname . ' ' . $this->lastname;
            return false;
        }
    }

    $cuong = new Person();
    $cuong->fullname = "Tang Chi-Cuong";

    $uy = new Person();
    $uy->firstname = "Chi-Uy";
    $uy->lastname = "Tang";

    echo $cuong->getName() . '<br>';
    echo $uy->getName(). '<br>';
?>