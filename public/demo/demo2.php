<?php
$name2 = 'xiaochuan';
$test = function ($name, $age) 
use 
($name2) {
     //这里的name 不是用的传递的名字 而是 use 中
     echo $name;
     echo "\n";
     echo $age;
     echo "\n";
     echo $name2;
     echo "\n";
 };
$test('xiaodou',20);

?>