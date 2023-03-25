<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitca5fed3fef8e23908052724b3017f2dd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitca5fed3fef8e23908052724b3017f2dd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitca5fed3fef8e23908052724b3017f2dd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitca5fed3fef8e23908052724b3017f2dd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}