<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit00f43ac9a6d51c61f613c108aecf0b41
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'tobimori\\DreamFormDateField\\' => 28,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'tobimori\\DreamFormDateField\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Kirby\\ComposerInstaller\\CmsInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/CmsInstaller.php',
        'Kirby\\ComposerInstaller\\Installer' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Installer.php',
        'Kirby\\ComposerInstaller\\Plugin' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Plugin.php',
        'Kirby\\ComposerInstaller\\PluginInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/PluginInstaller.php',
        'tobimori\\DreamFormDateField\\DateField' => __DIR__ . '/../..' . '/classes/DateField.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit00f43ac9a6d51c61f613c108aecf0b41::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit00f43ac9a6d51c61f613c108aecf0b41::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit00f43ac9a6d51c61f613c108aecf0b41::$classMap;

        }, null, ClassLoader::class);
    }
}
