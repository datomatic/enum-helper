<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Support\Enums;

use Datomatic\EnumHelper\Contracts\Comparable;
use Datomatic\EnumHelper\Traits\ComparesByValue;

enum NumericStringBackedEnum: string implements Comparable
{
    use ComparesByValue;

    case NINE = '9';

    case TEN = '10';
}
