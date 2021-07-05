<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInit8d97ac97faa62d6bbdbf11dd635145ea', false) && !interface_exists('ComposerAutoloaderInit8d97ac97faa62d6bbdbf11dd635145ea', false) && !trait_exists('ComposerAutoloaderInit8d97ac97faa62d6bbdbf11dd635145ea', false)) {
    spl_autoload_call('MonorepoBuilder20210705\ComposerAutoloaderInit8d97ac97faa62d6bbdbf11dd635145ea');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('MonorepoBuilder20210705\Normalizer');
}
if (!class_exists('JsonException', false) && !interface_exists('JsonException', false) && !trait_exists('JsonException', false)) {
    spl_autoload_call('MonorepoBuilder20210705\JsonException');
}
if (!class_exists('Attribute', false) && !interface_exists('Attribute', false) && !trait_exists('Attribute', false)) {
    spl_autoload_call('MonorepoBuilder20210705\Attribute');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('MonorepoBuilder20210705\Stringable');
}
if (!class_exists('UnhandledMatchError', false) && !interface_exists('UnhandledMatchError', false) && !trait_exists('UnhandledMatchError', false)) {
    spl_autoload_call('MonorepoBuilder20210705\UnhandledMatchError');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('MonorepoBuilder20210705\ValueError');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('MonorepoBuilder20210705\ReturnTypeWillChange');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('resolveConfigFileInfo')) {
    function resolveConfigFileInfo() {
        return \MonorepoBuilder20210705\resolveConfigFileInfo(...func_get_args());
    }
}
if (!function_exists('composerRequire8d97ac97faa62d6bbdbf11dd635145ea')) {
    function composerRequire8d97ac97faa62d6bbdbf11dd635145ea() {
        return \MonorepoBuilder20210705\composerRequire8d97ac97faa62d6bbdbf11dd635145ea(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \MonorepoBuilder20210705\setproctitle(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \MonorepoBuilder20210705\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \MonorepoBuilder20210705\enum_exists(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \MonorepoBuilder20210705\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \MonorepoBuilder20210705\dump(...func_get_args());
    }
}
if (!function_exists('dd')) {
    function dd() {
        return \MonorepoBuilder20210705\dd(...func_get_args());
    }
}

return $loader;
