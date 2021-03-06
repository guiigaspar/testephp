<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInited8ef9e44437ae7badab12fc48047c87
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInited8ef9e44437ae7badab12fc48047c87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInited8ef9e44437ae7badab12fc48047c87::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
