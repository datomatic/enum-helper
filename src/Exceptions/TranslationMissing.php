<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Exceptions;

use RuntimeException;

class TranslationMissing extends RuntimeException
{
    public function __construct(string $enum, string $method)
    {
        parent::__construct("Translation missing on $enum for $method property");
    }
}
