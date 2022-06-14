<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can return an array of case values', function ($enumClass, $result) {
    expect($enumClass::values())->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, ['P', 'A', 'D', 'N']],
    'Int Backed enum' => [StatusInt::class, [0, 1, 2, 3]],
]);

it('can return an array of case values with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::values($cases))->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], ['N', 'D']],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [3, 2]],
]);

it('throw an EmptyCases exception calling values method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::values($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'backed enum' => [StatusString::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);

it('throw an NotBackedEnum exception with pure enum calling values method', function ($enumClass, $cases) {
    expect(fn () => $enumClass::values($cases))->toThrow(NotBackedEnum::class, "$enumClass is not a BackedEnum");
})->with('notBackedEnum');

it('can return an associative array of values', function ($enumClass, $result) {
    expect($enumClass::valuesByName())->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, [
        'PENDING' => 'P',
        'ACCEPTED' => 'A',
        'DISCARDED' => 'D',
        'NO_RESPONSE' => 'N',
    ]],
    'Int Backed enum' => [StatusInt::class, [
        'PENDING' => 0,
        'ACCEPTED' => 1,
        'DISCARDED' => 2,
        'NO_RESPONSE' => 3,
    ]],
]);

it('can return an associative array of values with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::valuesByName($cases))->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'NO_RESPONSE' => 'N',
        'DISCARDED' => 'D',
    ]],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [
        'NO_RESPONSE' => 3,
        'DISCARDED' => 2,
    ]],
]);

it('throw an EmptyCases exception calling namesByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::valuesByName($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'backed enum' => [StatusString::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);

it('throw an NotBackedEnum exception with pure enum calling namesByValue method', function ($enumClass, $cases) {
    expect(fn () => $enumClass::valuesByName($cases))->toThrow(NotBackedEnum::class, "$enumClass is not a BackedEnum");
})->with('notBackedEnum');
