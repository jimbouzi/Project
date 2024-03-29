<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11d295a5480a7f0b3c1364e4d4e5b2e3
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Brick\\Db\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Brick\\Db\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/db/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11d295a5480a7f0b3c1364e4d4e5b2e3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11d295a5480a7f0b3c1364e4d4e5b2e3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
