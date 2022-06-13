<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\EmptyCases;
use Datomatic\EnumHelper\Exceptions\NotBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can return an array of descriptions', function ($className, $cases, $values) {
    expect($className::descriptions($cases))->toBe($values);
})->with([
    [Status::class, null, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
    [Status::class, [Status::PENDING, Status::DISCARDED], [
        'Await decision',
        'No longer useful',
    ]],
    [StatusString::class, [StatusString::ACCEPTED, StatusString::NO_RESPONSE], [
        'Recognized valid',
        'No response',
    ]],
]);

it('throw an EmptyCases exception calling descriptions method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::descriptions($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array [name => description]', function ($className, $cases, $values) {
    expect($className::descriptionsByName($cases))->toBe($values);
})->with([
    'Pure Enum' => [Status::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Pascal Case Pure Enum' => [StatusPascalCase::class, null, [
        'Pending' => 'Await decision',
        'Accepted' => 'Recognized valid',
        'Discarded' => 'No longer useful',
        'NoResponse' => 'No response',
    ]],
    'Pure Enum subset' => [Status::class, [Status::PENDING, Status::DISCARDED], [
        'PENDING' => 'Await decision',
        'DISCARDED' => 'No longer useful',
    ]],
    'Backed Enum' => [StatusString::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed Enum subset' => [StatusString::class, [StatusString::DISCARDED, StatusString::ACCEPTED], [
        'DISCARDED' => 'No longer useful',
        'ACCEPTED' => 'Recognized valid',
    ]],
]);

it('throw an EmptyCases exception calling descriptionsByName method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::descriptionsByName($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('can return an associative array [value => description]', function ($className, $cases, $values) {
    expect($className::descriptionsByValue($cases))->toBe($values);
})->with([
    'String Backed Enum' => [StatusString::class, null, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
    'String Backed Enum subset' => [StatusString::class, [StatusString::DISCARDED, StatusString::ACCEPTED], [
        'D' => 'No longer useful',
        'A' => 'Recognized valid',
    ]],
    'Int Backed Enum' => [StatusInt::class, null, [
        0 => 'Await decision',
        1 => 'Recognized valid',
        2 => 'No longer useful',
        3 => 'No response',
    ]],
]);

it('can return an associative array [value/name => description]', function ($className, $cases, $values) {
    expect($className::descriptionsAsSelect($cases))->toBe($values);
})->with([
    'Pure Enum' => [Status::class, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Pure Enum subset' => [Status::class, [Status::PENDING, Status::DISCARDED], [
        'PENDING' => 'Await decision',
        'DISCARDED' => 'No longer useful',
    ]],
    'Backed Enum' => [StatusString::class, null, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
    'Backed Enum subset' => [StatusString::class, [StatusString::DISCARDED, StatusString::ACCEPTED], [
        'D' => 'No longer useful',
        'A' => 'Recognized valid',
    ]],
]);

it('throw an EmptyCases exception calling descriptionsByValue method with empty cases', function ($enumClass, $cases) {
    expect(fn () => $enumClass::descriptionsByValue($cases))->toThrow(EmptyCases::class, "The enum $enumClass has empty case or you pass empty array as parameter");
})->with('emptyCases');

it('throw an NotBackedEnum exception with pure enum calling descriptionsByValue method', function ($enumClass, $cases) {
    expect(fn () => $enumClass::descriptionsByValue($cases))->toThrow(NotBackedEnum::class, "$enumClass is not a BackedEnum");
})->with('notBackedEnum');
