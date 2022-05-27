<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\InvalidUniqueId;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can have a unique identifier string', function ($enum, $result) {
    expect($enum->uniqueId())->toBe($result);
})->with([
    'Pure Enum' => [Status::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.PENDING'],
    'Int Backed Enum' => [StatusInt::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.PENDING'],
    'String Backed Enum' => [StatusString::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusString.PENDING'],
    'Pascal Case Enum' => [StatusPascalCase::Pending, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase.Pending'],
]);

it('can get an instance from correct identifier', function ($enumClass, $uniqueId, $result) {
    expect($enumClass::fromUniqueId($uniqueId))->toBe($result);
})->with([
    [Status::class, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.PENDING', Status::PENDING],
    [StatusInt::class, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.PENDING', StatusInt::PENDING],
    [StatusString::class, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusString.PENDING', StatusString::PENDING],
]);

it('throw an exception with wrong uniqueId format', function ($enumClass, $uniqueId) {
    expect(fn () => $enumClass::fromUniqueId($uniqueId))->toThrow(InvalidUniqueId::class, "UniqueId '$uniqueId' has an invalid format");
})->with([
    [Status::class, 'Enums\Station'],
    [StatusInt::class, 'StatusInt.PENDING.PENDING'],
]);

it('throw an exception with wrong namespace or class name', function ($enumClass, $uniqueId) {
    expect(fn () => $enumClass::fromUniqueId($uniqueId))->toThrow(InvalidUniqueId::class, "UniqueId '$uniqueId' has a wrong Namespace or Class name");
})->with([
    [Status::class, 'Enums\Status.PENDING'],
    [StatusInt::class, 'Wrong\Namespace\StatusInt.PENDING'],
]);

it('throw an exception with wrong case name', function ($enumClass, $uniqueId) {
    expect(fn () => $enumClass::fromUniqueId($uniqueId))->toThrow(InvalidUniqueId::class, "There is not 'MISSING' case on the enum");
})->with([
    [Status::class, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.MISSING'],
    [StatusInt::class, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.MISSING'],
]);
