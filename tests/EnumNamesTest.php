<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can return an array of case names', function ($enumClass, $result) {
    expect($enumClass::names())->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'PascalCase Pure enum' => [PascalCasePureEnum::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
    'String Backed enum' => [StringBackedEnum::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'Int Backed enum' => [IntBackedEnum::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
]);

it('can return an array of case names with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::names($cases))->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [PureEnum::NO_RESPONSE, PureEnum::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'PascalCase Pure enum' => [PascalCasePureEnum::class, [PascalCasePureEnum::Accepted, PascalCasePureEnum::Discarded], ['Accepted', 'Discarded']],
    'String Backed enum' => [StringBackedEnum::class, [StringBackedEnum::NO_RESPONSE, StringBackedEnum::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'Int Backed enum' => [IntBackedEnum::class, [IntBackedEnum::NO_RESPONSE, IntBackedEnum::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
]);

it('throw an EmptyCases exception calling names method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::names($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array of names', function ($enumClass, $result) {
    expect($enumClass::namesByValue())->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [
        'PENDING' => 'PENDING',
        'ACCEPTED' => 'ACCEPTED',
        'DISCARDED' => 'DISCARDED',
        'NO_RESPONSE' => 'NO_RESPONSE',
    ]],
    'PascalCase Pure enum' => [PascalCasePureEnum::class, [
        'Pending' => 'Pending',
        'Accepted' => 'Accepted',
        'Discarded' => 'Discarded',
        'NoResponse' => 'NoResponse',
    ]],
    'String Backed enum' => [StringBackedEnum::class, [
        'P' => 'PENDING',
        'A' => 'ACCEPTED',
        'D' => 'DISCARDED',
        'N' => 'NO_RESPONSE',
    ]],
    'Int Backed enum' => [IntBackedEnum::class, [
        0 => 'PENDING',
        1 => 'ACCEPTED',
        2 => 'DISCARDED',
        3 => 'NO_RESPONSE',
    ]],
]);

it('can return an associative array of names with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::namesByValue($cases))->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [PureEnum::NO_RESPONSE, PureEnum::DISCARDED], [
        'NO_RESPONSE' => 'NO_RESPONSE',
        'DISCARDED' => 'DISCARDED', ]],
    'PascalCase Pure enum' => [PascalCasePureEnum::class, [PascalCasePureEnum::Accepted, PascalCasePureEnum::Discarded], [
        'Accepted' => 'Accepted',
        'Discarded' => 'Discarded', ]],
    'String Backed enum' => [StringBackedEnum::class, [StringBackedEnum::NO_RESPONSE, StringBackedEnum::DISCARDED], [
        'N' => 'NO_RESPONSE',
        'D' => 'DISCARDED',
    ]],
    'Int Backed enum' => [IntBackedEnum::class, [IntBackedEnum::NO_RESPONSE, IntBackedEnum::DISCARDED], [
        3 => 'NO_RESPONSE',
        2 => 'DISCARDED',
    ]],
]);

it('throw an EmptyCases exception calling namesByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::namesByValue($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'Pure enum' => [PureEnum::class, []],
    'Backed enum' => [StringBackedEnum::class, []],
    'Empty Cases enum' => [EmptyClass::class, null],
]);
