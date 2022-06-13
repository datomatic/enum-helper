<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use UnexpectedValueException;

class UndefinedCase extends UnexpectedValueException
{
    public function __construct(string $enum, string $case)
    {
        parent::__construct("Undefined constant $enum::$case");
    }
}
