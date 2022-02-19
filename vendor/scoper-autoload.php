<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInit0bf43ca42e465f617d243b3b2dcbe3b0', false) && !interface_exists('ComposerAutoloaderInit0bf43ca42e465f617d243b3b2dcbe3b0', false) && !trait_exists('ComposerAutoloaderInit0bf43ca42e465f617d243b3b2dcbe3b0', false)) {
    spl_autoload_call('MonorepoBuilder20220219\ComposerAutoloaderInit0bf43ca42e465f617d243b3b2dcbe3b0');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('MonorepoBuilder20220219\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('MonorepoBuilder20220219\Normalizer');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('MonorepoBuilder20220219\ReturnTypeWillChange');
}
if (!class_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false) && !interface_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false) && !trait_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false)) {
    spl_autoload_call('MonorepoBuilder20220219\Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('resolveConfigFile')) {
    function resolveConfigFile() {
        return \MonorepoBuilder20220219\resolveConfigFile(...func_get_args());
    }
}
if (!function_exists('composerRequire0bf43ca42e465f617d243b3b2dcbe3b0')) {
    function composerRequire0bf43ca42e465f617d243b3b2dcbe3b0() {
        return \MonorepoBuilder20220219\composerRequire0bf43ca42e465f617d243b3b2dcbe3b0(...func_get_args());
    }
}
if (!function_exists('scanPath')) {
    function scanPath() {
        return \MonorepoBuilder20220219\scanPath(...func_get_args());
    }
}
if (!function_exists('lintFile')) {
    function lintFile() {
        return \MonorepoBuilder20220219\lintFile(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \MonorepoBuilder20220219\setproctitle(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \MonorepoBuilder20220219\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \MonorepoBuilder20220219\enum_exists(...func_get_args());
    }
}

return $loader;
