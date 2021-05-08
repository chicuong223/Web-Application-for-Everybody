<?php
    class Hello{
        protected $lang;

        function __construct($lang)
        {
            $this->lang = $lang;
        }

        function greet(){
            if($this->lang === 'es') return 'Hola';
            if($this->lang === 'fr') return 'Bonjour';
            if($this->lang === 'it') return 'Ciao';
            if($this->lang === 'jp') return 'こんにちは';
            return 'Hello';
        }
    }

    $hello = new Hello('jp');
    $hello1 = new Hello('fr');
    $hello2 = new Hello('es');
    echo $hello->greet();
    echo $hello1->greet();
    echo $hello2->greet();
?>