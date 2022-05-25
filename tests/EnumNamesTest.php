<?php

declare(strict_types=1);

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

it('can return an associative array of names', function ($enumClass, $result) {
    expect($enumClass::namesArray())->toBe($result);
})->with([
    'Pure enum' => [Status::class, ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']],
    'PascalCase Pure enum' => [StatusPascalCase::class, ['Pending', 'Accepted', 'Discarded', 'NoResponse']],
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

it('can return an associative array of names with cases param', function ($enumClass, $cases, $result) {
    expect($enumClass::namesArray($cases))->toBe($result);
})->with([
    'Pure enum' => [Status::class, [Status::NO_RESPONSE, Status::DISCARDED], ['NO_RESPONSE', 'DISCARDED']],
    'PascalCase Pure enum' => [StatusPascalCase::class, [StatusPascalCase::Accepted, StatusPascalCase::Discarded], ['Accepted', 'Discarded']],
    'String Backed enum' => [StatusString::class, [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'N' => 'NO_RESPONSE',
        'D' => 'DISCARDED',
    ]],
    'Int Backed enum' => [StatusInt::class, [StatusInt::NO_RESPONSE, StatusInt::DISCARDED], [
        3 => 'NO_RESPONSE',
        2 => 'DISCARDED',
    ]],
]);
