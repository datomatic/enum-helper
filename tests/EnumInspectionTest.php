<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PascalCasePureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can check if enum is pure', function ($enumClass, $result) {
    expect($enumClass->isPure())->toBe($result);
})->with([
    [PureEnum::PENDING, true],
    [PascalCasePureEnum::NoResponse, true],
    [IntBackedEnum::PENDING, false],
    [StringBackedEnum::ACCEPTED, false],
]);

it('can check if enum is backed', function ($enumClass, $result) {
    expect($enumClass->isBacked())->toBe($result);
})->with([
    [PureEnum::PENDING, false],
    [PascalCasePureEnum::NoResponse, false],
    [IntBackedEnum::PENDING, true],
    [StringBackedEnum::ACCEPTED, true],
]);

it('can check if enum has case', function ($enumClass, $value, $result) {
    expect($enumClass::has($value))->toBe($result);
})->with([
    [PureEnum::class, PureEnum::ACCEPTED, true],
    [PureEnum::class, 'PENDING', true],
    [PureEnum::class, 'P', false],
    [PureEnum::class, null, false],
    [IntBackedEnum::class, IntBackedEnum::PENDING, true],
    [IntBackedEnum::class, 10, false],
    [IntBackedEnum::class, '10', false],
    [IntBackedEnum::class, 1, true],
    [IntBackedEnum::class, '1', true],
    [IntBackedEnum::class, 'ACCEPTED', true],
    [StringBackedEnum::class, 'A', true],
    [StringBackedEnum::class, StringBackedEnum::ACCEPTED, true],
    [StringBackedEnum::class, 'ACCEPTED', true],
    [StringBackedEnum::class, null, false],
]);

it('can check if enum doesn\'t have case', function ($enumClass, $value, $result) {
    expect($enumClass::doesntHave($value))->toBe($result);
})->with([
    [PureEnum::class, PureEnum::ACCEPTED, false],
    [PureEnum::class, 'PENDING', false],
    [PureEnum::class, 'P', true],
    [PureEnum::class, null, true],
    [IntBackedEnum::class, IntBackedEnum::PENDING, false],
    [IntBackedEnum::class, 10, true],
    [IntBackedEnum::class, '10', true],
    [IntBackedEnum::class, 1, false],
    [IntBackedEnum::class, '1', false],
    [IntBackedEnum::class, 'ACCEPTED', false],
    [StringBackedEnum::class, 'A', false],
    [StringBackedEnum::class, StringBackedEnum::ACCEPTED, false],
    [StringBackedEnum::class, 'ACCEPTED', false],
    [StringBackedEnum::class, null, true],
]);

it('can check if enum has name', function ($enumClass, $value, $result) {
    expect($enumClass::hasName($value))->toBe($result);
})->with([
    [PureEnum::class, 'PENDING', true],
    [PureEnum::class, 'P', false],
    [IntBackedEnum::class, '1', false],
    [IntBackedEnum::class, 'ACCEPTED', true],
    [StringBackedEnum::class, 'A', false],
    [StringBackedEnum::class, 'ACCEPTED', true],
]);

it('can check if enum doesnt have name', function ($enumClass, $value, $result) {
    expect($enumClass::doesntHaveName($value))->toBe($result);
})->with([
    [PureEnum::class, 'PENDING', false],
    [PureEnum::class, 'P', true],
    [IntBackedEnum::class, '1', true],
    [IntBackedEnum::class, 'ACCEPTED', false],
    [StringBackedEnum::class, 'A', true],
    [StringBackedEnum::class, 'ACCEPTED', false],
]);

it('can check if enum has value', function ($enumClass, $value, $result) {
    expect($enumClass::hasValue($value))->toBe($result);
})->with([
    [PureEnum::class, 'PENDING', true],
    [PureEnum::class, 'P', false],
    [PureEnum::class, null, false],
    [IntBackedEnum::class, 10, false],
    [IntBackedEnum::class, '10', false],
    [IntBackedEnum::class, 1, true],
    [IntBackedEnum::class, '1', false],
    [IntBackedEnum::class, 'ACCEPTED', false],
    [StringBackedEnum::class, 'A', true],
    [StringBackedEnum::class, 'ACCEPTED', false],
    [StringBackedEnum::class, null, false],
]);

it('can check if enum doenst have value', function ($enumClass, $value, $result) {
    expect($enumClass::doesntHaveValue($value))->toBe($result);
})->with([
    [PureEnum::class, 'PENDING', false],
    [PureEnum::class, 'P', true],
    [PureEnum::class, null, true],
    [IntBackedEnum::class, 10, true],
    [IntBackedEnum::class, '10', true],
    [IntBackedEnum::class, 1, false],
    [IntBackedEnum::class, '1', true],
    [IntBackedEnum::class, 'ACCEPTED', true],
    [StringBackedEnum::class, 'A', false],
    [StringBackedEnum::class, 'ACCEPTED', true],
    [StringBackedEnum::class, null, true],
]);
