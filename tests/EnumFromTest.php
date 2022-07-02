<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('does work with from method', function ($enumCass, $value, $result) {
    expect($enumCass::from($value))->toBe($result);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Int Backed Enum' => [StatusInt::class, 0, StatusInt::PENDING],
    'String Backed Enum' => [StatusString::class, 'P', StatusString::PENDING],
]);

it('throw ValueError exception with from method', function ($enumClass, $value) {
    expect(fn () => $enumClass::from($value))->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [Status::class, 'MISSING'],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'MISSING'],
    'Int Backed Enum' => [StatusInt::class, 10],
    'String Backed Enum' => [StatusString::class, 'M'],
]);

it('does work with tryFrom method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFrom($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pure Enum missing' => [Status::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Pascal Case Pure Enum missing' => [StatusPascalCase::class, 'MISSING', null],
    'Int Backed Enum' => [StatusInt::class, 0, StatusInt::PENDING],
    'Int Backed Enum missing' => [StatusInt::class, 10, null],
    'String Backed Enum' => [StatusString::class, 'P', StatusString::PENDING],
    'String Backed Enum missing' => [StatusString::class, 'M', null],
]);

it('does work with fromName method', function ($enumCass, $value, $result) {
    expect($enumCass::fromName($value))->toBe($result);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Int Backed Enum' => [StatusInt::class, 'PENDING', StatusInt::PENDING],
    'String Backed Enum' => [StatusString::class, 'PENDING', StatusString::PENDING],
]);

it('throw ValueError exception with fromName method', function ($enumClass, $value) {
    expect(fn () => $enumClass::fromName($value))->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [Status::class, 'MISSING'],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'MISSING'],
    'Int Backed Enum' => [StatusInt::class, 'MISSING'],
    'String Backed Enum' => [StatusString::class, 'MISSING'],
]);

it('does work with tryFromName method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFromName($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pure Enum missing' => [Status::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Pascal Case Pure Enum missing' => [StatusPascalCase::class, 'MISSING', null],
    'Int Backed Enum' => [StatusInt::class, 'PENDING', StatusInt::PENDING],
    'Int Backed Enum missing' => [StatusInt::class, 'MISSING', null],
    'String Backed Enum' => [StatusString::class, 'PENDING', StatusString::PENDING],
    'String Backed Enum missing' => [StatusString::class, 'MISSING', null],
]);

it('does work with fromValue method', function ($enumCass, $value, $result) {
    expect($enumCass::fromValue($value))->toBe($result);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Int Backed Enum' => [StatusInt::class, 0, StatusInt::PENDING],
    'String Backed Enum' => [StatusString::class, 'P', StatusString::PENDING],
]);


it('does work with tryFromValue method', function ($enumCass, $value, $result) {
    expect($enumCass::tryFromValue($value))->toBe($result)->not->toThrow(ValueError::class);
})->with([
    'Pure Enum' => [Status::class, 'PENDING', Status::PENDING],
    'Pure Enum missing' => [Status::class, 'MISSING', null],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, 'Pending', StatusPascalCase::Pending],
    'Pascal Case Pure Enum missing' => [StatusPascalCase::class, 'MISSING', null],
    'Int Backed Enum' => [StatusInt::class, 0, StatusInt::PENDING],
    'Int Backed Enum missing' => [StatusInt::class, 10, null],
    'String Backed Enum' => [StatusString::class, 'P', StatusString::PENDING],
    'String Backed Enum missing' => [StatusString::class, 'M', null],
]);

