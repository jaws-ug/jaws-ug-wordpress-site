<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd46751fe7ef1e9097dcfbdba36d527d9
{
    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'Hametuha\\HametuPack' => 
            array (
                0 => __DIR__ . '/../..' . '/app',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitd46751fe7ef1e9097dcfbdba36d527d9::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
