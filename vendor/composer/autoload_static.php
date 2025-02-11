<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50489714dc35b8c5a19828e5fdb18e98
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit50489714dc35b8c5a19828e5fdb18e98::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit50489714dc35b8c5a19828e5fdb18e98::$classMap;

        }, null, ClassLoader::class);
    }
}
