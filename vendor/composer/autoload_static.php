<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit293f260f8b0a43b310e54c0f0334034b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit293f260f8b0a43b310e54c0f0334034b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit293f260f8b0a43b310e54c0f0334034b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit293f260f8b0a43b310e54c0f0334034b::$classMap;

        }, null, ClassLoader::class);
    }
}
