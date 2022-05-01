<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Merge\Contract;

use MonorepoBuilder20220501\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
interface ComposerKeyMergerInterface
{
    public function merge(\MonorepoBuilder20220501\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson $mainComposerJson, \MonorepoBuilder20220501\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson $newComposerJson) : void;
}
