<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use LogicException;

class NotBackedEnum extends LogicException
{
    public function __construct(string $enumClass)
    {
        parent::__construct($enumClass ." is not a BackedEnum");
    }
}
