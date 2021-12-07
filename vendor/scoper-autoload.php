<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInite5f44fc244c89833626356858feb7cbd', false) && !interface_exists('ComposerAutoloaderInite5f44fc244c89833626356858feb7cbd', false) && !trait_exists('ComposerAutoloaderInite5f44fc244c89833626356858feb7cbd', false)) {
    spl_autoload_call('MonorepoBuilder20211207\ComposerAutoloaderInite5f44fc244c89833626356858feb7cbd');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('MonorepoBuilder20211207\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('MonorepoBuilder20211207\Normalizer');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('MonorepoBuilder20211207\ReturnTypeWillChange');
}
if (!class_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false) && !interface_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false) && !trait_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', false)) {
    spl_autoload_call('MonorepoBuilder20211207\Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('resolveConfigFile')) {
    function resolveConfigFile() {
        return \MonorepoBuilder20211207\resolveConfigFile(...func_get_args());
    }
}
if (!function_exists('composerRequiree5f44fc244c89833626356858feb7cbd')) {
    function composerRequiree5f44fc244c89833626356858feb7cbd() {
        return \MonorepoBuilder20211207\composerRequiree5f44fc244c89833626356858feb7cbd(...func_get_args());
    }
}
if (!function_exists('scanPath')) {
    function scanPath() {
        return \MonorepoBuilder20211207\scanPath(...func_get_args());
    }
}
if (!function_exists('lintFile')) {
    function lintFile() {
        return \MonorepoBuilder20211207\lintFile(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \MonorepoBuilder20211207\setproctitle(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \MonorepoBuilder20211207\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \MonorepoBuilder20211207\enum_exists(...func_get_args());
    }
}

return $loader;
