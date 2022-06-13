<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use UnexpectedValueException;

class UndefinedStaticMethod extends UnexpectedValueException
{
    public function __construct(string $enum, string $method)
    {
        parent::__construct("Undefined static method $enum::$method");
    }
}
