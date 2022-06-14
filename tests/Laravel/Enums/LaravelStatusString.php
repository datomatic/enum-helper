<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Tests\Laravel\Enums;

use Datomatic\EnumHelper\Traits\Laravel\LaravelEnum;

/**
 * @method static string pending()
 * @method static string accepted()
 * @method static string discarded()
 * @method static string noResponse()
 */
enum LaravelStatusString: string
{
    use LaravelEnum;

    case PENDING = 'P';

    case ACCEPTED = 'A';

    case DISCARDED = 'D';

    case NO_RESPONSE = 'N';

    public function color(): string
    {
        return match ($this) {
            self::PENDING => '#000000',
            self::ACCEPTED => '#0000FF',
            self::DISCARDED => '#FF0000',
            self::NO_RESPONSE => '#FFFFFF',
        };
    }
}
