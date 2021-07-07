<?php

declare (strict_types=1);
namespace MonorepoBuilder20210707;

use MonorepoBuilder20210707\Symfony\Component\Console\Style\SymfonyStyle;
use MonorepoBuilder20210707\Symfony\Component\DependencyInjection\ContainerInterface;
use MonorepoBuilder20210707\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use MonorepoBuilder20210707\Symplify\ComposerJsonManipulator\ValueObject\Option;
use MonorepoBuilder20210707\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use MonorepoBuilder20210707\Symplify\PackageBuilder\Parameter\ParameterProvider;
use MonorepoBuilder20210707\Symplify\PackageBuilder\Reflection\PrivatesCaller;
use MonorepoBuilder20210707\Symplify\SmartFileSystem\SmartFileSystem;
use function MonorepoBuilder20210707\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (\MonorepoBuilder20210707\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(\MonorepoBuilder20210707\Symplify\ComposerJsonManipulator\ValueObject\Option::INLINE_SECTIONS, ['keywords']);
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('MonorepoBuilder20210707\Symplify\ComposerJsonManipulator\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Bundle']);
    $services->set(\MonorepoBuilder20210707\Symplify\SmartFileSystem\SmartFileSystem::class);
    $services->set(\MonorepoBuilder20210707\Symplify\PackageBuilder\Reflection\PrivatesCaller::class);
    $services->set(\MonorepoBuilder20210707\Symplify\PackageBuilder\Parameter\ParameterProvider::class)->args([\MonorepoBuilder20210707\Symfony\Component\DependencyInjection\Loader\Configurator\service(\MonorepoBuilder20210707\Symfony\Component\DependencyInjection\ContainerInterface::class)]);
    $services->set(\MonorepoBuilder20210707\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class);
    $services->set(\MonorepoBuilder20210707\Symfony\Component\Console\Style\SymfonyStyle::class)->factory([\MonorepoBuilder20210707\Symfony\Component\DependencyInjection\Loader\Configurator\service(\MonorepoBuilder20210707\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class), 'create']);
};