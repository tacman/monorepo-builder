<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Merge\Contract;

use MonorepoBuilder202212\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
interface ComposerJsonDecoratorInterface
{
    public function decorate(ComposerJson $composerJson) : void;
}
