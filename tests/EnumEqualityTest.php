<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('can compare enum using is method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->is($value))->toBe($result);
})->with([
    [Status::PENDING, Status::PENDING, true],
    [Status::PENDING, Status::ACCEPTED, false],
    [Status::PENDING, 'PENDING', true],
    [Status::PENDING, 'ACCEPTED', false],
    [Status::PENDING, 'P', false],
    [StatusInt::PENDING, StatusInt::PENDING, true],
    [StatusInt::PENDING, StatusInt::ACCEPTED, false],
    [StatusInt::PENDING, 0, true],
    [StatusInt::PENDING, 1, false],
    [StatusInt::PENDING, 'PENDING', false],
    [StatusString::PENDING, 'P', true],
    [StatusString::PENDING, 'A', false],
    [StatusString::PENDING, StatusString::PENDING, true],
    [StatusString::PENDING, StatusString::ACCEPTED, false],
    [StatusString::PENDING, 'PENDING', false],
]);

it('can compare enum using isNot method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->isNot($value))->toBe($result);
})->with([
    [Status::PENDING, Status::PENDING, false],
    [Status::PENDING, Status::ACCEPTED, true],
    [Status::PENDING, 'PENDING', false],
    [Status::PENDING, 'ACCEPTED', true],
    [Status::PENDING, 'P', true],
    [Status::PENDING, Status::ACCEPTED, true],
    [StatusInt::PENDING, StatusInt::PENDING, false],
    [StatusInt::PENDING, 0, false],
    [StatusInt::PENDING, 1, true],
    [StatusInt::PENDING, 'PENDING', true],
    [StatusString::PENDING, 'P', false],
    [StatusString::PENDING, 'A', true],
    [StatusString::PENDING, StatusString::PENDING, false],
    [StatusString::PENDING, StatusString::ACCEPTED, true],
    [StatusString::PENDING, 'PENDING', true],
]);

it('can compare enum using in method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->in($values))->toBe($result);
})->with([
    [Status::PENDING, [Status::PENDING, Status::ACCEPTED], true],
    [Status::PENDING, [Status::DISCARDED, Status::ACCEPTED], false],
    [Status::PENDING, [], false],
    [Status::PENDING, ['PENDING', 'ACCEPTED'], true],
    [Status::PENDING, ['ACCEPTED', 'DISCARDED'], false],
    [Status::PENDING, ['P'], false],
    [StatusInt::PENDING, [StatusInt::PENDING, Status::ACCEPTED], true],
    [StatusInt::PENDING, [StatusInt::ACCEPTED], false],
    [StatusInt::PENDING, [0, 1, 2], true],
    [StatusInt::PENDING, [2, 3], false],
    [StatusInt::PENDING, [], false],
    [StatusInt::PENDING, ['PENDING'], false],
    [StatusString::PENDING, ['P', 'D'], true],
    [StatusString::PENDING, ['A'], false],
    [StatusString::PENDING, [], false],
    [StatusString::PENDING, [StatusString::PENDING, StatusString::ACCEPTED], true],
    [StatusString::PENDING, [StatusString::ACCEPTED, StatusString::DISCARDED], false],
    [StatusString::PENDING, ['PENDING'], false],
]);

it('can compare enum using notIn method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->notIn($values))->toBe($result);
})->with([
    [Status::PENDING, [Status::PENDING, Status::ACCEPTED], false],
    [Status::PENDING, [Status::DISCARDED, Status::ACCEPTED], true],
    [Status::PENDING, [], true],
    [Status::PENDING, ['PENDING', 'ACCEPTED'], false],
    [Status::PENDING, ['ACCEPTED', 'DISCARDED'], true],
    [Status::PENDING, ['P'], true],
    [StatusInt::PENDING, [StatusInt::PENDING, Status::ACCEPTED], false],
    [StatusInt::PENDING, [StatusInt::ACCEPTED], true],
    [StatusInt::PENDING, [0, 1, 2], false],
    [StatusInt::PENDING, [2, 3], true],
    [StatusInt::PENDING, [], true],
    [StatusInt::PENDING, ['PENDING'], true],
    [StatusString::PENDING, ['P', 'D'], false],
    [StatusString::PENDING, ['A'], true],
    [StatusString::PENDING, [], true],
    [StatusString::PENDING, [StatusString::PENDING, StatusString::ACCEPTED], false],
    [StatusString::PENDING, [StatusString::ACCEPTED, StatusString::DISCARDED], true],
    [StatusString::PENDING, ['PENDING'], true],
]);