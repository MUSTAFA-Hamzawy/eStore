<?php


namespace MVC\core;


class helpers
{
    public static function reDirect($path)
    {
        header("Location: " . ROOT_LINK . $path);
    }
    public static function reDirectAfterTime($path, $seconds)
    {
        header("refresh:{$seconds};url=" . ROOT_LINK . $path);
    }
}