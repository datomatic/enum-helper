<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can return an array of case values', function ($enumClass, $result) {
    expect($enumClass::values())->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'Pure Pascal Case enum' => [PascalCasePureEnum::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
    'String Backed enum' => [StringBackedEnum::class, ['P', 'A', 'D', 'N']],
    'Int Backed enum' => [IntBackedEnum::class, [0, 1, 2, 3]],
]);

it('can return an array of case values with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::values($cases))->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [PureEnum::NO_RESPONSE, PureEnum::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'Pure Pascal Case enum' => [PascalCasePureEnum::class, [PascalCasePureEnum::NoResponse, PascalCasePureEnum::Discarded], ['NoResponse', 'Discarded']],
    'String Backed enum' => [StringBackedEnum::class, [StringBackedEnum::NO_RESPONSE, StringBackedEnum::DISCARDED], ['N', 'D']],
    'Int Backed enum' => [IntBackedEnum::class, [IntBackedEnum::NO_RESPONSE, IntBackedEnum::DISCARDED], [3, 2]],
]);

it('throw an EmptyCases exception calling values method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::values($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'backed enum' => [StringBackedEnum::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);

it('can return an associative array of values', function ($enumClass, $result) {
    expect($enumClass::valuesByName())->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [
        'PENDING' => 'PENDING',
        'ACCEPTED' => 'ACCEPTED',
        'DISCARDED' => 'DISCARDED',
        'NO_RESPONSE' => 'NO_RESPONSE',
    ]],
    'Pure Pascal Case enum' => [PascalCasePureEnum::class, [
        'Pending' => 'Pending',
        'Accepted' => 'Accepted',
        'Discarded' => 'Discarded',
        'NoResponse' => 'NoResponse',
    ]],
    'String Backed enum' => [StringBackedEnum::class, [
        'PENDING' => 'P',
        'ACCEPTED' => 'A',
        'DISCARDED' => 'D',
        'NO_RESPONSE' => 'N',
    ]],
    'Int Backed enum' => [IntBackedEnum::class, [
        'PENDING' => 0,
        'ACCEPTED' => 1,
        'DISCARDED' => 2,
        'NO_RESPONSE' => 3,
    ]],
]);

it('can return an associative array of values with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::valuesByName($cases))->toBe($result);
})->with([
    'Pure enum' => [PureEnum::class, [PureEnum::NO_RESPONSE, PureEnum::DISCARDED], [
        'NO_RESPONSE' => 'NO_RESPONSE',
        'DISCARDED' => 'DISCARDED',
    ]],
    'Pure Pascal Case enum' => [PascalCasePureEnum::class, [PascalCasePureEnum::NoResponse, PascalCasePureEnum::Discarded], [
        'NoResponse' => 'NoResponse',
        'Discarded' => 'Discarded',
    ]],
    'String Backed enum' => [StringBackedEnum::class, [StringBackedEnum::NO_RESPONSE, StringBackedEnum::DISCARDED], [
        'NO_RESPONSE' => 'N',
        'DISCARDED' => 'D',
    ]],
    'Int Backed enum' => [IntBackedEnum::class, [IntBackedEnum::NO_RESPONSE, IntBackedEnum::DISCARDED], [
        'NO_RESPONSE' => 3,
        'DISCARDED' => 2,
    ]],
]);

it('throw an EmptyCases exception calling namesByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::valuesByName($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'backed enum' => [StringBackedEnum::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);
