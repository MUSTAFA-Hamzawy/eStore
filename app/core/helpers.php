<?php


namespace MVC\core;


class helpers
{
    public static function reDirect($path)
    {

        header("Location: " . $path);
    }
}