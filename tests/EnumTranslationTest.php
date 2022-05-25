<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;


it('return empty string on translate if is not Laravel')
    ->expect(Status::PENDING->translate())
    ->toBe('');
