<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Config;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\MonorepoBuilder\ValueObject\Option;
use MonorepoBuilder20220525\Webmozart\Assert\Assert;
final class MBConfig extends \Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator
{
    /**
     * @param string[] $packageDirectories
     */
    public function packageDirectories(array $packageDirectories) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString($packageDirectories);
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allFileExists($packageDirectories);
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::PACKAGE_DIRECTORIES, $packageDirectories);
    }
    /**
     * @param string[] $packageDirectories
     */
    public function packageDirectoriesExcludes(array $packageDirectories) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString($packageDirectories);
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allFileExists($packageDirectories);
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::PACKAGE_DIRECTORIES_EXCLUDES, $packageDirectories);
    }
    public function defaultBranch(string $defaultBranch) : void
    {
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::DEFAULT_BRANCH_NAME, $defaultBranch);
    }
    /**
     * @param array<string, mixed> $dataToRemove
     */
    public function dataToRemove(array $dataToRemove) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString(\array_keys($dataToRemove));
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::DATA_TO_REMOVE, $dataToRemove);
    }
    /**
     * @param array<string, mixed> $dataToAppend
     */
    public function dataToAppend(array $dataToAppend) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString(\array_keys($dataToAppend));
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::DATA_TO_APPEND, $dataToAppend);
    }
    /**
     * @param array<class-string<ReleaseWorkerInterface>> $workerClasses
     */
    public function workers(array $workerClasses) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString($workerClasses);
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allIsAOf($workerClasses, \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface::class);
        $services = $this->services();
        foreach ($workerClasses as $workerClass) {
            $services->set($workerClass);
        }
    }
    public function packageAliasFormat(string $packageAliasFormat) : void
    {
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::PACKAGE_ALIAS_FORMAT, $packageAliasFormat);
    }
    /**
     * @param string[] $sectionOrder
     */
    public function composerSectionOrder(array $sectionOrder) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString($sectionOrder);
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::SECTION_ORDER, $sectionOrder);
    }
    /**
     * @param string[] $inlineSections
     */
    public function composerInlineSections(array $inlineSections) : void
    {
        \MonorepoBuilder20220525\Webmozart\Assert\Assert::allString($inlineSections);
        $parameters = $this->parameters();
        $parameters->set(\Symplify\MonorepoBuilder\ValueObject\Option::INLINE_SECTIONS, $inlineSections);
    }
}
