<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use Exception;

class InvalidUniqueId extends Exception
{
    /**
     * @return InvalidUniqueId
     */
    public static function wrongClassName(string $uniqueId): self
    {
        return new self("UniqueId '$uniqueId' has a wrong Namespace or Class name");
    }

    /**
     * @return InvalidUniqueId
     */
    public static function caseNotPresent(string $case): self
    {
        return new self("There is not '$case' case on the enum");
    }

    /**
     * @return InvalidUniqueId
     */
    public static function uniqueIdFormatIsInvalid(string $uniqueId): self
    {
        return new self("UniqueId '$uniqueId' has an invalid format");
    }
}
