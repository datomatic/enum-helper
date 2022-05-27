<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use Exception;

class InvalidUniqueId extends Exception
{
    public static function wrongClassName(string $uniqueId)
    {
        return new self("UniqueId '$uniqueId' has a wrong Namespace or Class name");
    }

    public static function caseNotPresent(string $case)
    {
        return new self("There is not '$case' case on the enum");
    }

    public static function uniqueIdFormatIsInvalid(string $uniqueId)
    {
        return new self("UniqueId '$uniqueId' has an invalid format");
    }
}
