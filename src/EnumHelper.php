<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper;

use Datomatic\EnumHelper\Traits\EnumEquality;
use Datomatic\EnumHelper\Traits\EnumFrom;
use Datomatic\EnumHelper\Traits\EnumLocalization;
use Datomatic\EnumHelper\Traits\EnumNames;
use Datomatic\EnumHelper\Traits\EnumValues;
use Datomatic\EnumHelper\Traits\InvokableEnum;

trait EnumHelper
{
    use InvokableEnum;
    use EnumNames;
    use EnumValues;
    use EnumFrom;
    use EnumEquality;
    use EnumLocalization;

    protected static function getCases(array $cases): array
    {
        if (empty($cases)) {
            $cases = static::cases();
        }

        return $cases;
    }
}
