<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use Error;

class UndefinedCase extends Error
{
    public function __construct(string $enum, string $case)
    {
        // Matches the error message of invalid Foo::BAR access
        parent::__construct("Undefined constant $enum::$case");
    }
}
