<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Support\Enums;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Traits\EnumDescription;

enum EmptyClass: string
{
    use EnumHelper;
    use EnumDescription;

    public function description(?string $lang = null): string
    {
        return '';
    }
}
