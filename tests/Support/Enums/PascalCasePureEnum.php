<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Support\Enums;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Traits\EnumDescription;
use Datomatic\EnumHelper\Traits\EnumLabel;
use Datomatic\EnumHelper\Traits\EnumSerialization;

/**
 * @method static string pending()
 * @method static string Pending()
 * @method static string PENDING()
 * @method static string noResponse()
 * @method static string NO_RESPONSE()
 * @method static string NoResponse()
 */
enum PascalCasePureEnum
{
    use EnumDescription;
    use EnumHelper;
    use EnumLabel;
    use EnumSerialization;

    case Pending;

    case Accepted;

    case Discarded;

    case NoResponse;

    public function description(?string $lang = null): string
    {
        return match ($this) {
            self::Pending => 'Await decision',
            self::Accepted => 'Recognized valid',
            self::Discarded => 'No longer useful',
            self::NoResponse => 'No response',
        };
    }

    public function label(?string $lang = null): string
    {
        return match ($this) {
            self::Pending => 'Await decision',
            self::Accepted => 'Recognized valid',
            self::Discarded => 'No longer useful',
            self::NoResponse => 'No response',
        };
    }
}
