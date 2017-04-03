<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb3119c3cf5b21cf39db508639c6cf23f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $prefixesPsr0 = array (
        'X' => 
        array (
            'XPDF' => 
            array (
                0 => __DIR__ . '/..' . '/php-xpdf/php-xpdf/src',
            ),
        ),
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
        'A' => 
        array (
            'Alchemy' => 
            array (
                0 => __DIR__ . '/..' . '/alchemy/binary-driver/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb3119c3cf5b21cf39db508639c6cf23f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb3119c3cf5b21cf39db508639c6cf23f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb3119c3cf5b21cf39db508639c6cf23f::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}