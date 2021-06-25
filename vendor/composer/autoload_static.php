<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit480d2935fd1ab3e7d771e82b81127986
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit480d2935fd1ab3e7d771e82b81127986::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit480d2935fd1ab3e7d771e82b81127986::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit480d2935fd1ab3e7d771e82b81127986::$classMap;

        }, null, ClassLoader::class);
    }
}