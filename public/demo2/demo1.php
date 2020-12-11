<?php
class demo1
{
    public $element = [
        'a' => 'aaa',
        'b' => 'bbb'
        ];

    public function a(Closure $a)
    {
        foreach ($this->element as $index => $content) {
            $a($index, $content);
        }
    }
}

