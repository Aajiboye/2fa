<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb866c63fc9d1e0b564c3066b80d2901a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sonata\\GoogleAuthenticator\\' => 27,
        ),
        'P' => 
        array (
            'Psr\\Cache\\' => 10,
        ),
        'G' => 
        array (
            'Google\\Authenticator\\' => 21,
        ),
        'D' => 
        array (
            'Dolondro\\GoogleAuthenticator\\' => 29,
        ),
        'B' => 
        array (
            'Base32\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sonata\\GoogleAuthenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Google\\Authenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
        'Dolondro\\GoogleAuthenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/dolondro/google-authenticator/src',
        ),
        'Base32\\' => 
        array (
            0 => __DIR__ . '/..' . '/christian-riesen/base32/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb866c63fc9d1e0b564c3066b80d2901a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb866c63fc9d1e0b564c3066b80d2901a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
