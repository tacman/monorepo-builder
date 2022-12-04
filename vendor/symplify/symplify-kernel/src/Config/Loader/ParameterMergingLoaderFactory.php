<?php

declare (strict_types=1);
namespace MonorepoBuilder202212\Symplify\SymplifyKernel\Config\Loader;

use MonorepoBuilder202212\Symfony\Component\Config\FileLocator;
use MonorepoBuilder202212\Symfony\Component\Config\Loader\DelegatingLoader;
use MonorepoBuilder202212\Symfony\Component\Config\Loader\GlobFileLoader;
use MonorepoBuilder202212\Symfony\Component\Config\Loader\LoaderResolver;
use MonorepoBuilder202212\Symfony\Component\DependencyInjection\ContainerBuilder;
use MonorepoBuilder202212\Symplify\PackageBuilder\DependencyInjection\FileLoader\ParameterMergingPhpFileLoader;
use MonorepoBuilder202212\Symplify\SymplifyKernel\Contract\Config\LoaderFactoryInterface;
final class ParameterMergingLoaderFactory implements LoaderFactoryInterface
{
    public function create(ContainerBuilder $containerBuilder, string $currentWorkingDirectory) : \MonorepoBuilder202212\Symfony\Component\Config\Loader\LoaderInterface
    {
        $fileLocator = new FileLocator([$currentWorkingDirectory]);
        $loaders = [new GlobFileLoader($fileLocator), new ParameterMergingPhpFileLoader($containerBuilder, $fileLocator)];
        $loaderResolver = new LoaderResolver($loaders);
        return new DelegatingLoader($loaderResolver);
    }
}
