<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0c38673eee00bf0c5d1f6eaec1598a6b
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
        'H' => 
        array (
            'Hananils\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
        'Hananils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/site/plugins/kirby-colors/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0c38673eee00bf0c5d1f6eaec1598a6b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0c38673eee00bf0c5d1f6eaec1598a6b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0c38673eee00bf0c5d1f6eaec1598a6b::$classMap;

        }, null, ClassLoader::class);
    }
}
