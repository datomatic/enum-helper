<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('does work with from and fromName function', function ($enum, $expectedEnum) {
    expect($enum)->toBe($expectedEnum);
})->with([
    'Int Backed Enum' => [StatusInt::from(0), StatusInt::PENDING],
    'String Backed Enum' => [StatusString::from('P'), StatusString::PENDING],
    'Int Backed Enum from name' => [StatusInt::fromName('PENDING'), StatusInt::PENDING],
    'String Backed Enum from name' => [StatusString::fromName('PENDING'), StatusString::PENDING],
]);

it('does throw exception with wrong from value on BackedEnum int', function () {
    StatusInt::from(10);
})->throws(ValueError::class, '10 is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong from value on BackedEnum string', function () {
    StatusString::from('10');
})->throws(ValueError::class, '"10" is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('does throw exception with wrong fromName value on BackedEnum int', function () {
    StatusInt::fromName('MISSING');
})->throws(ValueError::class, '"MISSING" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong fromName value on BackedEnum string', function () {
    StatusString::fromName('MISSING');
})->throws(ValueError::class, '"MISSING" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('can select a case by name with from() for pure enums', function () {
    expect(Status::from('PENDING'))->toBe(Status::PENDING);
});

it('can returns enum with tryFrom() for pure enums')
    ->expect(Status::tryFrom('PENDING'))
    ->toBe(Status::PENDING);

it('can returns null when selecting a non-existent case by name with tryFrom() for pure enums')
    ->expect(Status::tryFrom('MISSING'))
    ->toBe(null)
    ->not->toThrow(ValueError::class);

it('doesn\'t throw exception with wrong from value on BackedEnum int', function () {
    expect(StatusInt::tryFrom(10))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from value on BackedEnum string', function () {
    expect(StatusString::tryFrom('F'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from name on BackedEnum string', function () {
    expect(StatusString::tryFromName('MISSING'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('can select a case by name with tryFromName() for backed enums')
    ->expect(StatusString::tryFromName('PENDING'))
    ->toBe(StatusString::PENDING);

it('can select a case by name with tryFromName() for pure enums')
    ->expect(StatusPascalCase::tryFromName('Pending'))
    ->toBe(StatusPascalCase::Pending);
