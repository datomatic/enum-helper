<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can compare enum using is method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->is($value))->toBe($result);
})->with([
    [PureEnum::PENDING, PureEnum::PENDING, true],
    [PureEnum::PENDING, PureEnum::ACCEPTED, false],
    [PureEnum::PENDING, 'PENDING', true],
    [PureEnum::PENDING, 'ACCEPTED', false],
    [PureEnum::PENDING, 'P', false],
    [IntBackedEnum::PENDING, IntBackedEnum::PENDING, true],
    [IntBackedEnum::PENDING, IntBackedEnum::ACCEPTED, false],
    [IntBackedEnum::PENDING, 0, true],
    [IntBackedEnum::PENDING, '0', true],
    [IntBackedEnum::PENDING, 1, false],
    [IntBackedEnum::PENDING, '1', false],
    [IntBackedEnum::PENDING, 'PENDING', true],
    [IntBackedEnum::PENDING, 'ACCEPTED', false],
    [StringBackedEnum::PENDING, 'P', true],
    [StringBackedEnum::PENDING, 'A', false],
    [StringBackedEnum::PENDING, StringBackedEnum::PENDING, true],
    [StringBackedEnum::PENDING, StringBackedEnum::ACCEPTED, false],
    [StringBackedEnum::PENDING, 'PENDING', true],
    [StringBackedEnum::PENDING, 'ACCEPTED', false],
    [StringBackedEnum::PENDING, null, false],
]);

it('can compare enum using isNot method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->isNot($value))->toBe($result);
})->with([
    [PureEnum::PENDING, PureEnum::PENDING, false],
    [PureEnum::PENDING, PureEnum::ACCEPTED, true],
    [PureEnum::PENDING, 'PENDING', false],
    [PureEnum::PENDING, 'ACCEPTED', true],
    [PureEnum::PENDING, 'P', true],
    [IntBackedEnum::PENDING, IntBackedEnum::PENDING, false],
    [IntBackedEnum::PENDING, 0, false],
    [IntBackedEnum::PENDING, '0', false],
    [IntBackedEnum::PENDING, 1, true],
    [IntBackedEnum::PENDING, '1', true],
    [IntBackedEnum::PENDING, 'PENDING', false],
    [IntBackedEnum::PENDING, 'ACCEPTED', true],
    [StringBackedEnum::PENDING, 'P', false],
    [StringBackedEnum::PENDING, 'A', true],
    [StringBackedEnum::PENDING, StringBackedEnum::PENDING, false],
    [StringBackedEnum::PENDING, StringBackedEnum::ACCEPTED, true],
    [StringBackedEnum::PENDING, 'PENDING', false],
    [StringBackedEnum::PENDING, 'ACCEPTED', true],
    [StringBackedEnum::PENDING, null, true],
]);

it('can compare enum using in method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->in($values))->toBe($result);
})->with([
    [PureEnum::PENDING, [PureEnum::PENDING, PureEnum::ACCEPTED], true],
    [PureEnum::PENDING, [PureEnum::DISCARDED, PureEnum::ACCEPTED], false],
    [PureEnum::PENDING, [], false],
    [PureEnum::PENDING, ['PENDING', 'ACCEPTED'], true],
    [PureEnum::PENDING, ['ACCEPTED', 'DISCARDED'], false],
    [PureEnum::PENDING, ['P'], false],
    [IntBackedEnum::PENDING, [IntBackedEnum::PENDING, IntBackedEnum::ACCEPTED], true],
    [IntBackedEnum::PENDING, [IntBackedEnum::ACCEPTED], false],
    [IntBackedEnum::PENDING, [0, 1, 2], true],
    [IntBackedEnum::PENDING, ['0', '1', '2'], true],
    [IntBackedEnum::PENDING, [2, 3], false],
    [IntBackedEnum::PENDING, ['2', '3'], false],
    [IntBackedEnum::PENDING, [], false],
    [IntBackedEnum::PENDING, ['PENDING', 'ACCEPTED'], true],
    [IntBackedEnum::PENDING, ['DISCARDED', 'ACCEPTED'], false],
    [StringBackedEnum::PENDING, ['P', 'D'], true],
    [StringBackedEnum::PENDING, ['A'], false],
    [StringBackedEnum::PENDING, [], false],
    [StringBackedEnum::PENDING, [StringBackedEnum::PENDING, StringBackedEnum::ACCEPTED], true],
    [StringBackedEnum::PENDING, [StringBackedEnum::ACCEPTED, StringBackedEnum::DISCARDED], false],
    [StringBackedEnum::PENDING, ['PENDING', 'ACCEPTED'], true],
    [StringBackedEnum::PENDING, ['DISCARDED', 'ACCEPTED'], false],
]);

it('can compare enum using notIn method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->notIn($values))->toBe($result);
})->with([
    [PureEnum::PENDING, [PureEnum::PENDING, PureEnum::ACCEPTED], false],
    [PureEnum::PENDING, [PureEnum::DISCARDED, PureEnum::ACCEPTED], true],
    [PureEnum::PENDING, [], true],
    [PureEnum::PENDING, ['PENDING', 'ACCEPTED'], false],
    [PureEnum::PENDING, ['ACCEPTED', 'DISCARDED'], true],
    [PureEnum::PENDING, ['P'], true],
    [IntBackedEnum::PENDING, [IntBackedEnum::PENDING, IntBackedEnum::ACCEPTED], false],
    [IntBackedEnum::PENDING, [IntBackedEnum::ACCEPTED], true],
    [IntBackedEnum::PENDING, [0, 1, 2], false],
    [IntBackedEnum::PENDING, ['0', '1', '2'], false],
    [IntBackedEnum::PENDING, [2, 3], true],
    [IntBackedEnum::PENDING, ['2', '3'], true],
    [IntBackedEnum::PENDING, [], true],
    [IntBackedEnum::PENDING, ['PENDING', 'ACCEPTED'], false],
    [IntBackedEnum::PENDING, ['DISCARDED', 'ACCEPTED'], true],
    [StringBackedEnum::PENDING, ['P', 'D'], false],
    [StringBackedEnum::PENDING, ['A'], true],
    [StringBackedEnum::PENDING, [], true],
    [StringBackedEnum::PENDING, [StringBackedEnum::PENDING, StringBackedEnum::ACCEPTED], false],
    [StringBackedEnum::PENDING, [StringBackedEnum::ACCEPTED, StringBackedEnum::DISCARDED], true],
    [StringBackedEnum::PENDING, ['PENDING', 'ACCEPTED'], false],
    [StringBackedEnum::PENDING, ['DISCARDED', 'ACCEPTED'], true],
]);
