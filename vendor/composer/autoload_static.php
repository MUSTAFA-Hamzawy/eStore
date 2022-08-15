<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit006defdf61efa15ebf0351497ff85186
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MVC\\' => 4,
        ),
        'D' => 
        array (
            'Dcblogdev\\PdoWrapper\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Dcblogdev\\PdoWrapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/dcblogdev/pdo-wrapper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit006defdf61efa15ebf0351497ff85186::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit006defdf61efa15ebf0351497ff85186::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit006defdf61efa15ebf0351497ff85186::$classMap;

        }, null, ClassLoader::class);
    }
}