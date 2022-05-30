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
enum LaravelStatusString: string
{
    use EnumLaravelDescription;

    case PENDING = 'P';

    case ACCEPTED = 'A';

    case DISCARDED = 'D';

    case NO_RESPONSE = 'N';
}
