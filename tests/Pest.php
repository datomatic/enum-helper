<?php

declare(strict_types=1);

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\EnumWithDescription;
use Datomatic\EnumHelper\Tests\Laravel\TestCase;

uses(TestCase::class)->in('Laravel');

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

/**
 * @method static string pending()
 * @method static string Pending()
 * @method static string PENDING()
 * @method static string noResponse()
 * @method static string NO_RESPONSE()
 * @method static string NoResponse()
 * @method static string INVALID()
 */
enum StatusString: string
{
    use EnumWithDescription;

    case PENDING = 'P';

    case ACCEPTED = 'A';

    case DISCARDED = 'D';

    case NO_RESPONSE = 'N';

    public function description(): string
    {
        return match ($this) {
            self::PENDING => 'Await decision',
            self::ACCEPTED => 'Reconized valid',
            self::DISCARDED => 'No longer useful',
            self::NO_RESPONSE => 'No response',
        };
    }
}

/**
 * @method static string pending()
 * @method static string Pending()
 * @method static string PENDING()
 * @method static string noResponse()
 * @method static string NO_RESPONSE()
 * @method static string NoResponse()
 * @method static string INVALID()
 */
enum Status
{
    use EnumWithDescription;

    case PENDING;

    case ACCEPTED;

    case DISCARDED;

    case NO_RESPONSE;

    public function description(): string
    {
        return match ($this) {
            self::PENDING => 'Await decision',
            self::ACCEPTED => 'Reconized valid',
            self::DISCARDED => 'No longer useful',
            self::NO_RESPONSE => 'No response',
        };
    }
}

/**
 * @method static string pending()
 * @method static string Pending()
 * @method static string PENDING()
 * @method static string noResponse()
 * @method static string NO_RESPONSE()
 * @method static string NoResponse()
 */
enum StatusPascalCase
{
    use EnumHelper;

    case Pending;

    case Accepted;

    case Discarded;

    case NoResponse;
}

enum EmptyClass: string
{
}
