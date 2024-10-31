<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can return an array of labels', function ($className, $cases, $values) {
    expect($className::labels($cases))->toBe($values);
})->with([
    [PureEnum::class, null, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
    [PureEnum::class, [PureEnum::PENDING, PureEnum::DISCARDED], [
        'Await decision',
        'No longer useful',
    ]],
    [StringBackedEnum::class, [StringBackedEnum::ACCEPTED, StringBackedEnum::NO_RESPONSE], [
        'Recognized valid',
        'No response',
    ]],
]);

it('throw an EmptyCases exception calling labels method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::labels($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array [name => label]', function ($className, $cases, $values) {
    expect($className::labelsByName($cases))->toBe($values);
})->with([
    'Pure Enum' => [PureEnum::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Pascal Case Pure Enum' => [PascalCasePureEnum::class, null, [
        'Pending' => 'Await decision',
        'Accepted' => 'Recognized valid',
        'Discarded' => 'No longer useful',
        'NoResponse' => 'No response',
    ]],
    'Pure Enum subset' => [PureEnum::class, [PureEnum::PENDING, PureEnum::DISCARDED], [
        'PENDING' => 'Await decision',
        'DISCARDED' => 'No longer useful',
    ]],
    'Backed enum' => [StringBackedEnum::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed enum subset' => [StringBackedEnum::class, [StringBackedEnum::DISCARDED, StringBackedEnum::ACCEPTED], [
        'DISCARDED' => 'No longer useful',
        'ACCEPTED' => 'Recognized valid',
    ]],
]);

it('throw an EmptyCases exception calling labelsByName method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::labelsByName($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array [value => label]', function ($className, $cases, $values) {
    expect($className::labelsByValue($cases))->toBe($values)
        ->and($className::nullableLabelsByValue('Nullable', $cases))->toBe([null => 'Nullable'] + $values);
})->with([
    'Pure Enum' => [PureEnum::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Pure Enum subset' => [PureEnum::class, [PureEnum::PENDING, PureEnum::DISCARDED], [
        'PENDING' => 'Await decision',
        'DISCARDED' => 'No longer useful',
    ]],
    'String Backed enum' => [StringBackedEnum::class, null, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
    'String Backed enum subset' => [StringBackedEnum::class, [StringBackedEnum::DISCARDED, StringBackedEnum::ACCEPTED], [
        'D' => 'No longer useful',
        'A' => 'Recognized valid',
    ]],
    'Int Backed enum' => [IntBackedEnum::class, null, [
        0 => 'Await decision',
        1 => 'Recognized valid',
        2 => 'No longer useful',
        3 => 'No response',
    ]],
]);

it('throw an EmptyCases exception calling labelsByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::labelsByValue($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with([
    'Pure enum' => [PureEnum::class, []],
    'Backed enum' => [StringBackedEnum::class, []],
    'empty cases enum' => [EmptyClass::class, null],
]);
