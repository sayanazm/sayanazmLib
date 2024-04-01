<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80969c3c69d02c86d2503112839142d1
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80969c3c69d02c86d2503112839142d1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80969c3c69d02c86d2503112839142d1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit80969c3c69d02c86d2503112839142d1::$classMap;

        }, null, ClassLoader::class);
    }
}
