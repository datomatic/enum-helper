<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Laravel\Enums;

use Datomatic\EnumHelper\Traits\EnumLaravelDescription;

/**
 * @method static string pending()
 * @method static string accepted()
 * @method static string discarded()
 * @method static string noResponse()
 */
enum LaravelStatus
{
    use EnumLaravelDescription;

    case PENDING;

    case ACCEPTED;

    case DISCARDED;

    case NO_RESPONSE;
}
