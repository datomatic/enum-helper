<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Support\Enums;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Traits\EnumDescription;
use Datomatic\EnumHelper\Traits\EnumLabel;

enum EmptyClass: string
{
    use EnumDescription;
    use EnumHelper;
    use EnumLabel;

    public function description(?string $lang = null): string
    {
        return '';
    }

    public function label(?string $lang = null): string
    {
        return '';
    }
}
