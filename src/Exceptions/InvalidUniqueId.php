<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use UnexpectedValueException;

class InvalidUniqueId extends UnexpectedValueException
{
    public static function wrongClassName(string $uniqueId): self
    {
        return new self("UniqueId '$uniqueId' has a wrong Namespace or Class name");
    }

    public static function caseNotPresent(string $case): self
    {
        return new self("There is not '$case' case on the enum");
    }

    public static function uniqueIdFormatIsInvalid(string $uniqueId): self
    {
        return new self("UniqueId '$uniqueId' has an invalid format");
    }
}
