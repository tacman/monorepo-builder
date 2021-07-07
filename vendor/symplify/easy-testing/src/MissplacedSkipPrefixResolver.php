<?php

declare (strict_types=1);
namespace MonorepoBuilder20210707\Symplify\EasyTesting;

use MonorepoBuilder20210707\Nette\Utils\Strings;
use MonorepoBuilder20210707\Symplify\EasyTesting\ValueObject\Prefix;
use MonorepoBuilder20210707\Symplify\EasyTesting\ValueObject\SplitLine;
use MonorepoBuilder20210707\Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Symplify\EasyTesting\Tests\MissingSkipPrefixResolver\MissingSkipPrefixResolverTest
 */
final class MissplacedSkipPrefixResolver
{
    /**
     * @param SmartFileInfo[] $fixtureFileInfos
     * @return array<string, SmartFileInfo[]>
     */
    public function resolve(array $fixtureFileInfos) : array
    {
        $invalidFileInfos = ['incorrect_skips' => [], 'missing_skips' => []];
        foreach ($fixtureFileInfos as $fixtureFileInfo) {
            $hasNameSkipStart = $this->hasNameSkipStart($fixtureFileInfo);
            $fileContents = $fixtureFileInfo->getContents();
            $hasSplitLine = (bool) \MonorepoBuilder20210707\Nette\Utils\Strings::match($fileContents, \MonorepoBuilder20210707\Symplify\EasyTesting\ValueObject\SplitLine::SPLIT_LINE_REGEX);
            if ($hasNameSkipStart && $hasSplitLine) {
                $invalidFileInfos['incorrect_skips'][] = $fixtureFileInfo;
                continue;
            }
            if (!$hasNameSkipStart && !$hasSplitLine) {
                $invalidFileInfos['missing_skips'][] = $fixtureFileInfo;
                continue;
            }
        }
        return $invalidFileInfos;
    }
    private function hasNameSkipStart(\MonorepoBuilder20210707\Symplify\SmartFileSystem\SmartFileInfo $fixtureFileInfo) : bool
    {
        return (bool) \MonorepoBuilder20210707\Nette\Utils\Strings::match($fixtureFileInfo->getBasenameWithoutSuffix(), \MonorepoBuilder20210707\Symplify\EasyTesting\ValueObject\Prefix::SKIP_PREFIX_REGEX);
    }
}