<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can have a string identifier to translate', function ($enum, $result) {
    expect($enum->toString())->toBe($result);
})->with([
    'Pure Enum' => [Status::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.PENDING'],
    'Int Backed Enum' => [StatusInt::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.PENDING'],
    'String Backed Enum' => [StatusString::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusString.PENDING'],
    'Pascal Case Enum' => [StatusPascalCase::Pending, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase.Pending'],
]);

it('return empty string on translate if is not Laravel')
    ->expect(Status::PENDING->translate())
    ->toBe('');
