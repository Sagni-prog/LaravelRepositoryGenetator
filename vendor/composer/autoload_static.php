<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5debf227ad86cc0b25b7e52e984a7591
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sagni\\Repository\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sagni\\Repository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5debf227ad86cc0b25b7e52e984a7591::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5debf227ad86cc0b25b7e52e984a7591::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5debf227ad86cc0b25b7e52e984a7591::$classMap;

        }, null, ClassLoader::class);
    }
}
