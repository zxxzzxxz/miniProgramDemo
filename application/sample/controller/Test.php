<?php
namespace app\sample\controller;

class Test
{
    public function hello($id, $name='null', $age=0)
    {
        echo $id;
        echo " | ";
        echo $name;
        echo " | ";
        echo $age;
        return "</br>hello";
    }

    public function demo()
    {
        echo "hello world";
    }
}
