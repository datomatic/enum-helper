<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can be used as a static method to get value', function ($enumClass, $enumMethod, $result) {
    expect($enumClass::$enumMethod())->toBe($result);
})->with([
    'Pure Enum Camel Case' => [Status::class, 'pending', 'PENDING'],
    'Pure Enum Upper Case' => [Status::class, 'PENDING', 'PENDING'],
    'Pure Enum Pascal Case' => [Status::class, 'Pending', 'PENDING'],
    'Pure Enum Camel Case multiword' => [Status::class, 'noResponse', 'NO_RESPONSE'],
    'Pure Enum Upper Case multiword' => [Status::class, 'NO_RESPONSE', 'NO_RESPONSE'],
    'Pure Enum Pascal Case multiword' => [Status::class, 'NoResponse', 'NO_RESPONSE'],
    'Pure Pascal Enum Camel Case' => [StatusPascalCase::class, 'pending', 'Pending'],
    'Pure Pascal Enum Upper Case' => [StatusPascalCase::class, 'PENDING', 'Pending'],
    'Pure Pascal Enum Pascal Case' => [StatusPascalCase::class, 'Pending', 'Pending'],
    'Pure Pascal Enum Camel Case multiword' => [StatusPascalCase::class, 'noResponse', 'NoResponse'],
    'Pure Pascal Enum Upper Case multiword' => [StatusPascalCase::class, 'NO_RESPONSE', 'NoResponse'],
    'Pure Pascal Enum Pascal Case multiword' => [StatusPascalCase::class, 'NoResponse', 'NoResponse'],
    'String Backed Enum Camel Case' => [StatusString::class, 'pending', 'P'],
    'String Backed Enum Upper Case' => [StatusString::class, 'PENDING', 'P'],
    'String Backed Enum Pascal Case' => [StatusString::class, 'Pending', 'P'],
    'String Backed Enum Camel Case multiword' => [StatusString::class, 'noResponse', 'N'],
    'String Backed Enum Upper Case multiword' => [StatusString::class, 'NO_RESPONSE', 'N'],
    'String Backed Enum Pascal Case multiword' => [StatusString::class, 'NoResponse', 'N'],
    'Int Backed Enum Camel Case' => [StatusInt::class, 'pending', 0],
    'Int Backed Enum Upper Case' => [StatusInt::class, 'PENDING', 0],
    'Int Backed Enum Pascal Case' => [StatusInt::class, 'Pending', 0],
    'Int Backed Enum Camel Case multiword' => [StatusInt::class, 'noResponse', 3],
    'Int Backed Enum Upper Case multiword' => [StatusInt::class, 'NO_RESPONSE', 3],
    'Int Backed Enum Pascal Case multiword' => [StatusInt::class, 'NoResponse', 3],
]);

it('can be invoked as an instance as a pure enum', function () {
    $status = Status::PENDING;

    expect($status())->toBe('PENDING');
});

it('can be invoked as an instance as a backed enum', function () {
    $status = StatusInt::PENDING;

    expect($status())->toBe(0);
    expect($status())->toBe($status->value);
});

it('throws an error when a nonexistent case is being used for pure enums', function () {
    Status::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\Status::INVALID');

it('throws an error when a nonexistent case is being used for backed enums', function () {
    StatusString::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\StatusString::INVALID');

test('empty class')->expect(EmptyClass::cases())->toBe([]);
