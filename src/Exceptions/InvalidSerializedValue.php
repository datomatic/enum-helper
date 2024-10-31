<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use UnexpectedValueException;

class InvalidSerializedValue extends UnexpectedValueException
{
    public static function wrongClassName(string $value): self
    {
        return new self("'$value' has a wrong Namespace or Class name");
    }

    public static function caseNotPresent(string $case): self
    {
        return new self("There is not '$case' case on the enum");
    }

    public static function serializedFormatIsInvalid(string $value): self
    {
        return new self("'$value' has an invalid format");
    }
}
