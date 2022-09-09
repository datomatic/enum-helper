<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can be used as a static method to get value', function ($enumClass, $enumMethod, $result) {
    expect($enumClass::$enumMethod())->toBe($result);
})->with([
    'Pure Enum Camel Case' => [PureEnum::class, 'pending', 'PENDING'],
    'Pure Enum Upper Case' => [PureEnum::class, 'PENDING', 'PENDING'],
    'Pure Enum Pascal Case' => [PureEnum::class, 'Pending', 'PENDING'],
    'Pure Enum Camel Case multiword' => [PureEnum::class, 'noResponse', 'NO_RESPONSE'],
    'Pure Enum Upper Case multiword' => [PureEnum::class, 'NO_RESPONSE', 'NO_RESPONSE'],
    'Pure Enum Pascal Case multiword' => [PureEnum::class, 'NoResponse', 'NO_RESPONSE'],
    'Pure Pascal Enum Camel Case' => [PascalCasePureEnum::class, 'pending', 'Pending'],
    'Pure Pascal Enum Upper Case' => [PascalCasePureEnum::class, 'PENDING', 'Pending'],
    'Pure Pascal Enum Pascal Case' => [PascalCasePureEnum::class, 'Pending', 'Pending'],
    'Pure Pascal Enum Camel Case multiword' => [PascalCasePureEnum::class, 'noResponse', 'NoResponse'],
    'Pure Pascal Enum Upper Case multiword' => [PascalCasePureEnum::class, 'NO_RESPONSE', 'NoResponse'],
    'Pure Pascal Enum Pascal Case multiword' => [PascalCasePureEnum::class, 'NoResponse', 'NoResponse'],
    'String Backed Enum Camel Case' => [StringBackedEnum::class, 'pending', 'P'],
    'String Backed Enum Upper Case' => [StringBackedEnum::class, 'PENDING', 'P'],
    'String Backed Enum Pascal Case' => [StringBackedEnum::class, 'Pending', 'P'],
    'String Backed Enum Camel Case multiword' => [StringBackedEnum::class, 'noResponse', 'N'],
    'String Backed Enum Upper Case multiword' => [StringBackedEnum::class, 'NO_RESPONSE', 'N'],
    'String Backed Enum Pascal Case multiword' => [StringBackedEnum::class, 'NoResponse', 'N'],
    'Int Backed Enum Camel Case' => [IntBackedEnum::class, 'pending', 0],
    'Int Backed Enum Upper Case' => [IntBackedEnum::class, 'PENDING', 0],
    'Int Backed Enum Pascal Case' => [IntBackedEnum::class, 'Pending', 0],
    'Int Backed Enum Camel Case multiword' => [IntBackedEnum::class, 'noResponse', 3],
    'Int Backed Enum Upper Case multiword' => [IntBackedEnum::class, 'NO_RESPONSE', 3],
    'Int Backed Enum Pascal Case multiword' => [IntBackedEnum::class, 'NoResponse', 3],
]);

it('can be invoked as an instance as a pure enum', function () {
    $status = PureEnum::PENDING;

    expect($status())->toBe('PENDING');
});

it('can be invoked as an instance as a backed enum', function () {
    $status = IntBackedEnum::PENDING;

    expect($status())->toBe(0);
    expect($status())->toBe($status->value);
});

it('throws an error when a nonexistent case is being used for pure enums', function () {
    PureEnum::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\PureEnum::INVALID');

it('throws an error when a nonexistent case is being used for backed enums', function () {
    StringBackedEnum::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum::INVALID');

test('empty class')->expect(EmptyClass::cases())->toBe([]);
