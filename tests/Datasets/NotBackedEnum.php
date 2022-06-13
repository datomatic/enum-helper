<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;

dataset('notBackedEnum', [
    'upper case pure enum' => [Status::class, null],
    'pascal case pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded]],
]);
