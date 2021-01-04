<?php

class Form
{
    static function get($item)
    {
        return (new \Framework\Http\Request())->post->get($item);
    }
}
