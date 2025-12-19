<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('does work with wrap method', function ($enumCass, $value, $result) {
    expect($enumCass::wrap($value))->toBe($result);
    expect(fn () => $enumCass::wrap($value))->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pure Enum2' => [PureEnum::class, PureEnum::PENDING, PureEnum::PENDING],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Pascal Case Pure Enum2' => [PascalCasePureEnum::class, PascalCasePureEnum::Pending, PascalCasePureEnum::Pending],
    'Int Backed Enum' => [IntBackedEnum::class, 0, IntBackedEnum::PENDING],
    'Int Backed Enum2' => [IntBackedEnum::class, IntBackedEnum::PENDING, IntBackedEnum::PENDING],
    'Int Backed Enum3' => [IntBackedEnum::class, 'PENDING', IntBackedEnum::PENDING],
    'Int Backed Enum4' => [IntBackedEnum::class, '0', IntBackedEnum::PENDING],
    'String Backed Enum' => [StringBackedEnum::class, 'P', StringBackedEnum::PENDING],
    'String Backed Enum2' => [StringBackedEnum::class, StringBackedEnum::PENDING, StringBackedEnum::PENDING],
    'String Backed Enum3' => [StringBackedEnum::class, 'PENDING', StringBackedEnum::PENDING],
    'Pure Enum missing' => [PureEnum::class, 'MISSING', null],
    'Pascal Case Pure Enum missing' => [PascalCasePureEnum::class, 'MISSING', null],
    'Int Backed Enum missing' => [IntBackedEnum::class, 10, null],
    'String Backed Enum missing' => [StringBackedEnum::class, 'M', null],
]);

it('does work with from method', function ($enumCass, $value, $result) {
    expect($enumCass::from($value))->toBe($result);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Int Backed Enum' => [IntBackedEnum::class, 0, IntBackedEnum::PENDING],
    'String Backed Enum' => [StringBackedEnum::class, 'P', StringBackedEnum::PENDING],
]);

it('throw ValueError exception with from method', function ($enumClass, $value) {
    expect(fn () => $enumClass::from($value))->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'MISSING'],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'MISSING'],
    'Int Backed Enum' => [IntBackedEnum::class, 10],
    'String Backed Enum' => [StringBackedEnum::class, 'M'],
]);

it('throws ValueError for invalid backing value in strict mode', function () {
    expect(fn () => StringBackedEnum::wrap('non-existent-value', true))
        ->toThrow(ValueError::class);
});

it('returns null for invalid backing value when not in strict mode', function () {
    expect(StringBackedEnum::wrap('non-existent-value'))
        ->toBeNull();
});

it('does work with tryFrom method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFrom($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pure Enum missing' => [PureEnum::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Pascal Case Pure Enum missing' => [PascalCasePureEnum::class, 'MISSING', null],
    'Int Backed Enum' => [IntBackedEnum::class, 0, IntBackedEnum::PENDING],
    'Int Backed Enum missing' => [IntBackedEnum::class, 10, null],
    'String Backed Enum' => [StringBackedEnum::class, 'P', StringBackedEnum::PENDING],
    'String Backed Enum missing' => [StringBackedEnum::class, 'M', null],
]);

it('does work with fromName method', function ($enumCass, $value, $result) {
    expect($enumCass::fromName($value))->toBe($result);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Int Backed Enum' => [IntBackedEnum::class, 'PENDING', IntBackedEnum::PENDING],
    'String Backed Enum' => [StringBackedEnum::class, 'PENDING', StringBackedEnum::PENDING],
]);

it('throw ValueError exception with fromName method', function ($enumClass, $value) {
    expect(fn () => $enumClass::fromName($value))->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'MISSING'],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'MISSING'],
    'Int Backed Enum' => [IntBackedEnum::class, 'MISSING'],
    'String Backed Enum' => [StringBackedEnum::class, 'MISSING'],
]);

it('does work with tryFromName method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFromName($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pure Enum missing' => [PureEnum::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Pascal Case Pure Enum missing' => [PascalCasePureEnum::class, 'MISSING', null],
    'Int Backed Enum' => [IntBackedEnum::class, 'PENDING', IntBackedEnum::PENDING],
    'Int Backed Enum missing' => [IntBackedEnum::class, 'MISSING', null],
    'String Backed Enum' => [StringBackedEnum::class, 'PENDING', StringBackedEnum::PENDING],
    'String Backed Enum missing' => [StringBackedEnum::class, 'MISSING', null],
]);

it('does work with fromValue method', function ($enumCass, $value, $result) {
    expect($enumCass::fromValue($value))->toBe($result);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Int Backed Enum' => [IntBackedEnum::class, 0, IntBackedEnum::PENDING],
    'String Backed Enum' => [StringBackedEnum::class, 'P', StringBackedEnum::PENDING],
]);

it('does work with tryFromValue method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFromValue($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [PureEnum::class, 'PENDING', PureEnum::PENDING],
    'Pure Enum missing' => [PureEnum::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, 'Pending', PascalCasePureEnum::Pending],
    'Pascal Case Pure Enum missing' => [PascalCasePureEnum::class, 'MISSING', null],
    'Int Backed Enum' => [IntBackedEnum::class, 0, IntBackedEnum::PENDING],
    'Int Backed Enum missing' => [IntBackedEnum::class, 10, null],
    'String Backed Enum' => [StringBackedEnum::class, 'P', StringBackedEnum::PENDING],
    'String Backed Enum missing' => [StringBackedEnum::class, 'M', null],
]);
