<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Support\Enums;

use Datomatic\EnumHelper\EnumHelper;

/**
 * @method static string pending()
 * @method static string Pending()
 * @method static string PENDING()
 * @method static string noResponse()
 * @method static string NO_RESPONSE()
 * @method static string NoResponse()
 */
enum StatusInt: int
{
    use EnumHelper;

    case PENDING = 0;

    case ACCEPTED = 1;

    case DISCARDED = 2;

    case NO_RESPONSE = 3;
}
