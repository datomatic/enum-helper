<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;

it('return empty string on translate if is not Laravel')
    ->expect(StatusPascalCase::Pending->translate())
    ->toBe('');
