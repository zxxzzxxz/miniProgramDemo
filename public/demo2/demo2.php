<?php
include 'demo1.php';

class demo2
{
    function bb()
    {
        $name = 'qqqq';
        $a = new demo1();
        $a->a(function($q, $d) use($name) {
            echo $q . "\n";
            echo $d . "\n";
            echo $name . "\n";
        });
    }
}

$b = new demo2();
$b->bb();