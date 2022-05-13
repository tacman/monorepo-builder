<?php

declare (strict_types=1);
namespace MonorepoBuilder20220513\Symplify\SmartFileSystem\Finder;

use MonorepoBuilder20220513\Nette\Utils\Finder as NetteFinder;
use SplFileInfo;
use MonorepoBuilder20220513\Symfony\Component\Finder\Finder as SymfonyFinder;
use MonorepoBuilder20220513\Symfony\Component\Finder\SplFileInfo as SymfonySplFileInfo;
use MonorepoBuilder20220513\Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Symplify\SmartFileSystem\Tests\Finder\FinderSanitizer\FinderSanitizerTest
 */
final class FinderSanitizer
{
    /**
     * @param NetteFinder|SymfonyFinder|mixed[] $files
     * @return SmartFileInfo[]
     */
    public function sanitize($files) : array
    {
        $smartFileInfos = [];
        foreach ($files as $file) {
            $fileInfo = \is_string($file) ? new \SplFileInfo($file) : $file;
            if (!$this->isFileInfoValid($fileInfo)) {
                continue;
            }
            /** @var string $realPath */
            $realPath = $fileInfo->getRealPath();
            $smartFileInfos[] = new \MonorepoBuilder20220513\Symplify\SmartFileSystem\SmartFileInfo($realPath);
        }
        return $smartFileInfos;
    }
    private function isFileInfoValid(\SplFileInfo $fileInfo) : bool
    {
        return (bool) $fileInfo->getRealPath();
    }
}
