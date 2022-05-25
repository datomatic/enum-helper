<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can return an array of case values', function ($enumClass, $result) {
    expect($enumClass::values())->toBe($result);
})->with([
    'Pure enum' => [Status::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'PascalCase Pure enum' => [StatusPascalCase::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
    'String Backed enum' => [StatusString::class, ['P', 'A', 'D', 'N']],
    'Int Backed enum' => [StatusInt::class, [0, 1, 2, 3]],
]);

it('can return an array of case values with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::values($cases))->toBe($result);
})->with([
    'Pure enum' => [Status::class, [Status::NO_RESPONSE, Status::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'PascalCase Pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded], ['Accepted', 'Discarded']],
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], ['N', 'D']],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [3, 2]],
]);

it('can return an associative array of values', function ($enumClass, $result) {
    expect($enumClass::valuesArray())->toBe($result);
})->with([
    'Pure enum' => [Status::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'PascalCase Pure enum' => [StatusPascalCase::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
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
    expect($enumClass::valuesArray($cases))->toBe($result);
})->with([
    'Pure enum' => [Status::class, [Status::NO_RESPONSE, Status::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'PascalCase Pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded], ['Accepted', 'Discarded']],
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'NO_RESPONSE' => 'N',
        'DISCARDED' => 'D',
    ]],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [
        'NO_RESPONSE' => 3,
        'DISCARDED' => 2,
    ]],
]);
