<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

// Invokable

it('can be used as a static method to get value', function ($enumClass, $enumMethod, $result) {
    expect($enumClass::$enumMethod())->toBe($result);
})->with([
    'Pure Enum Camel Case' => [Status::class, 'pending', 'PENDING'],
    'Pure Enum Upper Case' => [Status::class, 'PENDING', 'PENDING'],
    'Pure Enum Pascal Case' => [Status::class, 'Pending', 'PENDING'],
    'Pure Enum Camel Case multiword' => [Status::class, 'noResponse', 'NO_RESPONSE'],
    'Pure Enum Upper Case multiword' => [Status::class, 'NO_RESPONSE', 'NO_RESPONSE'],
    'Pure Enum Pascal Case multiword' => [Status::class, 'NoResponse', 'NO_RESPONSE'],
    'Pure Pascal Enum Camel Case' => [StatusPascalCase::class, 'pending', 'Pending'],
    'Pure Pascal Enum Upper Case' => [StatusPascalCase::class, 'PENDING', 'Pending'],
    'Pure Pascal Enum Pascal Case' => [StatusPascalCase::class, 'Pending', 'Pending'],
    'Pure Pascal Enum Camel Case multiword' => [StatusPascalCase::class, 'noResponse', 'NoResponse'],
    'Pure Pascal Enum Upper Case multiword' => [StatusPascalCase::class, 'NO_RESPONSE', 'NoResponse'],
    'Pure Pascal Enum Pascal Case multiword' => [StatusPascalCase::class, 'NoResponse', 'NoResponse'],
    'String Backed Enum Camel Case' => [StatusString::class, 'pending', 'P'],
    'String Backed Enum Upper Case' => [StatusString::class, 'PENDING', 'P'],
    'String Backed Enum Pascal Case' => [StatusString::class, 'Pending', 'P'],
    'String Backed Enum Camel Case multiword' => [StatusString::class, 'noResponse', 'N'],
    'String Backed Enum Upper Case multiword' => [StatusString::class, 'NO_RESPONSE', 'N'],
    'String Backed Enum Pascal Case multiword' => [StatusString::class, 'NoResponse', 'N'],
    'Int Backed Enum Camel Case' => [StatusInt::class, 'pending', 0],
    'Int Backed Enum Upper Case' => [StatusInt::class, 'PENDING', 0],
    'Int Backed Enum Pascal Case' => [StatusInt::class, 'Pending', 0],
    'Int Backed Enum Camel Case multiword' => [StatusInt::class, 'noResponse', 3],
    'Int Backed Enum Upper Case multiword' => [StatusInt::class, 'NO_RESPONSE', 3],
    'Int Backed Enum Pascal Case multiword' => [StatusInt::class, 'NoResponse', 3],
]);

it('can be invoked as an instance as a pure enum', function () {
    $status = Status::PENDING;

    expect($status())->toBe('PENDING');
});

it('can be invoked as an instance as a backed enum', function () {
    $status = StatusInt::PENDING;

    expect($status())->toBe(0);
    expect($status())->toBe($status->value);
});

it('throws an error when a nonexistent case is being used for pure enums', function () {
    Status::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\Status::INVALID');

it('throws an error when a nonexistent case is being used for backed enums', function () {
    StatusString::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\StatusString::INVALID');

// Arrays methods

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

// from and fromName methods
it('does work with from and fromName function', function ($enum, $expectedEnum) {
    expect($enum)->toBe($expectedEnum);
})->with([
    'Int Backed Enum' => [StatusInt::from(0), StatusInt::PENDING],
    'String Backed Enum' => [StatusString::from('P'), StatusString::PENDING],
    'Int Backed Enum from name' => [StatusInt::fromName('PENDING'), StatusInt::PENDING],
    'String Backed Enum from name' => [StatusString::fromName('PENDING'), StatusString::PENDING],
]);

it('does throw exception with wrong from value on BackedEnum int', function () {
    StatusInt::from(10);
})->throws(ValueError::class, '10 is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong from value on BackedEnum string', function () {
    StatusString::from('10');
})->throws(ValueError::class, '"10" is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('does throw exception with wrong fromName value on BackedEnum int', function () {
    StatusInt::fromName('PENDINGA');
})->throws(ValueError::class, '"PENDINGA" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong fromName value on BackedEnum string', function () {
    StatusString::fromName('PENDINGA');
})->throws(ValueError::class, '"PENDINGA" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('can select a case by name with from() for pure enums', function () {
    expect(Status::from('PENDING'))->toBe(Status::PENDING);
});

it('can returns null when selecting a non-existent case by name with tryFrom() for pure enums')
    ->expect(Status::tryFrom('PENDINGA'))
    ->toBe(null)
    ->not->toThrow(ValueError::class);

it('doesn\'t throw exception with wrong from value on BackedEnum int', function () {
    expect(StatusInt::tryFrom(10))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from value on BackedEnum string', function () {
    expect(StatusString::tryFrom('10'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from name on BackedEnum string', function () {
    expect(StatusString::tryFromName('PENDINGA'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('can select a case by name with tryFromName() for backed enums')
    ->expect(StatusString::tryFromName('PENDING'))
    ->toBe(StatusString::PENDING);

it('can select a case by name with tryFromName() for pure enums')
    ->expect(StatusPascalCase::tryFromName('Pending'))
    ->toBe(StatusPascalCase::Pending);

// is, isNot, in, notIn
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

// translation
it('can have a string identifier to translate', function ($enum, $result) {
    expect($enum->toString())->toBe($result);
})->with([
    'Pure Enum' => [Status::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.PENDING'],
    'Int Backed Enum' => [StatusInt::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.PENDING'],
    'String Backed Enum' => [StatusString::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusString.PENDING'],
    'Pascal Case Enum' => [StatusPascalCase::Pending, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase.Pending'],
]);

it('return empty string on translate if is not Laravel')
    ->expect(Status::PENDING->translate())
    ->toBe('');

test('empty class')->expect(EmptyClass::cases())->toBe([]);
