<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can return an array of case names', function ($enumClass, $result) {
    expect($enumClass::names())->toBe($result);
})->with([
    'Pure enum' => [Status::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'PascalCase Pure enum' => [StatusPascalCase::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
    'String Backed enum' => [StatusString::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'Int Backed enum' => [StatusInt::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
]);

it('can return an array of case names with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::names($cases))->toBe($result);
})->with([
    'Pure enum' => [Status::class, [Status::NO_RESPONSE, Status::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'PascalCase Pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded], ['Accepted', 'Discarded']],
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
]);

it('throw an EmptyCases exception calling names method with empty cases', function ($enumClass, $cases) {
    expect(fn() => $enumClass::names($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array of names', function ($enumClass, $result) {
    expect($enumClass::namesByValue())->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, [
        'P' => 'PENDING',
        'A' => 'ACCEPTED',
        'D' => 'DISCARDED',
        'N' => 'NO_RESPONSE',
    ]],
    'Int Backed enum' => [StatusInt::class, [
        0 => 'PENDING',
        1 => 'ACCEPTED',
        2 => 'DISCARDED',
        3 => 'NO_RESPONSE',
    ]],
]);

it('throw an NotBackedEnum exception with pure enum calling namesByValue method', function ($enumClass) {
    expect(fn() => $enumClass::namesByValue())->toThrow(NotBackedEnum::class, "$enumClass is not a BackedEnum");
})->with([
    [Status::class],
    [StatusPascalCase::class],
]);

it('can return an associative array of names with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::namesByValue($cases))->toBe($result);
})->with([
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'N' => 'NO_RESPONSE',
        'D' => 'DISCARDED',
    ]],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [
        3 => 'NO_RESPONSE',
        2 => 'DISCARDED',
    ]],
]);

it('can return an associative array [name/value => name] based on enum type', function ($enumClass, $result) {
    expect($enumClass::namesAsSelect())->toBe($result);
})->with([
    'Pure enum' => [Status::class, [
        'PENDING' => 'PENDING',
        'ACCEPTED' => 'ACCEPTED',
        'DISCARDED' => 'DISCARDED',
        'NO_RESPONSE' => 'NO_RESPONSE',
    ]],
    'PascalCase Pure enum' => [StatusPascalCase::class, [
        'Pending' => 'Pending',
        'Accepted' => 'Accepted',
        'Discarded' => 'Discarded',
        'NoResponse' => 'NoResponse',
    ]],
    'String Backed enum' => [StatusString::class, [
        'P' => 'PENDING',
        'A' => 'ACCEPTED',
        'D' => 'DISCARDED',
        'N' => 'NO_RESPONSE',
    ]],
    'Int Backed enum' => [StatusInt::class, [
        0 => 'PENDING',
        1 => 'ACCEPTED',
        2 => 'DISCARDED',
        3 => 'NO_RESPONSE',
    ]],
]);

it('can return an associative array [name/value => name] with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::namesAsSelect($cases))->toBe($result);
})->with([
    'Pure enum' => [Status::class, [Status::NO_RESPONSE, Status::DISCARDED], [
        'NO_RESPONSE' => 'NO_RESPONSE',
        'DISCARDED' => 'DISCARDED',]],
    'PascalCase Pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded], [
        'Accepted' => 'Accepted',
        'Discarded' => 'Discarded',]],
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'N' => 'NO_RESPONSE',
        'D' => 'DISCARDED',
    ]],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [
        3 => 'NO_RESPONSE',
        2 => 'DISCARDED',
    ]],
]);

it('throw an NotBackedEnum exception with pure enum calling namesByValue method with param', function ($enumClass, $cases) {
    expect(fn() => $enumClass::namesByValue($cases))->toThrow(NotBackedEnum::class, "$enumClass is not a BackedEnum");
})->with('notBackedEnum');

it('throw an EmptyCases exception calling namesByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn() => $enumClass::namesByValue($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'backed enum' => [StatusString::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);

it('throw an EmptyCases exception calling namesAsSelect method with empty cases', function ($enumClass, $cases) {
    expect(fn() => $enumClass::namesAsSelect($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');
