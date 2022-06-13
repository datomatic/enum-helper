<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use UnexpectedValueException;

class EmptyCases extends UnexpectedValueException
{
    public function __construct(string $enumClass)
    {
        // Matches the error message of invalid Foo::BAR access
        parent::__construct("The enum $enumClass has empty case or you pass empty array as parameter");
    }
}
