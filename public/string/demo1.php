<?php

class demo1
{
    public function a()
    {
        $a = new demo2();
        return $a;
    }
}

class demo2
{
    public function b()
    {
        echo "bjjj\n";
    }
}

(new demo1())->a()->b();